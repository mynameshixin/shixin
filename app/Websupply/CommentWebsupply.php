<?php

namespace App\Websupply;

use App\Lib\LibUtil;
use App\Websupply\UserWebsupply;
use DB;
class CommentWebsupply {
	public static function getCommentFirst($good_ids)
    {
        if(is_array($good_ids)){
            $rows = DB::table('comments')->whereIn('good_id', $good_ids)->groupBy('good_id')->orderBy('id', 'desc')->get();
        }else{
            $rows = DB::table('comments')->where('good_id', $good_ids)->groupBy('good_id')->orderBy('id', 'desc')->get();
        }
        

        $list = [];
        if (!empty($rows)) {
            $userIds = array_column($rows, 'user_id');
            $userArr = UserWebsupply::user_info($userIds);
            foreach ($rows as $v) {
                if (isset($userArr[$v['user_id']])) {
                    $user = $userArr[$v['user_id']];
                    $v['user'] = $user;
                }
                if (!empty($v['image_ids'])) {
                    $image_ids = explode(',', $v['image_ids']);
                    foreach ($image_ids as $imageId) {
                        $img_o = LibUtil::getPicUrl($imageId, 4);
                        if (!empty($img_o)) {
                            $v['images'][] = [
                                'img_b' => LibUtil::getPicUrl($imageId, 2),
                                'img_o' => $img_o
                            ];
                        }

                    }
                }
                $list[$v['good_id']] = $v;
            }
        }
        return $list;
    }
	
}