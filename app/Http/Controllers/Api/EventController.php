<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/19
 * Time: 下午1:47
 */

namespace App\Http\Controllers\Api;

use App\Services\EventService;
use App\Services\TaoBaoService;
use Illuminate\Support\Facades\Input;
use App\Services\ProductService;
use App\Models\Shop;

/**
 *
 * @SWG\Resource(
 *   apiVersion="2.0.0",
 *   swaggerVersion="1.2",
 *   resourcePath="/events",
 *   description="活动",
 *   @SWG\Produces("application/json")
 * )
 */

class EventController extends BaseController
{
    private static $user_id;

    public function __construct()
    {

    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/events",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="活动列表",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *          @SWG\Parameter(
     *           name="keyword",
     *           description="名称模糊查询",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="type",
     *           description="类型： 1 免费门票  2 免费索票  3 微信推荐 ",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="kind",
     *           description="详细分类ID",
     *           paramType="query",
     *           required=false,
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
     *         ),
     *         @SWG\Parameter(
     *           name="sort",
     *           description="排序：0 时间 1 收藏数  2 喜欢数 默认为 0",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function index()
    {
        $data = Input::all();

        $rules = array(
            'type' => 'integer|in:1,2,3',
            'user_id' => 'exists:users,id',
        );
        //请求参数验证
        parent::validator($data, $rules);

        $num = isset($data['num']) ? $data['num'] : 20;
        $rs =EventService::getInstance()->getEventList ($data,$num);
        return response()->forApi($rs);
    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/event/join",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="活动索票",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *          @SWG\Parameter(
     *           name="id",
     *           description="活动id",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="access_token",
     *           description="登陆的access_token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="contact",
     *           description="备注：",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function postJoin () {
        $data = Input::all();
        $rules = array(
            'id' => 'required|exists:events,id',
            'access_token' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);
        $user_id = $rs['user_id'];
        $contact = isset($data['contact']) ? $data['contact'] : '';
        $rs = EventService::getInstance()->joinEvent ($data['id'],$user_id,$contact);
        if ($rs) {
            return response()->forApi(['status'=>1]);
        }else{
            return response()->forApi(array(), 1001, '活动报名失败');
        }

    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/event/users",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="活动参与者列表",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *          @SWG\Parameter(
     *           name="access_token",
     *           description="登录access_token",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="id",
     *           description="活动ID",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="status",
     *           description="类型:1 待审核 2 成功 3 失败",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function getUsers () {
        $data = Input::all();
        $rules = array(
            'id' => 'required|exists:events,id',
           // 'access_token' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        //$rs = parent::validateAcessToken($data['access_token']);
        //$user_id = $rs['user_id'];
        $num = isset($data['num']) ? $data['num'] : 20;
        $rs =EventService::getInstance()->getJoinUsers ($data,$num);
        return response()->forApi($rs);
    }






}