<?php

namespace App\Websupply;

use App\Lib\LibUtil;
use DB;
class FolderWebsupply extends CmWebsupply {

	//获取最新推荐的文件夹(所有人) 
	public static function get_recommend(){
		 $folders = DB::table('folders')->where([
				'folders.is_recommend'=>1,'folders.private'=>0,	
				])->orderBy('folders.updated_at','desc')->take(3)->get();
		 foreach ($folders as $key => $value) {
		 	$imageId = $value['image_id'];
		 	$folders[$key]['img_url'] = LibUtil::getPicUrl($imageId, 1);
		 }
		 return $folders;
	}	
}