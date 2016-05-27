<?php

namespace App\Websupply;

use App\Lib\LibUtil;
use App\Lib\Images;
use App\Websupply\CommentWebsupply;
use App\Websupply\FolderWebsupply;
use DB;

class UserWebsupply extends CmWebsupply{

	//获取用户信息
	public static function user_info($user_id){
		$Image = new Images();
		$userArr = [];
		if(is_array($user_id)){
			$users = DB::table('users')->whereIn('id', $user_id)->select('id', 'username', 'nick','gender','auth_avatar','wechat','signature')->get();
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
			$user = DB::table('users')->where('id', $user_id)->select('id', 'username', 'nick','gender','auth_avatar','wechat','signature')->first();
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
			if($value == 'collection_count') $count['collection_count'] = DB::table('collection_good')->where('user_id',$user_id)->count();
			if($value == 'folder_count') $count['folder_count'] = DB::table('folders')->where('user_id',$user_id)->count();
			if($value == 'fans_count') $count['fans_count'] = DB::table('user_follow')->where('userid_follow',$user_id)->count();
			if($value == 'follow_count') $count['follow_count'] = DB::table('user_follow')->where('user_id',$user_id)->count();
			if($value == 'praise_count') $count['praise_count'] = DB::table('good_action')->where(['user_id'=>$user_id,'action'=>1])->count();
			if($value == 'pub_count') $count['pub_count'] = DB::table('goods')->where(['user_id'=>$user_id])->count();
		}
		return $count;

	}

	//获取用户
	public static function getAdminIds () {
        return DB::table('role_user')->whereIn('role_id',[1,2])->lists('user_id');
    }

    //获取用户喜欢的和发布的数据
    public static function get_user_lp($user_id,$num,$params){
    	$params['kind'] = isset($params['kind'])?$params['kind']:1;
    	switch ($params['kind']) {
    		case '1':
    			$rows =  DB::table('good_action')->leftJoin('goods','good_action.good_id','=','goods.id')->where(['good_action.user_id'=>$user_id,'good_action.action'=>1]);
  				$good_id = 'good_id';
    			break;
    		
    		case '2':
    			$rows =  DB::table('goods')->where(['user_id'=>$user_id])->orderBy('created_at','desc');
    			$good_id = 'id';
    			break;
    	}
    	
    	$skip = ($params['page']-1)*10;
    	$rows = $rows->skip($skip)->take($num)->get();

    	if(!empty($rows)){
    		foreach ($rows as $key => $v) {

		    	if (!empty($v['image_ids'])) {
		            $image_ids = explode(',', $v['image_ids']);

		            foreach ($image_ids as $imageId) {
		                    $rows[$key]['images'][] = [
		                        'image_id'=>$imageId,
		                        'img_m' => LibUtil::getPicUrl($imageId, 1),
		                    ];
		             }
		        }
		        $rows[$key]['comment'] = CommentWebsupply::getCommentFirst($v[$good_id]);
	       	}
        }
        $outDate = [];
        $outDate['list'] = $rows;
        // dd($outDate);
    	return $outDate;
    }


    public static function get_user_fans($user_id){
    	$user_fans = DB::table('user_follow')->where('userid_follow',$user_id)->get();

    	$user_ids = [];
    	$user_ids = array_map(function($v){
    		return $v['user_id'];
    	},$user_fans);
    	
    	$user_info = self::user_info($user_ids);

    	foreach ($user_info as $key => $value) {
    		$user_info[$key]['count'] = self::get_count(['fans_count','follow_count'],$value['id']);
    		$user_info[$key]['folders'] = FolderWebsupply::get_user_folder($value['id'],4,0);
    	}
    	return $user_info;
    }


}