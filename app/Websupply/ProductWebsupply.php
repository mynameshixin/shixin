<?php

namespace App\Websupply;

use App\Lib\LibUtil;
use App\Lib\Images;
use App\Websupply\UserWebsupply;
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
        $rows = $rows->join('folders','folder_goods.folder_id','=','folders.id');
        if (empty($folder_ids)) {
            $rows = $rows->whereIn('folder_goods.user_id',$user_ids);
        }else{
            $rows = $rows->where(function ($rows) use ($user_ids,$folder_ids,$self_id) {
                $rows = $rows->whereIn('folder_goods.user_id',$user_ids)
                    ->orwhereIn('folder_goods.folder_id',$folder_ids);
            });
        }        

        $rows = $rows->select('folder_goods.id','folder_goods.good_id','folder_goods.user_id','folder_goods.folder_id','folder_goods.created_at','folders.private')->orderBy('folder_goods.created_at','desc');
        $rows = $rows->paginate($num);
        $outDate = LibUtil::pageFomate($rows);

        $count = 0;
        foreach ($outDate['list'] as $key => $value) {
            if($value['private'] == 1 && $self_id != $value['user_id']){
                unset($outDate['list'][$key]);
                $count++;
            }
            
        }
        $outDate['per_page'] = $num-$count;

        if (!empty($outDate['list'])) {
            $params['ids'] = $product_ids = array_column($outDate['list'], 'good_id');
            $list = self::getProductListByIds($product_ids, $params,false);
            $user_ids = array_column($outDate['list'], 'user_id');
            $userArr = UserWebsupply::user_info($user_ids);
            $arr = [];
            foreach ($outDate['list'] as $v) {
                if (isset($list[$v['good_id']])) {
                    $good = $list[$v['good_id']];
                    if (isset($userArr[$v['user_id']])) $good['user'] = $userArr[$v['user_id']] ;
 
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
                $row['folder_name'] = isset($folderArr[$row['folder_id']]) ? $folderArr[$row['folder_id']] : '';
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

}