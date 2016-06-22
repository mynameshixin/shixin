<?php

namespace App\Websupply;

use App\Lib\LibUtil;
use DB;
use App\Websupply\CommentWebsupply;
use App\Websupply\UserWebsupply;
class FolderWebsupply extends CmWebsupply {

	//获取最新推荐的文件夹(所有人) 
	public static function get_recommend($num=3,$gnum = 0,$condition = [],$user = [],$goods=[]){
		 $folders = DB::table('folders')->where([
				'folders.private'=>0
				])->whereIn('folders.id',['213','380','120','233','443','300','340','58','396','229','1748','114','484','111','508'])->orderByRaw(DB::raw("FIELD(id,'213','380','120','233','443','300','340','58','396','229','1748','114','484','111','508')"));
		 if(!empty($condition) && !empty($condition['group'])){
		 	$folders = $folders->groupBy($condition['group']);
		 }
		 $folders  =$folders->take($num)->get();
		 foreach ($folders as $key => $value) {
		 	$imageId = $value['image_id'];
		 	$id = $value['id'];
		 	if(!empty($gnum)){
		 		$goods = DB::table('goods')->where('folder_id',$id)->take($gnum)->select('id','image_ids')->get();
		 		foreach ($goods as $k => $v) {
		 			if(strpos($v['image_ids'],',') == 0){
		 				$goods[$k]['image_url'] = LibUtil::getPicUrl($v['image_ids'], 1);
		 			}else{
		 				$goods[$k]['image_url'] = url('uploads/sundry/blogo.jpg');
		 			}
		 		}
		 		$folders[$key]['goods'] = $goods;
		 	}
		 	//获取该文件夹的用户
		 	if(!empty($user)){
		 		$user = DB::table('users')->where('id',$value['user_id'])->select('id','username','nick')->first();
		 		$user['image'] = LibUtil::getUserAvatar($user['id'],2);
		 		$folders[$key]['user'] = $user;
		 		$folders[$key]['count'] = UserWebsupply::get_count(['fans_count','folder_count'],$user['id']);
		 	}
		 	if(!empty($goods)){
		 		$folder_goods = DB::table('folder_goods as fg')->join('goods as g','fg.good_id','=','g.id')->where(['fg.folder_id'=>$id,'fg.user_id'=>$value['user_id']])->select('g.id','g.image_ids')->take(3)->get();
		 		foreach($folder_goods as $k=>$v){
		 			if (!empty($v['image_ids'])) {
	                    $image_ids = explode(',', $v['image_ids']);
	                    foreach ($image_ids as $imageId) {
	                        $image_o = LibUtil::getPicUrl($imageId, 3);
	                        if (!empty($image_o)) {
	                            $folder_goods[$k]['images'][] = [
	                                'image_id'=>$imageId,
	                                'img_m' => LibUtil::getPicUrl($imageId, 1),
	                                'img_o' => $image_o
	                            ];
	                        }
	                   	 }
	                }
		 		}
		 		$folders[$key]['goods'] = $folder_goods;
		 	}
		 	$folders[$key]['img_url'] = LibUtil::getPicUrl($imageId, 1);
		 }
		 return $folders;
	}	

