<?php

namespace App\Websupply;

use App\Lib\LibUtil;
use App\Lib\Images;
use DB;

class UserWebsupply extends CmWebsupply{

	//获取用户信息
	public static function user_info($user_id){
		$Image = new Images();
		$userArr = [];
		if(is_array($user_id)){
			$users = DB::table('users')->whereIn('id', $user_id)->select('id', 'username', 'nick','gender','auth_avatar','wechat')->get();
			if (!empty($users)) {
				foreach ($users as $user) {
					$user['pic_m'] = LibUtil::getUserAvatar($user['id'], 1);
	                if (empty($user['pic_m']) && !empty($user['auth_avatar'])) {
	                    $user['pic_m'] = $user['auth_avatar'];
	                    unset($user['auth_avatar']);
	                }
	                if(empty($user['pic_m']) && empty($user['auth_avatar'])){
	                	$user['pic_m'] = url('uploads/sundry/blogo.jpg');
	                }
	                $userArr[$user['id']] = $user;
				}
			}

		}else{
			$user = DB::table('users')->where('id', $user_id)->select('id', 'username', 'nick','gender','auth_avatar','wechat')->first();
			if (!empty($user)) {
				$user['pic_m'] = LibUtil::getUserAvatar($user['id'], 1);
	                if (empty($user['pic_m']) && !empty($user['auth_avatar'])) {
	                    $user['pic_m'] = $user['auth_avatar'];
	                    unset($user['auth_avatar']);
	                }
	                if(empty($user['pic_m']) && empty($user['auth_avatar'])){
	                	$user['pic_m'] = url('uploads/sundry/blogo.jpg');
	                }
	            $userArr = $user;
			}
		}
        return $userArr;
	}

	//获取用户统计信息 收藏、文件夹、粉丝数
	public static function get_count($alias = [],$user_id){
		$count = [];
		foreach ($alias as $key => $value) {
			if($key == 'collection_count') $count['collection_count'] = DB::table('collection_good')->where('user_id',$user_id)->count();
			if($key == 'folder_count') $count['folder_count'] = DB::table('folders')->where('user_id',$user_id)->count();
			if($key == 'follow_count') $count['follow_count'] = DB::table('user_follow')->where('userid_follow',$user_id)->count();
		}
		return $count;

	}

	//获取用户
	public static function getAdminIds () {
        return DB::table('role_user')->whereIn('role_id',[1,2])->lists('user_id');
    }


}