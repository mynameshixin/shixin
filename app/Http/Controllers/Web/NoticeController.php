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

	public function postIndex(){
		$data = Input::all();
        $rules = array(
            'num'                  => 'integer',
            'msg_kind'                  => 'integer',
            'status'                  => 'integer',
            'user_id'=>'required'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');

        $num = isset($data['num']) ? $data['num'] : 0;
        $msg_kind =  isset($data['msg_kind']) ? $data['msg_kind'] : '';
        $status = isset($data['status']) ? $data['status'] : null;
        $outDate =  MessageService::getInstance()->getMessageByPage ($user_id,$status,$msg_kind,$num);
        foreach ($outDate['list'] as $key => $value) {
        	$innertime = time() - strtotime($value['created_at']);
            $outDate['list'][$key]['min'] = self::cpu_time($innertime);
        }
        return response()->forApi($outDate);
	}

	public function cpu_time($time){

        if($time < 60) return $time.'秒';
        if($time >= 60 && $time < 3600) return floor($time/60).'分钟';
        if($time >= 3600 && $time < 3600*24) return floor($time/3600).'小时';
        if($time >= 3600*24) return floor($time/(3600*24)).'天';
    }


}