	//获取用户文件夹 含文件夹图片
	public static function get_user_folder($user_id,$fnum = 4,$gnum = 0){

		$folders = DB::table('folders')->where([
				'user_id'=>$user_id,'private'=>0
				])->orderBy('folders.updated_at','desc')->take($fnum)->get();

		for ($i=0; $i < $fnum; $i++) { 
			$imageId = isset($folders[$i]['image_id'])?$folders[$i]['image_id']:0;
			$img_url = LibUtil::getPicUrl($imageId, 1);
			$folders[$i]['img_url'] = !empty($img_url)?$img_url:url('uploads/sundry/blogo.jpg');
			$id = isset($folders[$i]['id'])?$folders[$i]['id']:0;
			$user_id = isset($folders[$i]['user_id'])?$folders[$i]['user_id']:0;
			if(!empty($gnum) && !empty($id)){
		 		/*$goods = DB::table('goods')->where('folder_id',$id)->select('id','image_ids')->take($gnum)->get();
		 		if(count($goods)<$gnum){
	                $cg = DB::table('collection_good as cg')->join('goods as g','cg.good_id','=','g.id')->where(['cg.folder_id'=>$id,'cg.user_id'=>$user_id])->select('g.id','g.image_ids')->take($gnum - count($goods))->get();
	                $goods = $cg+$goods;
            	} */
		 		$goods = DB::table('folder_goods as fg')->join('goods as g','fg.good_id','=','g.id')->where(['fg.user_id'=>$user_id,'fg.folder_id'=>$id])->take($gnum)->select('g.id','g.image_ids')->orderBy('fg.created_at','desc')->get();
			 		foreach ($goods as $k => $v) {
			 			if(strpos($v['image_ids'],',') == 0){
			 				$goods[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_ids'], 1))?LibUtil::getPicUrl($v['image_ids'], 1):url('uploads/sundry/blogo.jpg');
			 			}else{
			 				$goods[$k]['image_url'] = url('uploads/sundry/blogo.jpg');
			 			}
			 		}
		 		$folders[$i]['goods'] = $goods;		 	
			 	$folders[$i]['img_url'] = LibUtil::getPicUrl($imageId, 1);
			}


		}

		return $folders;
	}	

	//获取用户首页的文件夹 含文件夹图片
	public static function get_user_index_folder($user_id,$fnum = 10,$gnum = 0,$data,$self_id){
		$page = isset($data['page'])?$data['page']:1;
    	$skip = ($page-1)*$fnum;
    	$arr = [
    		'user_id'=>$user_id,
    		'private'=>$data['private']
    	];
    	
		$folders = DB::table('folders')->where($arr)->orderBy('folders.updated_at','desc')->skip($skip)->take($fnum)->get();

		foreach ($folders as $i => $value) {
			$imageId = $value['image_id'];
			$img_url = LibUtil::getPicUrl($imageId, 1);
			$folders[$i]['img_url'] = !empty($img_url)?$img_url:url('uploads/sundry/blogo.jpg');
			$id = isset($folders[$i]['id'])?$folders[$i]['id']:0;
			$follow = DB::table('collection_folder')->where(['user_id'=>$self_id,'folder_id'=>$id])->first();
			$folders[$i]['is_follow'] = !empty($follow)?1:0;
			//$folders[$i]['count'] = DB::table('goods')->where('folder_id',$id)->count();
			if(!empty($gnum) && !empty($id)){
		 		/*$goods = DB::table('goods')->where('folder_id',$id)->select('id','image_ids')->take($gnum)->get();
		 		if(count($goods)<$gnum){
	                $cg = DB::table('collection_good as cg')->join('goods as g','cg.good_id','=','g.id')->where(['cg.folder_id'=>$id,'cg.user_id'=>$value['user_id']])->select('g.id','g.image_ids')->take($gnum - count($goods))->get();
	                $goods = $cg+$goods;
            	} */
            	$goods = DB::table('folder_goods as fg')->join('goods as g','fg.good_id','=','g.id')->where(['fg.user_id'=>$value['user_id'],'fg.folder_id'=>$id])->take($gnum)->select('g.id','g.image_ids')->orderBy('fg.created_at','desc')->get();
		 		foreach ($goods as $k => $v) {
		 			if(strpos($v['image_ids'],',') == 0){
		 				$goods[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_ids'], 1))?LibUtil::getPicUrl($v['image_ids'], 1):url('uploads/sundry/blogo.jpg');
		 			}else{
		 				$goods[$k]['image_url'] = url('uploads/sundry/blogo.jpg');
		 			}
		 		}
		 		$folders[$i]['goods'] = $goods;		 	
			}
		}
	
		return $folders;
	}	

	

	//通过文件夹id获取文件
	public static function get_folder_file($folder_id,$user_id,$data){
		$page = isset($data['page'])?$data['page']:1;
		$num = isset($data['num'])?$data['num']:15;
    	$skip = ($page-1)*$num;
		$folder = DB::table('folders')->where(['id'=>$folder_id])->first();
		if($folder){
			if($folder['user_id']!=$user_id && $folder['private'] == 1) return [];
			$folder['user_info'] = UserWebsupply::user_info($folder['user_id']);
			$imageId = $folder['image_id'];
			$img_url = LibUtil::getPicUrl($imageId, 1);
			$folder['img_url'] = !empty($img_url)?$img_url:url('uploads/sundry/blogo.jpg');
			$id = $folder['id'];
			$follow = DB::table('collection_folder')->where(['user_id'=>$user_id,'folder_id'=>$id])->first();
			$folder['is_follow'] = !empty($follow)?1:0;
			if($data['kind'] == 1){
				$goods = DB::table('folder_goods as fg')->join('goods as g','fg.good_id','=','g.id')->where(['fg.user_id'=>$folder['user_id'],'fg.folder_id'=>$id])->skip($skip)->take($num)->select('g.*')->orderBy('fg.created_at','desc');
				$o = "";
				if(isset($data['o']) && $data['o']==1){
					$goods = $goods->where('g.kind',1);
					$count = DB::table('folder_goods as fg')->join('goods as g','fg.good_id','=','g.id')->where(['fg.user_id'=>$folder['user_id'],'fg.folder_id'=>$id])->select('g.id')->where('g.kind',1)->get();
					$folder['file_count'] = count($count);
					// var_dump(count($count));
				}else{
					$count = DB::table('folder_goods as fg')->join('goods as g','fg.good_id','=','g.id')->where(['fg.user_id'=>$folder['user_id'],'fg.folder_id'=>$id])->select('g.id')->get();
					$folder['file_count'] = count($count);
					// var_dump(count($count));
				}
				$goods= $goods->get();

			 	/*$goods = DB::select("select * from goods as g where g.folder_id = {$id} {$o} union all select g.* from collection_good as cg join goods as g on cg.good_id=g.id where cg.folder_id={$id} and cg.user_id = {$folder['user_id']} {$o} order by created_at desc limit {$skip},{$num}");*/
			 	/*$file_count = DB::select("select count(id) as co from (select g.id from goods as g where g.folder_id = {$id} {$o} union all select g.id from collection_good as cg join goods as g on cg.good_id=g.id where cg.folder_id={$id} and cg.user_id = {$folder['user_id']} {$o}) as c");
			 	$folder['file_count'] = $file_count[0]['co'];*/

				foreach ($goods as $k => $v) {
					$commentArr = CommentWebsupply::getCommentFirst($v['id']);
					$goods[$k]['comment'] = $commentArr;
					if (!empty($v['image_ids'])) {
	                    $image_ids = explode(',', $v['image_ids']);
	                    foreach ($image_ids as $imageId) {
	                        $image_o = LibUtil::getPicUrl($imageId, 3);
	                        if (!empty($image_o)) {
	                            $goods[$k]['images'][] = [
	                                'image_id'=>$imageId,
	                                'img_m' => LibUtil::getPicUrl($imageId, 1),
	                                'img_o' => $image_o
	                            ];
	                        }
	                   	 }
	                }
				 }
		 		$folder['goods'] = $goods;
		 	}
		 	//$folder['file_count'] = DB::table('goods')->where(['folder_id'=>$folder_id,'user_id'=>$folder['user_id']])->count();
	 		$folder['fans_count'] = DB::table('collection_folder')->where('folder_id',$folder_id)->count();
		}
		
		return $folder;
	}

	//通过文件夹id获取粉丝人
	public static function get_folder_fans($folder_id,$self_id=0,$data){
		$page = isset($data['page'])?$data['page']:1;
		$num = isset($data['num'])?$data['num']:15;
    	$skip = ($page-1)*$num;
		$condition =['folder_id'=>$folder_id];
		$user_info = DB::table('collection_folder')->where($condition)->get();

		if($user_info){
			foreach ($user_info as $key => $value) {
				$id  = $value['user_id'];
				$follow = DB::table('user_follow')->where(['userid_follow'=>$id,'user_id'=>$self_id])->first();
	    		$fans = DB::table('user_follow')->where(['user_id'=>$id,'userid_follow'=>$self_id])->first();
	    		//$relation 1 相互关注 2 已关注 3被关注 4未关注
	    		$relation = 4;
	    		if($follow && $fans){
	    			$relation = 1;
	    		}elseif($follow && !$fans){
	    			$relation = 2;
	    		}elseif(!$follow && $fans){
	    			$relation = 3;
	    		}else{
	    			$relation = 4;
	    		}
	    		$user_info[$key]['user'] = UserWebsupply::user_info($id);
	    		$user_info[$key]['relation'] = $relation;
	    		$user_info[$key]['count'] = UserWebsupply::get_count(['fans_count','follow_count'],$value['user_id']);
	    		$user_info[$key]['folders'] = self::get_user_folder($value['user_id'],4,0);
			}
		}
		
		return $user_info;
	}
	
}