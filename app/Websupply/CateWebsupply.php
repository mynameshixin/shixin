<?php

namespace App\Websupply;

use App\Lib\LibUtil;
use App\Websupply\UserWebsupply;
use DB;
//获取带图的分类
class CateWebsupply {
	public static function getCate($num){
        $cate = DB::select('select * from categories where length(name) < 9 and hot = 2 order by recommend desc limit '.$num);
        foreach ($cate as $key => $value) {
            $image_id  = $value['image_id'];
            $cate[$key]['imageurl'] = LibUtil::getPicUrl($image_id,1);
        }
        return $cate;
    }
    
	
}