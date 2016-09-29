<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use App\Websupply\CateWebsupply;
use App\Services\MessageService;
use DB;

class NoticeController extends CmController{
    // 检测通知
    public function postCheck(){
        $data = Input::all();
        $rules = array(
            'num'=> 'integer',
            'user_id'=>'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        if(empty($user_id)) return response()->forApi([],1001,'不存在的用户');
        $num = isset($data['num']) ? $data['num'] : 0;
        $system_msgs = DB::table('system_msgs')->where('to_userid',$user_id)->where('status',0)->take($num)->orderBy('created_at', 'desc')->get();
        $messages = DB::table('messages')->where('to_id',$user_id)->where('status',0)->take($num)->orderBy('created_at', 'desc')->get();
        if(!empty($system_msgs) || !empty($messages)) return response()->forApi([],1001,'有新通知');
        return response()->forApi(['status'=>1]);
    }

    // 获取通知信息
	public function postIndex(){
		$data = Input::all();
        $rules = array(
            'num'                  => 'integer',
            'msg_kind'                  => 'integer',
            'status'                  => 'integer',
            'user_id'=>'required',
            'editstatus'=>'integer'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');
        $editstatus = isset($data['editstatus']) ? $data['editstatus'] : 0;
        $num = isset($data['num']) ? $data['num'] : 0;
        $msg_kind =  isset($data['msg_kind']) ? $data['msg_kind'] : '';
        $status = isset($data['status']) ? $data['status'] : null;
        if($editstatus == 1){
            DB::table('system_msgs')->where('to_userid',$user_id)->update(['status'=>1]);
        }
        $outDate =  MessageService::getInstance()->getMessageByPage ($user_id,$status,$msg_kind,$num);
        foreach ($outDate['list'] as $key => $value) {
            $id = $value['id'];
        	$innertime = time() - strtotime($value['created_at']);
            $outDate['list'][$key]['min'] = self::cpu_time($innertime);
        }
        return response()->forApi($outDate);
	}

    // 头部获取留言信息
    public function postMsg(){
        $data = Input::all();
        $rules = array(
            'num' => 'integer',
            'page'=>'integer',
            'user_id'=>'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
        if(empty($user)) return response()->forApi([],1001,'不存在的用户');
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
            'user_id'=>'required',
            'to_id'=>'required'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
        if(empty($user)) return response()->forApi([],1001,'不存在的用户');

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
            'user_id'=>'required',
        );
        $pa = [
            'user_id.required'=>'没有登陆',
            'to_id.required'=>'没有传入留言人',
            'content.required'=>'留言信息为空',
        ];
        //请求参数验证
        parent::validator($data, $rules,$pa);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
        if(empty($user)) return response()->forApi([],1001,'不存在的用户');
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