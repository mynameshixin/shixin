<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/18
 * Time: 下午3:23
 */
namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Models\JourneyCoupon;
use App\Models\JourneyProduct;
use App\Services\CommentService;
use App\Services\ImageService;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;


/**
 *
 * @SWG\Resource(
 *   apiVersion="2.0.0",
 *   swaggerVersion="1.2",
 *   resourcePath="/comments",
 *   description="商品评论",
 *   @SWG\Produces("application/json")
 * )
 */
class CommentController extends BaseController
{

    public function __construct()
    {

    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/comments",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="评论列表",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="good_id",
     *           description="商品Id",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="page",
     *           description="页数",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *        @SWG\Parameter(
     *           name="num",
     *           description="条数",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */

    public function index(){
        $data = Input::all();
        $rules = array(
            'good_id' => 'required|exists:goods,id',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $num = isset($data['num']) ? $data['num'] : 20;
        $out = CommentService::getInstance()->getCommentList($data['good_id'],$num);
        return response()->forApi($out);
    }
      /**
      *
      *
      * @SWG\Api(
      *   path="/comments",
      *   @SWG\Operations(
      *     @SWG\Operation(
      *       method="POST",
      *       summary="发表评论",
      *       notes="Returns special list",
      *       @SWG\Parameters(
      *         @SWG\Parameter(
      *           name="access_token",
      *           description="登录的AccessToken",
      *           paramType="form",
      *           required=true,
      *           type="string"
       *         ),
       *    @SWG\Parameter(
       *           name="good_id",
       *           description="商品ID",
       *           paramType="form",
       *           required=true,
       *           type="string"
       *         ),
      *         @SWG\Parameter(
      *           name="content",
      *           description="评论内容",
      *           paramType="form",
      *           required=true,
      *           type="string"
      *         ),
      *         @SWG\Parameter(
      *           name="image[[]",
      *           description="图片",
      *           paramType="form",
      *           required=false,
      *           type="file"
      *         ),
       *         @SWG\Parameter(
       *           name="image[]",
       *           description="图片",
       *           paramType="form",
       *           required=false,
       *           type="file"
       *         ),
      *       )
      *     )
      *   )
      * )
      *
      * @return Response
      */
     public function store() {
         $data = Input::all();
         $rules = array(
             'access_token' => 'required',
             'good_id' => 'required|exists:goods,id',
             'content' => 'required|min:1',
             //'point' => 'required',
         );
         //请求参数验证
         parent::validator($data, $rules);
         $access_token = Input::get('access_token');
         $rs = parent::validateAcessToken($access_token);
         $userId = $rs['user_id'];
         $row = Comment::where(['user_id'=>$userId,'good_id'=>$data['good_id']])->first();
//         if (!empty($row)) {
//             return response()->forApi(array(), 1001, '您已评论过该商品！');
//         }
         $id = CommentService::getInstance()->addComment ($userId,$data,$_FILES);

         return response()->forApi(['id'=>$id] , 200);

     }

    /**
     *
     * @SWG\Api(
     *   path="/comments/{id}",
     *   @SWG\Operations(
     *    @SWG\Operation(
     *       method="DELETE",
     *       summary="删除自己的评论",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="id",
     *           description="评论ID",
     *            paramType="path",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function destroy($id)
    {
        $data = Input::all();
        $data['id'] = $id;
        $rules = array (
            'id' =>'required',
            'access_token'=>'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $access_token = $data['access_token'];
        $rs = parent::validateAcessToken($access_token);
        $userId = $rs['user_id'];
        $rs = Comment::where('id',$data['id'])->where('user_id',$userId)->delete();
        return response()->forApi(array('status'=>$rs ? 1 : 0));
    }
}