<?php
namespace App\Http\Controllers\Api;

use App\Services\MessageService;
use Illuminate\Support\Facades\Input;

use App\SystemMsg;
use DB;

/**
 *
 * @SWG\Resource(
 *  resourcePath="/notices",
 * )
 */
class NoticeController extends BaseController
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
     *   path="/notices",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="通知列表",
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
     *           name="msg_kind",
     *           description="通知类型：1 系统通知 ",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *        @SWG\Parameter(
     *           name="status",
     *           description="消息状态：0 未读 ，1 已读",
     *           paramType="query",
     *           required=false,
     *           type="integer"
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
            'msg_kind'                  => 'integer',
            'status'                  => 'integer',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $num = isset($data['num']) ? $data['num'] : 0;
        $msg_kind =  isset($data['msg_kind']) ? $data['msg_kind'] : '';
        $status = isset($data['status']) ? $data['status'] : null;
        $outDate =  MessageService::getInstance()->getMessageByPage (self::$user_id,$status,$msg_kind,$num);
        return response()->forApi($outDate);
    }
    //返回更新为已读
    public function postSetstatus (){
        $data = Input::all();
        $rules = array(
            'access_token'                  => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);

        $rs = DB::table('system_msgs')->where('to_userid',self::$user_id)->update(['status'=>1]);
        if($rs){
            return response()->forApi(array('status'=>1));
        }
        
    }

    /**
     *
     * @SWG\Api(
     *   path="/notices/{ids}",
     *   @SWG\Operations(
     *    @SWG\Operation(
     *       method="DELETE",
     *       summary="删除系统消息",
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
        $rs = SystemMsg::whereIn('id',$data['id'])->where('to_userid','=',self::$user_id)->delete();
        return response()->forApi(array('status'=>$rs ? 1 : 0));
    }
}