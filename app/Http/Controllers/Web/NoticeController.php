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
        $res = DB::table('system_msgs')->where('to_userid',$user_id)->where('status',0)->take($num)->orderBy('created_at', 'desc')->get();
        if(!empty($res)) return response()->forApi([],1001,'有新通知');
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
        $outDate =  MessageService::getInstance()->getMessageByPage ($user_id,$status,$msg_kind,$num);
        foreach ($outDate['list'] as $key => $value) {
            $id = $value['id'];
            if($editstatus == 1){
                DB::table('system_msgs')->where('id',$id)->update(['status'=>1]);
            }
        	$innertime = time() - strtotime($value['created_at']);
            $outDate['list'][$key]['min'] = self::cpu_time($innertime);
        }
        return response()->forApi($outDate);
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


}