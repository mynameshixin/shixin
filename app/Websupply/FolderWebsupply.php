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

	
}