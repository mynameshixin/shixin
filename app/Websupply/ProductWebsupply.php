<?php

namespace App\Websupply;

use App\Lib\LibUtil;
use App\Lib\Images;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\CommentWebsupply;
use DB;

class ProductWebsupply extends CmWebsupply{
	private static $sources = ['0' => '用户发布', '1' => '淘宝网'];
	//获取商品信息
	public static function getProductsByFids($folder_ids,$user_ids,$params,$num,$self_id){
		$kind = isset($params['kind']) ? $params['kind'] : 1;
        $user_ids = array_unique($user_ids);
        $self_id  = !empty($self_id)?$self_id:0;

        $rows = DB::table('folder_goods')->where('kind', $kind);
        $rows = $rows->leftJoin('folders','folder_goods.folder_id','=','folders.id');
        if (empty($folder_ids)) {
            $rows = $rows->whereIn('folder_goods.user_id',$user_ids);
        }else{
            $rows = $rows->where(function ($rows) use ($user_ids,$folder_ids,$self_id) {
                $rows = $rows->whereIn('folder_goods.user_id',$user_ids)
                    ->orwhereIn('folder_goods.folder_id',$folder_ids);
            });
        }        

        $rows = $rows->select('folder_goods.id','folder_goods.good_id','folder_goods.user_id','folder_goods.folder_id','folder_goods.created_at','folders.private','folders.name')->orderBy('folder_goods.created_at','desc');
        // $rows = $rows->paginate($num);
        $skip = ($params['page']-1)*10;

        $rows = $rows->skip($skip)->take($num)->get();
        // $outDate = LibUtil::pageFomate($rows);

        foreach ($rows as $key => $value) {
            if($value['private'] == 1 && $self_id != $value['user_id']){
                unset($rows[$key]);
            }
            
        }

        $outDate = [];
        if (!empty($rows)) {
            $params['ids'] = $product_ids = array_column($rows, 'good_id');
            $list = self::getProductListByIds($product_ids, $params,false);
            $user_ids = array_column($rows, 'user_id');
            $userArr = UserWebsupply::user_info($user_ids);
            $arr = [];
            foreach ($rows  as $v) {
                if (isset($list[$v['good_id']])) {
                    $good = $list[$v['good_id']];
                    if (isset($userArr[$v['user_id']])) $good['user'] = $userArr[$v['user_id']] ;
                    $good['folder_name'] = $v['name'];
                    $good['folder_id'] = $v['folder_id'];
                    $good['created_at'] = $v['created_at'];
                    $arr[] =$good;
                }
            }
            $outDate['list'] = $arr;
        }

        return $outDate;
	}

	public static function getProductListByIds($product_ids, $params = [],$user_info=true)
    {
        $rows = DB::table('goods')->whereIn('id', $product_ids);
        //$condtion = [];
        $condtion = ['is_delete' => 0,'status'=>1];
        if (isset($params['kind'])) $condtion['kind'] = $params['kind'];
        if (isset($params['user_id'])) $condtion['user_id'] = $params['user_id'];
        if (!empty($condtion)) $rows = $rows->where($condtion);

        $rows = $rows->select('id', 'user_id', 'folder_id', 'kind', 'price', 'reserve_price', 'image_ids', 'title', 'tags', 'category_id', 'description', 'source', 'is_recommend', 'collection_count', 'praise_count', 'boo_count', 'detail_url', 'created_at');
        $rows = $rows->get();
        $list = [];
        if (!empty($rows)) {
            if ($user_info) {
                $user_ids = array_column($rows, 'user_id');
                $userArr = UserWebsupply::user_info($user_ids);
            }

            $folder_ids = array_column($rows, 'folder_id');
            $folderArr = DB::table('folders')->whereIn('id', $folder_ids)->lists('name', 'id');
            $commentArr = CommentWebsupply::getCommentFirst($product_ids);
            
            foreach ($rows as $row) {
                //$row['folder_name'] = isset($folderArr[$row['folder_id']]) ? $folderArr[$row['folder_id']] : '';
                $row['source'] = isset(self::$sources[$row['source']]) ? self::$sources[$row['source']] : '';
                if (isset($commentArr[$row['id']])) $row['comment'] = $commentArr[$row['id']];
                if (!empty($row['image_ids'])) {
                    $image_ids = explode(',', $row['image_ids']);
                    foreach ($image_ids as $imageId) {
                        $image_o = LibUtil::getPicUrl($imageId, 3);
                        if (!empty($image_o)) {
                            $row['images'][] = [
                                'image_id'=>$imageId,
                                'name' => isset($fileNames[$imageId]) ? $fileNames[$imageId] : '',
                                'img_m' => LibUtil::getPicUrl($imageId, 1),
                                'img_o' => $image_o
                            ];
                        }
                    }
                }
                $row['user'] = isset($userArr[$row['user_id']]) ? $userArr[$row['user_id']] : [];
                $list[$row['id']] = $row;

            }
        }

        return $list;
    }
    // 该采集也在以下文件夹
    public static function get_folder_detail($self_id,$data,$good_id){
        $num = isset($data['num'])?$data['num']:4;
        $page = isset($data['page'])?$data['page']:1;
        $skip = ($page-1)*$num;
        $id = $data['img_id'];
        $other_id = $data['oid'];
        $collection = DB::table('collection_good')->orderBy('updated_at','desc')->where('good_id',$good_id)->skip($skip)->take($num)->get();
        foreach ($collection as $key => $value) {
            $collection[$key] = self::get_collection_folder($value['folder_id'],$value['user_id'],$other_id,$self_id,$data);
        }
        return $collection;
    }

