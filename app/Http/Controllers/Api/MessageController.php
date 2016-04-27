<?php
namespace App\Http\Controllers\Api;

use App\Models\UserContact;
use App\Services\MessageService;
use Illuminate\Support\Facades\Input;

use App\SystemMsg;


/**
 *
 * @SWG\Resource(
 *  resourcePath="/messages",
 * )
 */
class MessageController extends BaseController
{
    private static $user_id;

    public function __construct()
    {
        $access_token = Input::get('access_token');
        $rs = parent::validateAcessToken($access_token);
        self::$user_id = $rs['user_id'];
    }
    /**
     *
     * @SWG\Api(
     *   path="/messages",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="消息列表",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
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
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function index ()
    {
        $data = Input::all();
        $rules = array(
            'num'                  => 'integer',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $num = isset($data['num']) ? $data['num'] : 0;
        $outDate =  MessageService::getInstance()->getMsgContact(self::$user_id, $num);
        return response()->forApi($outDate);
    }

    /**
     *
     * @SWG\Api(
     *   path="/messages/{ids}",
     *   @SWG\Operations(
     *    @SWG\Operation(
     *       method="DELETE",
     *       summary="删除聊天消息",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="id",
     *           description="标签ids,多个用','拼接",
     *            paramType="path",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="form",
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
        $data['id'] = explode(',',$id);
        $rules = array (
            'id' =>'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $rs = UserContact::whereIn('id',$data['id'])->where('user_id','=',self::$user_id)->delete();
        return response()->forApi(array('status'=>$rs ? 1 : 0));
    }

    /**
     *
     * @SWG\Api(
     *   path="/message/chat",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="聊天内容列表",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="contact_id",
     *           description="联系人id",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
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
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function getChat ()
    {
        $data = Input::all();
        $rules = array(
            'contact_id'=> 'required|integer',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $num = isset($data['num']) ? $data['num'] : 0;
        $outDate =  MessageService::getInstance()->getMsgChat(self::$user_id, $data['contact_id'], $num);
        return response()->forApi($outDate);
    }

    /**
     *
     * @SWG\Api(
     *   path="/message/chat",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="发送聊天消息",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="contact_id",
     *           description="联系人id",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="content",
     *           description="内容",
     *           paramType="query",
     *           required=true,
     *           type="integer"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function postChat ()
    {
        $data = Input::all();
        $rules = array(
            'contact_id'=> 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $outDate =  MessageService::getInstance()->sendMsg(self::$user_id,$data['contact_id'],$data['content']);
        return response()->forApi($outDate);
    }


}