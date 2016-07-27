<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 下午6:52
 */
namespace App\Http\Controllers\Admin;

use App\Lib\LibUtil;
use App\Models\Category;
use App\Models\Folder;
use App\Models\FolderGood;
use App\Models\Product;
use App\Models\Shop;
use App\Services\FolderService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Input;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;


class ProductController extends ApiController
{
    private  static $recommends = [1=>'推荐',0=>'不推荐'];

    private static $kinds = [1=>'商品',2=>'灵感图'];

    private static $status = [''=>'选择状态',0=>'待审核',1=>'审核通过',2=>'审核失败'];

    private static $categories = [];

    public function index(Request $request)
    {
        $data = Input::all();
        $user = Auth::user();

        $userArr['']= '全部';
        $userArr[$user->id] = '自己发布的';
        $kinds =  self::$kinds;
        $status = self::$status;
        $recommends = self::$recommends;
        $recommends [''] = '是否推荐';
        $categories = Category::lists('name','id')->toArray();

        self::$categories = $categories;
        $data['kind'] = isset( $data['kind']) ?  $data['kind'] : 1;
        if (isset($data['kind']) && $data['kind']) {
            $filter = DataFilter::source( Product::where(['kind'=>$data['kind'],'is_delete'=>0])->orderBy('sort','asc')->orderBy('id','desc'));
            $filter->add('kind', '类型', 'hidden')->insertValue($data['kind']);
        }else{
            $filter = DataFilter::source( Product::where(['is_delete'=>0])->orderBy('sort','asc')->orderBy('id','desc'));
            $filter->add('kind', '类型', 'select')->options($kinds);
        }
        $filter->add('status', '状态', 'select')->options($status);
        $filter->add('is_recommend', '推荐', 'select')->options($recommends);
        $filter->add('user_id', '发布人', 'select')->options($userArr);
        $filter->submit('查询');
        $filter->reset('重置');
        if (isset($data['kind']) && $data['kind']==1){
            $filter->link("admin/taobao/action/item","淘宝采集商品");
            $filter->link("/admin/product/action/edit?kind=1","发布商品");
        }else{
            $filter->link("/admin/product/action/edit","发布灵感图");
        }


        $grid = DataGrid::source($filter);  //same source types of DataSet
        $grid->add('id','ID', true);
        $grid->add('title','标题', true); //field name, label, sortable

        if (isset($data['kind']) && $data['kind']==1) {
            $grid->add('reserve_price', '优惠价格'); //relation.fieldname
            $grid->add('price', '原价'); //relation.fieldname
        }
//        $grid->add('kind','类别')->cell( function ($value) {
//            return self::$kinds[$value];
//        });
        $grid->add('category_id','类别')->cell( function ($value) {
            return isset(self::$categories[$value]) ? self::$categories[$value] : '';
        });
        $grid->add('tags','标签');

        $grid->add('status','状态')->cell( function ($value) {
            $status = self::$status;

            return isset($status[$value]) ? $status[$value] : $status[1];
        });

        $grid->add('sort','排序', true);
        $grid->add('image_ids','图片')->cell(function($val){
            if($val=="") return "";
            $str = '';
            $image_ids = explode(',',$val);
            if(!empty($image_ids)){
                //$image_ids =  reset($image_ids);
                //foreach ($image_ids as $image_id) {
                    $image_id = $image_ids[0];
                    $file = LibUtil::getPicUrl($image_id,3);
                    //if(empty($file))$file = LibUtil::getPicUrl($image_id,3);
                    if($file) $str .= "<a href='".$file."' target='_blank' text='点击打开原图' style='display:block;'><img src='".$file."' style='width:80px;'></a>";
                //}

            }
            return $str;

        });
//        $actions = 'show|modify|delete';
//        $grid->edit('/admin/product/action/edit', '操作',$actions);
        $actions = 'show|modify|delete';


        $grid->edit('/admin/product/action/edit', '操作', $actions);

        $grid->row(function ($row) {
            $user = Auth::user();
            if ($row->data->collection_count > 0) {
                $actions = ['show', 'modify'];
            } elseif ($row->data->user_id == $user->id) {
                $actions = ['show', 'modify', 'delete'];
            }else{
                $actions = ['show', 'modify'];
            }


            $view = \View::make('rapyd::datagrid.actions', [
                'uri' => '/admin/product/action/edit',
                'id' => $row->data->id,
                'actions' => $actions
            ]);

            $row->cell('_edit')->value($view);

        });

        $grid->paginate(15); //pagination

        return view('admin.grid', compact('grid', 'filter'));
    }


