<?php
namespace App\Http\Controllers\Api;

use App\Services\MessageService;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
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
        }else{
            return response()->forApi([],1001,'');
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


    // 头部获取留言信息
    public function postMsg(){
        $data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'num' => 'integer',
            'page'=>'integer'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::$user_id;
        $num = isset($data['num']) ? $data['num'] : 10;
        $page = isset($data['page']) ? $data['page'] : 1;
        $skip = ($page-1)*$num;
        $msgs = DB::select("select * from (select * from messages where to_id = {$user_id} order by created_at desc limit {$skip},{$num}) as r group by from_id");

        foreach ($msgs as $key => $value) {
            $id = $value['id'];
            DB::table('messages')->where('to_id',$user_id)->update(['status'=>1]);
            $innertime = time() - strtotime($value['created_at']);
            $msgs[$key]['min'] = self::cpu_time($innertime);
            $msgs[$key]['user'] = UserWebsupply::user_info($value['from_id']);
        }
        return response()->forApi($msgs);
    }

    // 具体获取留言信息(弹窗)
    public function postMsginner(){
        $data = Input::all();
        $rules = array(
            'to_id'=>'required',
            'access_token' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::$user_id;

        $msgs = DB::select("select created_at  from messages  GROUP BY DATE_FORMAT( created_at, \"%Y-%m-%d\" )  having datediff(curdate(), messages.created_at) < 30 ORDER BY created_at asc");

        $rmsg = [];
        foreach ($msgs as $key => $value) {
            $created_at = $value['created_at'];
            $innertime = time() - strtotime($created_at);
            $rmsg[$created_at]['min'] = self::cpu_date($innertime);
            $left = DB::select("select * from messages where DATE_FORMAT( created_at, \"%Y-%m-%d\") = DATE_FORMAT( \"{$created_at}\", \"%Y-%m-%d\") and to_id = {$user_id} and from_id={$data['to_id']}");
            $touser = UserWebsupply::user_info($data['to_id']);
            foreach ($left as $k => $v) {
                $left[$k]['user'] = $touser;
                $left[$k]['position'] = 'letter_ulleft';
            }

            $right = DB::select("select * from messages where DATE_FORMAT( created_at, \"%Y-%m-%d\") = DATE_FORMAT( \"{$created_at}\", \"%Y-%m-%d\") and to_id = {$data['to_id']} and from_id={$user_id}");

            $fromuser = UserWebsupply::user_info($user_id);
            foreach ($right as $k => $v) {
                $right[$k]['user'] = $fromuser;
                $right[$k]['position'] = 'letter_ulright';
            }
            $rmsg[$created_at]['adata'] = $adata = array_merge($left,$right);

            if(empty($rmsg[$created_at]['adata'])){
                unset($rmsg[$created_at]);
            }else{
                $cdate = [];
                foreach ($rmsg[$created_at]['adata'] as $key => $value) {
                    $cdate[$key] = $value['created_at'];
                }
                array_multisort($cdate,SORT_ASC,SORT_STRING,$rmsg[$created_at]['adata']);
            }
            
            
        }
        return response()->forApi($rmsg);
    }

    //给用户留言
    public function postMessages(){
        $data = Input::all();
        $rules = array(
            'content' => 'required',
            'to_id' => 'required',
            'access_token' => 'required'
        );
        $pa = [
            'access_token.required'=>'没有登陆',
            'to_id.required'=>'给谁留言',
            'content.required'=>'留言信息为空',
        ];
        //请求参数验证
        parent::validator($data, $rules,$pa);
        $user_id = self::$user_id;
        $date = date('Y-m-d H:i:s');
        DB::table('messages')->insert(['from_id'=>$user_id,'to_id'=>$data['to_id'],'content'=>$data['content'],'created_at'=>$date]);
        return response()->forApi(['status'=>1]);


    }
    public function cpu_time($time){

        if($time < 60) return $time.'秒';
        if($time >= 60 && $time < 3600) return floor($time/60).'分钟';
        if($time >= 3600 && $time < 3600*24) return floor($time/3600).'小时';
        if($time >= 3600*24) return floor($time/(3600*24)).'天';
    }

    public function cpu_date($time){

        if( $time < 3600*24) return '今天';
        if($time >= 3600*24) return floor($time/(3600*24)).'天前';
    }
}