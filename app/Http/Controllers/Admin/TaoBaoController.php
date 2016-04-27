<?php
namespace App\Http\Controllers\Admin;


use App\Lib\LibUtil;
use App\Models\Folder;
use App\Models\Product;
use App\Services\ImageService;
use App\Services\TaoBaoService;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;

/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/12/14
 * Time: 下午5:44
 */
class TaoBaoController extends ApiController
{
    private static $recommends = [1=>'推荐',0=>'不推荐'];

    private static $kinds = [1 => '采集商品'];

    private static $status = ['' => '选择状态', 0 => '待审核', 1 => '审核通过', 2 => '审核失败'];

    public function getItem()
    {
        return View('admin.taobao.item');
    }

    public function anyDetail()
    {
        $params = Input::all();

        if (isset($params['insert']) && !empty($params['insert'])&& isset($params['save'])) {
            $user = Auth::user();
            $id = ProductService::getInstance()->addProduct($user->id, $params);
            return redirect('admin/product/action/edit?show='.$id);
        }

        $rules = array(
            'url' => 'required',
        );
        //请求参数验证
        parent::validator($params, $rules);
        $url = $params['url'];
        $params = LibUtil::getKeyValue($url);
        $id = isset($params['id']) ? $params['id'] : 0;
        $outdata = TaoBaoService::getInstance()->getItemDetail($id);
        if (!isset($outdata['x_item']) || empty($outdata['x_item'])) {
            return parent::error('无法采集淘宝商品信息');
        }
        $item = $outdata['x_item'][0];
        $mobile_desc_info = $outdata['mobile_desc_info'];
        $item['detail_url'] = $url;
        if (!empty($item['pic_url'])) {
            $image_url[] = $item['pic_url'];
        }
        $item['desc'] = $item['title'];
        if (!empty($mobile_desc_info['desc_list']['desc_fragment'])) {
            foreach ($mobile_desc_info['desc_list']['desc_fragment'] as $val) {
                if ($val['label']=='img') {
                   // $image_url[] = $val['content'];
                }elseif($val['label']=='shortdesc'){
                    $item['desc'] = $val['content'];
                }
            }

        }

        $image_ids = [];
        if (isset($image_url) && !empty($image_url)) {
            foreach ($image_url as $url) {
                $image_ids[] = ImageService::getInstance()->getImageIds($url);
            }
            $item['image_ids'] = implode(',', $image_ids);

        }



        return self::publish($item);
    }

    protected function publish($item)
    {

        $data = Input::all();
        $user = Auth::user();
        $user_id = $user->id;
        $edit = DataEdit::source(new Product);
        $dataInfo = $edit->model->toArray();
        $readOnly = false;
        if (!empty($dataInfo) || (isset($dataInfo['user_id']) && $dataInfo['user_id'] != $user_id)){
            $readOnly = true;
        }
        if (empty($dataInfo) || (isset($dataInfo['user_id']) && $dataInfo['user_id'] == $user_id)) {
            $user_id = isset($dataInfo['user_id']) ? $dataInfo['user_id'] : $user_id;
            $folders = Folder::where('user_id',$user_id)->orderBy('id','desc')->lists('name','id')->toArray();

        }else{
            $folders = Folder::orderBy('id','desc')->lists('name','id')->toArray();
            $folders[0] ='选择文件夹';

        }
        //$category = Category::where(['level' => 2])->lists('name', 'id')->toArray();
        $category = Category::where(['level' => 2,'kind'=>1])->orderBy('parent_id','asc')->lists('name','id')->toArray();

        $folders[0] = '选择文件夹';
        $category[0] = '选择分类';
        $kinds = self::$kinds;
        $status = self::$status;
        unset($status['']);

        $dataInfo = $edit->model->toArray();
        $edit->link("/admin/products?kind=1", "商品列表", "TR")->back();
        $edit->add('id', 'Id', 'hidden');
        $edit->add('source', '用户id', 'hidden')->insertValue(1);
        $edit->add('kind', '类型', 'hidden')->insertValue(1);
        $edit->add('status', '状态', 'hidden')->insertValue(1);
        $edit->add('user_id', '用户id', 'hidden')->insertValue($user->id);
        $edit->add('category_id', '分类', 'select')->options($category)->rule('required');
        $edit->add('folder_id', '文件夹', 'select')->options($folders)->rule('required');
        $edit->add('title', '标题', 'text')->insertValue($item['title'])->rule('required');
        $edit->add('tags', '标签', 'text')->insertValue($item['nick'])->attributes(array("readonly" => "true"));
        $edit->add('reserve_price', '优惠价格', 'text')->insertValue($item['price_wap'])->attributes(array("readonly" => "true"));
        $edit->add('price', '原价', 'text')->insertValue($item['price'])->attributes(array("readonly" => "true"));
        $edit->add('description', '描述', 'text')->insertValue($item['desc']);
        $edit->add('detail_url', '淘宝链接', 'text')->insertValue($item['detail_url'])->attributes(array("readonly" => "true"));

       // $edit->add('status', '状态', 'Radiogroup')->options($status)->insertValue(1);
        $edit->add('is_recommend', '是否推荐', 'Radiogroup')->options(self::$recommends);
        $edit->add('sort', '排序', 'text')->rule('required')->insertValue(9999);
        if (!empty($item['pic_url']) && $item['image_ids']) {
            $edit->add('image_ids', "图片", 'text')->attributes(array("style" => "display:none;"))->insertValue($item['image_ids']);
        }
        return $edit->view('admin.products.edit', compact('edit'));
    }
}