    public function anyEdit()
    {
        $data = Input::all();
        $user = Auth::user();
        $user_id = $user->id;

        if (isset($data['update']) && !empty($data['update'])&& isset($data['save'])) {
            ProductService::getInstance()->updateProduct($data['update'], $data);
            return redirect('admin/product/action/edit?show='.$data['update']);
        } elseif (isset($data['save']) && $data['save']==1 && isset($data['insert']) && $data['insert']==1) {
           $id = ProductService::getInstance()->addProduct($user_id, $data);
           return redirect('admin/product/action/edit?show='.$id);
        }elseif(isset($data['do_delete']) && $data['do_delete']){
            $good = ProductService::getInstance()->delProduct($data['do_delete']);
            $kind = !empty($good) ? $good->kind : 1;
            return redirect('admin/products?kind='.$kind);
        }

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

        $kind = isset($dataInfo['kind']) ? $dataInfo['kind'] : 2;
        $kind = isset($data['kind']) ? $data['kind'] : $kind;

        $category = Category::where(['level' => 2,'kind'=>$kind])->orderBy('parent_id','asc')->lists('name','id')->toArray();


        //$folders[0] ='选择文件夹';
        $category[0] = '选择分类';
        $kinds = self::$kinds;
        $status = self::$status;
        unset($status['']);

        $dataInfo = $edit->model->toArray();
        if ($kind==1) {
            $edit->link("/admin/products?kind=1","商品列表", "TR")->back();
        }else{
            $edit->link("/admin/products?kind=2","图集列表", "TR")->back();
        }

        $edit->add('id','Id', 'hidden');

        if (!$readOnly) {

            $edit->add('user_id', '用户id', 'hidden')->insertValue($user->id);
            $edit->add('kind', '类别', 'hidden')->insertValue($kind);
            $edit->add('status','状态', 'hidden')->insertValue(1);
            $edit->add('category_id', '分类', 'select')->options($category)->rule('required');
            //$edit->add('kind', '类型', 'Radiogroup')->options(self::$kinds)->rule('required')->insertValue(2);
            $edit->add('folder_id', '文件夹', 'select')->options($folders)->rule('required');
            $edit->add('title', '标题', 'text')->insertValue(' ');
            $edit->add('tags', '标签：多标签用";" 分割', 'text')->insertValue(' ');
            if ($kind==1) {
                $edit->add('reserve_price', '优惠价格', 'text');
                $edit->add('price', '原价', 'text');
            }
            $edit->add('description', '描述', 'text')->insertValue(' ');
        }else{
            $edit->add('user_id', '用户id', 'hidden');
            $edit->add('category_id', '分类', 'select')->options($category)->attributes(array("readonly" => "true"));
            //$edit->add('kind', '类型', 'Radiogroup')->options(self::$kinds)->attributes(array("readonly" => "true"));
            $edit->add('kind', '类别', 'hidden')->insertValue($kind);
            $edit->add('folder_id', '文件夹', 'select')->options($folders)->attributes(array("readonly" => "true"));
            $edit->add('title', '标题', 'text')->attributes(array("readonly" => "true"));
            // $edit->add('tags', '标签', 'text')->attributes(array("readonly" => "true"));
            $edit->add('tags', '标签：多标签用";" 分割', 'text')->insertValue(' ');
            if ($kind==1) {
                $edit->add('reserve_price', '优惠价格', 'text')->attributes(array("readonly" => "true"));
                $edit->add('price', '原价', 'text')->attributes(array("readonly" => "true"));
                $edit->add('detail_url', '淘宝链接', 'text')->attributes(array("readonly" => "true"));
            }
            $edit->add('description', '描述', 'text');
            $edit->add('status','状态', 'Radiogroup')->options($status)->rule('required');
        }


        $edit->add('is_recommend','是否推荐', 'Radiogroup')->options(self::$recommends)->insertValue('0');
        $edit->add('sort', '排序', 'text')->attributes(array("style"=>"width:200px;"))->rule('required')->insertValue(9999);
        if(isset($data['show'])){
            if(!empty($dataInfo) && $dataInfo['image_ids']){
                $edit->add('image_ids', "图片 （建议1242px*796px)", 'text')->attributes(array("style" => "display:none;"))->insertValue('');
            }
        }elseif($readOnly){
            $edit->add('image_ids', "图片 （建议1242px*796px)", 'text')->attributes(array("style" => "display:none","readonly" => "true"))->insertValue('');
        }else{
            $edit->add('image_ids', "图片 （建议1242px*796px)", 'text')->attributes(array("style" => "display:none"))->insertValue('');
        }
        return $edit->view('admin.products.edit', compact('edit'));
    }




}