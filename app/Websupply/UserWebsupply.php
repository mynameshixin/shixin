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
    			$rows =  DB::table('good_action')->join('goods','good_action.good_id','=','goods.id')->where(['good_action.user_id'=>$user_id,'good_action.action'=>1]);
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
		                        'img_m' => !empty(LibUtil::getPicUrl($imageId, 1))?LibUtil::getPicUrl($imageId, 1):self::$defaultPic,
		                    ];
		             }
		        }
		        $rows[$key]['comment'] = CommentWebsupply::getCommentFirst($v[$good_id]);
	       	}
        }

    	return $rows;
    }


    public static function get_user_fansfollow($user_id,$num = 15,$data){
    	$page = isset($data['page'])?$data['page']:1;
    	$kind = isset($data['kind'])?$data['kind']:1;
    	$skip = ($page-1)*$num;
    	
    	$user_ids = [];
    	switch ($kind) {
    		case '1':
    			$user = DB::table('user_follow')->where('userid_follow',$user_id)->skip($skip)->take($num)->get();
		    	$user_ids = array_map(function($v){
		    		return $v['user_id'];
		    	},$user);
    			break;
    		
    		case '2':
    			$user = DB::table('user_follow')->where('user_id',$user_id)->skip($skip)->take($num)->get();
    			$user_ids = array_map(function($v){
		    		return $v['userid_follow'];
		    	},$user);
    			break;
    	}
    	;
    	
    	$user_info = self::user_info($user_ids);
    	foreach ($user_info as $key => $value) {
    		$user_info[$key]['count'] = self::get_count(['fans_count','follow_count'],$value['id']);
    		$user_info[$key]['folders'] = FolderWebsupply::get_user_folder($value['id'],4,0);
    	}
    	sort($user_info);
    	return $user_info;
    }

    public static function get_follow_folder($user_id,$data,$num = 15,$gnum = 3){

    	$page = isset($data['page'])?$data['page']:1;
    	$skip = ($page-1)*$num;
    	$num = isset($data['num'])?$data['num']:$num;
    	$user_follow_folder = DB::table('collection_folder as cf')->join('folders as f','cf.folder_id','=','f.id')->join('users as u','f.user_id','=','u.id')->where('cf.user_id',$user_id)->groupBy('folder_id')->skip($skip)->take($num)->get();
    	

    	foreach ($user_follow_folder as $key => $value) {
    		$imageId = $value['image_id'];
    		$id = $value['folder_id'];
    		$img_url = LibUtil::getPicUrl($imageId, 1);
    		$user_follow_folder[$key]['user'] = self::user_info($value['user_id']);
    		$user_follow_folder[$key]['img_url'] = !empty($img_url)?$img_url:url('uploads/sundry/blogo.jpg');

		 	$goods = DB::table('goods')->where('folder_id',$id)->select('id','image_ids')->take($gnum)->get();
	 		foreach ($goods as $k => $v) {
	 			if(strpos($v['image_ids'],',') == 0){
	 				$goods[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_ids'], 1))?LibUtil::getPicUrl($v['image_ids'], 1):url('uploads/sundry/blogo.jpg');
	 			}
	 		}
		 	$user_follow_folder[$key]['folder_goods'] = $goods;		 	
    	}


    	return $user_follow_folder;
    }

}