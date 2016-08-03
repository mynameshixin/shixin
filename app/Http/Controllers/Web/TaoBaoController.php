<?php
namespace App\Http\Controllers\Web;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use App\Lib\LibUtil;
use App\Models\Folder;
use App\Models\Product;
use App\Services\ImageService;
use App\Services\TaoBaoService;
use App\Services\FancyService;
use Zofe\Rapyd\Facades\DataEdit;
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/12/14
 * Time: 下午5:44
 */
class TaoBaoController extends CmController
{
    public function anyDetail(){
        $data = Input::all();
        $rules = array(
            'url' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $url = $data['url'];
        $fancy = ['m.fancy.com'];
        $host = parse_url($url);
        if(!empty($host['host']) && in_array($host['host'],$fancy)){
            $outdata = FancyService::getInstance()->getItemDetail($url);
            $item = $outdata[0];
            if (!empty($item['pic_url'])) {
                $image_url[] = $item['pic_url'];
            }

            $image_ids = [];
            if (isset($image_url) && !empty($image_url)) {
                foreach ($image_url as $url) {
                    $image_ids[] = ImageService::getInstance()->getImageIds($url);
                }
                $outdata[0]['image_ids'] = implode(',', $image_ids);

            }
            if($outdata){
                return response()->forApi(['x_item'=>$outdata], 200);
            }
            return response()->forApi(array(), 1001, ' 商品信息采集失败！');
        }

        $params = LibUtil::getKeyValue($url);
        $id = isset($params['id']) ? $params['id'] : 0;
        $outdata = TaoBaoService::getInstance()->getItemDetail ($id);
        $item = $outdata['x_item'][0];
        if (!empty($item['pic_url'])) {
            $image_url[] = $item['pic_url'];
        }

        $image_ids = [];
        if (isset($image_url) && !empty($image_url)) {
            foreach ($image_url as $url) {
                //远程图片保存于服务器 返回imageid
                $image_ids[] = ImageService::getInstance()->getImageIds($url);
            }
            $outdata['x_item'][0]['image_ids'] = implode(',', $image_ids);

        }

        if (isset($outdata) && !empty($outdata)) {
            return response()->forApi($outdata);
        }else{
            return response()->forApi(array(), 1001, ' 商品信息采集失败！');
        }

    }

}