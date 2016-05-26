<?php

namespace App\Websupply;

use App\Lib\LibUtil;
use App\Websupply\UserWebsupply;
use DB;
//获取带图的分类
class CateWebsupply {


    

    //热门搜索分类
     public static function getHot() {
         $rows = self::$db->orderBy('hot','desc')->take(6)->get();

         if (!empty($rows)) {
             foreach ($rows as $row) {
                 $entry = [
                     'id'=>$row['id'],
                     'level'=>$row['level'],
                     'parent_id'=>$row['parent_id'],
                     'name' => $row['name'],
                     //'img' => '',
                 ];
                 //if($row['image_id'])$entry['img'] = LibUtil::getPicUrl($row['image_id'],3);
                 $list[] = $entry;
             }
         }
         return $list;
     }
	
    //发现页获取分类
    public  static function getRecommend($num) {
         $cond = [];
         $cond['level'] = 2;
         $cond['recommend'] = 1;
         $rows = DB::table('categories')->where($cond)->take($num)->get();
         if (!empty($rows)) {
             foreach ($rows as $row) {
                 $entry = [
                     'id'=>$row['id'],
                     'level'=>$row['level'],
                     'parent_id'=>$row['parent_id'],
                     'name' => $row['name'],
                     'img' => '',
                 ];
                 if($row['image_id'])$entry['img'] = LibUtil::getPicUrl($row['image_id'],1);
                 $list[] = $entry;
             }
         }
         return $list;
     }

    //获取分类更多
    public static function getTree($num) {

         $list = self::getCategoryTree($pid = 0, $level = 1,$num);
         return $list;
     }


    /**
     * 分类树
     * @param int $pid
     * @param int $level
     * @param int $kind
     * @param array $perms
     * @return array
     */
    static function getCategoryTree($pid = 0, $level = 0,$num)
    {

        $data = DB::table('categories')->where(['parent_id' => $pid, 'level' => $level])->take($num)->get();
        //目录树
        $tree = array();
        //层级
        $level++;
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $entry = ['id' => $v['id'], 'name' => $v['name'],'name_e'=>$v['name_e'],'level' =>$v['level']];
                if($v['level']<2) {
                    $entry['children'] = self::getCategoryTree($v['id'], $level,$num*2);
                }

               // if($v['image_id'])$entry['img'] = LibUtil::getPicUrl($v['image_id'],3);

                $tree[] = $entry;
            }
        }
        //$tree = json_encode($tree);
        return $tree;
    }
}