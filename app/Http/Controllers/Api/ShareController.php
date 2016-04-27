<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/10/21
 * Time: 上午10:02
 */
namespace App\Http\Controllers\Api;

use App\Models\Journey;
use App\Services\ProductService;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;


/**
 *
 * @SWG\Resource(
 *   apiVersion="2.0.0",
 *   swaggerVersion="1.2",
 *   resourcePath="/share",
 *   description="分享",
 *   @SWG\Produces("application/json")
 * )
 */
class ShareController extends BaseController
{
    /**
     *
     *
     * @SWG\Api(
     *   path="/share/content",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="get",
     *       summary="获取分享内容",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="good_id",
     *           description="商品Id",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
  public function getContent () {
      //$data = Input::all();
      $good_id = Input::get('good_id');
      if($good_id){
          $good = ProductService::getInstance()->getProductDetail($good_id);
      }
      if ($good_id && !empty($good)) {
          $outDate = [
              'content'=>$good['title'],
              'image'=>'',
              'url'=>url('/')
          ];
          if (isset($good['images'][0])) $outDate['image'] = $good['images'][0]['img_o'];

      }else{
          $outDate = [
              'content'=>'行家分享内容，行家分享文本内容',
              'image'=>'',
              'url'=>url('/')
          ];
      }

      return response()->forApi($outDate);

  }
}