<?php

namespace App\Websupply;

use App\Lib\LibUtil;
use DB;
class FolderWebsupply extends CmWebsupply {

	//获取最新推荐的文件夹(所有人) 
	public static function get_recommend($num=3,$gnum = 0){
		 $folders = DB::table('folders')->where([
				'folders.is_recommend'=>1,'folders.private'=>0,	
				])->orderBy('folders.updated_at','desc')->take($num)->get();
		 foreach ($folders as $key => $value) {
		 	$imageId = $value['image_id'];
		 	$id = $value['id'];
		 	if(!empty($gnum)){
		 		$goods = DB::table('goods')->where('folder_id',$id)->take($gnum)->select('id','image_ids')->get();
		 		foreach ($goods as $k => $v) {
		 			if(strpos($v['image_ids'],',') == 0){
		 				$goods[$k]['image_url'] = LibUtil::getPicUrl($v['image_ids'], 1);
		 			}
		 		}
		 		$folders[$key]['goods'] = $goods;
		 	}
		 	
		 	$folders[$key]['img_url'] = LibUtil::getPicUrl($imageId, 1);
		 }
		 return $folders;
	}	

	//获取用户自己的所有文件夹 含文件夹图片
	public static function get_user_folder($user_id,$fnum = 4,$gnum = 0){
		if($fnum='all'){
			$folders = DB::table('folders')->where([
				'user_id'=>$user_id
				])->orderBy('folders.updated_at','desc')->get();
		}else{
		 	$folders = DB::table('folders')->where([
				'user_id'=>$user_id
				])->orderBy('folders.updated_at','desc')->take($fnum)->get();
		}

		 
		 foreach ($folders as $key => $value) {
		 	$imageId = $value['image_id'];
		 	$folders[$key]['img_url'] = LibUtil::getPicUrl($value['image_id'], 1);
		 	$id = $value['id'];
		 	if(!empty($gnum)){
		 		$goods = DB::table('goods')->where('folder_id',$id)->select('id','image_ids')->take($gnum)->get();
			 		foreach ($goods as $k => $v) {
			 			if(strpos($v['image_ids'],',') == 0){
			 				$goods[$k]['image_url'] = LibUtil::getPicUrl($v['image_ids'], 1);
			 			}
			 		}
		 		$folders[$key]['goods'] = $goods;		 	
			 	$folders[$key]['img_url'] = LibUtil::getPicUrl($imageId, 1);
			}
		 }
		return $folders;
	}	

	
}