    //获得关系
    public static function get_relation($user_id,$self_id){
        $follow = DB::table('user_follow')->where(['userid_follow'=>$user_id,'user_id'=>$self_id])->first();
        $fans = DB::table('user_follow')->where(['user_id'=>$user_id,'userid_follow'=>$self_id])->first();
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
        return $relation;
    }

    //获得图片详细
    public static function get_pic_detail($self_id,$data){
        $id = $data['img_id'];
        $other_id = $data['oid'];
        $goods = DB::table('goods')->where(['id'=>$id])->first();
        if($goods){
            if (!empty($goods['image_ids'])) {
                    $image_ids = explode(',', $goods['image_ids']);
                    foreach ($image_ids as $imageId) {
                        $image_o = LibUtil::getPicUrl($imageId, 3);
                        $goods['images'][] = [
                                'img_m' => LibUtil::getPicUrl($imageId, 1),
                                'img_o' => $image_o
                            ];
                    }
                }
            $folder_id = $goods['folder_id'];
            $goods['user'] = $user = UserWebsupply::user_info($goods['user_id']);

            $goods['relation'] = self::get_relation($goods['user_id'],$self_id);

            $goods['more'] = self::get_more_goods($folder_id,$data);
            $comments = DB::table('comments')->where(['good_id'=>$id])->get();
            foreach ($comments as $key => $value) {
                $comments[$key]['user'] = UserWebsupply::user_info($value['user_id']);
            }
            $goods['comments'] = $comments;

            $goods['collection_folders'] = [];
            $collection_folders = self::get_folder_detail($self_id,$data,$goods['id']);
            if(!empty($collection_folders)) $goods['collection_folders'] = $collection_folders;

            $fid = isset($collection[0]['folder_id'])?$collection[0]['folder_id']:0;

            $goods['folders_one'] = [];
            if(!empty($fid)) $goods['folders_one'] = self::get_folder_file($fid,$other_id,$collection[0]['user_id'],$data);
            $goods['folder'] = DB::table('folders')->where('id',$goods['folder_id'])->first();
            
        }

        return $goods;
    }

    // 获得该文件夹的其他文件
    public static function get_more_goods($folder_id){
        $page = isset($data['page'])?$data['page']:1;
        $num = isset($data['num'])?$data['num']:15;
        $skip = ($page-1)*$num;
        $goods = DB::table('goods')->where(['folder_id'=>$folder_id])->select('image_ids','id')->get();
        foreach ($goods as $k => $v) {
            if(strpos($v['image_ids'],',') == 0){
                    $goods[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_ids'], 1))?LibUtil::getPicUrl($v['image_ids'], 1):url('uploads/sundry/blogo.jpg');
                }
        }
        return $goods;
    }

    //获取采集的文件夹 含文件夹图片
    public static function get_collection_folder($folder_id,$user_id,$other_id,$self_id,$data,$fnum = 8,$gnum = 3){

        $arr = [
            'id'=>$folder_id
        ];
        if($other_id!=$self_id) $arr['private'] = 0;
        $folders = DB::table('folders')->where($arr)->first();
        if(!empty($folders)){
            $id = $folders['id'];
            $imageId = $folders['image_id'];
            $img_url = LibUtil::getPicUrl($imageId, 1);
            $folders['img_url'] = !empty($img_url)?$img_url:url('uploads/sundry/blogo.jpg');
            $follow = DB::table('collection_folder')->where(['user_id'=>$self_id,'folder_id'=>$id])->first();
            $folders['is_follow'] = !empty($follow)?1:0;
            if(!empty($gnum) && !empty($id)){
                $goods = DB::table('goods')->where('folder_id',$id)->select('id','image_ids')->take($gnum)->get();
                    foreach ($goods as $k => $v) {
                        if(strpos($v['image_ids'],',') == 0){
                            $goods[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_ids'], 1))?LibUtil::getPicUrl($v['image_ids'], 1):url('uploads/sundry/blogo.jpg');
                        }
                    }
                $folders['goods'] = $goods;         
            }
            $folders['user'] = UserWebsupply::user_info($user_id);
            $follow = DB::table('collection_folder')->where(['folder_id'=>$id,'user_id'=>$self_id])->first();
            $folders['is_follow'] = $follow?1:0;
        }
        return $folders;

    }   
  
    //通过文件夹id获取文件
    public static function get_folder_file($folder_id,$other_id,$user_id,$data){

        $page = isset($data['page'])?$data['page']:1;
        $num = isset($data['num'])?$data['num']:15;
        $skip = ($page-1)*$num;
        $condition =['id'=>$folder_id];
        if($other_id!=$user_id) $condition['private'] = 0;
        $folder = DB::table('folders')->where($condition)->first();

        $goods = [];
        if($folder){
            $id = $folder['id'];
            $goods = DB::table('goods')->where('folder_id',$id)->orderBy('created_at','desc')->skip($skip)->take($num)->get();
            foreach ($goods as $k => $v) {
                if(strpos($v['image_ids'],',') == 0){
                    $goods[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_ids'], 1))?LibUtil::getPicUrl($v['image_ids'], 1):url('uploads/sundry/blogo.jpg');
                }
                $goods[$k]['collection_good'] = $collection = DB::table('collection_good as cg')->join('users as u','cg.user_id','=','u.id')->join('folders as f','cg.folder_id','=','f.id')->where('cg.good_id',$v['id'])->orderBy('cg.created_at','desc')->take(3)->get();
                foreach ($collection as $key => $value) {
                    $goods[$k]['collection_good'][$key] = UserWebsupply::user_info($value['user_id']);
                }
             }
            
        }
        return $goods;
    }

}