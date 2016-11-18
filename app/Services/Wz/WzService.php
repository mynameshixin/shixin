<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/19
 * Time: 下午1:32
 */
namespace App\Services\Wz;

use App\Lib\LibUtil;
use App\Services\Admin\ImageService;
use App\Services\UserService;
use App\Websupply\UserWebsupply;
use App\Services\ApiService;
use DB;
class WzService extends ApiService
{
    public static function getInstance(){
        return parent::getInstance();
    
    } 
    public function newwz($skip,$num){     
        $data=DB::table('eassat')->orderBy('eassat_data','desc')->skip($skip)->take($num)->get();
        return $data;
    }
    public function fenlei($pid=0){     
        $data=DB::table('eassat_search')->get();
        return $data;
    }
}
// class WzService extends ApiService
// {
//     private static $sources = ['0' => '用户发布', '1' => '淘宝网'];

//     /**
//      * @return Service_Pay
//      */
//     public static function getInstance()
//     {
//         return parent::getInstance();
//     }



//     public function addProduct($userId, $data = array(), $files = array())
//     {

//         $entry = array(
//             'user_id' => $userId,
//             'title' => isset($data['title']) ? $data['title'] : $data['title'],
//             'description' => isset($data['description']) ? $data['description'] : '',
//             'price' => isset($data['price']) ? $data['price'] : 0,
//             'reserve_price' => isset($data['reserve_price']) ? $data['reserve_price'] : 0,
//             'detail_url' => isset($data['detail_url']) ? $data['detail_url'] : '',
//             'status' => isset($data['status']) ? $data['status'] : 1,
//             'contact' => isset($data['contact']) ? $data['contact'] : '',
//             'source' => isset($data['source']) ? $data['source'] : 1,
//             'cityid'=>isset($data['cityid']) ? (int)$data['cityid'] : 0,
//             'tags' => isset($data['tags']) ? $data['tags'] : '',
//         );

//         $images_arr = [];
//         if (isset($files['image']) && !empty($files['image'])) {
//             $images = ImageService::getInstance()->uploadImage($userId, $files['image']);
//             if (!empty($images)) {
//                 $images_arr = array_column($images, 'image_id');
//                 $image_ids = implode(',', $images_arr);
//                 $entry['image_ids'] = $image_ids;
//                 $id = DB::table('cq_goods')->insertGetId($entry);
//                 return $id;
//             }
//         }
//         return 0;
//     }
//     // 编辑自己发布的出清商品
//      public function updateProduct($userId, $data = array(), $files = array())
//     {

//         $entry = array(
//             'user_id' => $userId,
//             'title' => isset($data['title']) ? $data['title'] : $data['title'],
//             'description' => isset($data['description']) ? $data['description'] : '',
//             'price' => isset($data['price']) ? $data['price'] : 0,
//             'reserve_price' => isset($data['reserve_price']) ? $data['reserve_price'] : 0,
//             'detail_url' => isset($data['detail_url']) ? $data['detail_url'] : '',
//             'status' => isset($data['status']) ? $data['status'] : 1,
//             'contact' => isset($data['contact']) ? $data['contact'] : '',
//             'source' => isset($data['source']) ? $data['source'] : 1,
//             'cityid'=>isset($data['cityid']) ? (int)$data['cityid'] : 0,
//             'tags' => isset($data['tags']) ? $data['tags'] : '',
//         );
//         if(!empty($data['good_id'])){
//             $tags = DB::table('cq_goods')->where('id',$data['good_id'])->select('tags')->first();
//             $entry['tags'] = $tags['tags'].$entry['tags'];
//         }
//         $images_arr = [];
//         if (isset($files['image']) && !empty($files['image'])) {
//             $images = ImageService::getInstance()->uploadImage($userId, $files['image']);
//             if (!empty($images)) {
//                 $images_arr = array_column($images, 'image_id');
//                 $image_ids = implode(',', $images_arr);
//                 $entry['image_ids'] = $image_ids;
               
//             }
//         }

//         $id = DB::table('cq_goods')->where('id',$data['good_id'])->update($entry);
//         return !empty($id)?1:0;
//     }
//     // 获得主页商品
//     public  function getProductsByFids ($data,$skip,$num,$user_id = 0,$entry=[]){
//         $rows = DB::table('cq_goods')->where('status', 1);
//         if(!empty($user_id)) $rows = $rows->where('user_id',$user_id);
//         if(!empty($entry['keyword'])){
//             $keyword = $entry['keyword'];
//             $rows = $rows->where(function ($rows) use ($keyword) {
//                 $rows = $rows->where('title', "like", "%{$keyword}%")
//                     ->orWhere('tags', "like", "%{$keyword}%");

//             });
//         }
//         if(!empty($entry['cityid'])){
//             $ids = DB::table('citys')->where('pid',$data['cityid'])->lists('id');
//             if(empty($ids)){
//                 $rows = $rows->where('cityid',$data['cityid']);
//             }else{
//                 $n = [];
//                 foreach ($ids as $key => $value) {
//                     $next = DB::table('citys')->where('pid',$value)->lists('id');
//                     $n = array_merge($n,$next);
//                 }
//                 $ids[] = $data['cityid'];
//                 $n = array_merge($n,$ids);
//                 $rows = $rows->whereIn('cityid',$n);
//             }
//         }
//         if(!empty($entry['tags'])) $rows = $rows->where('tags','like',"%{$entry['tags']}%");
//         if(!empty($entry['price1'])){
//             if(!empty($entry['price2'])){
//                 $rows = $rows->where('reserve_price','>=',$entry['price1'])->where('reserve_price','<',$entry['price2']);
//             }else{
//                 $rows = $rows->where('reserve_price','<=',$entry['price1']);
//             }
//         }
//         if(!empty($entry['source'])) $rows = $rows->where('source',$entry['source']);

//         $rows = $rows->orderBy('created_at','desc');
//         $rows = $rows->skip($skip)->take($num)->get();
//         foreach ($rows as $k=>$row) {
//             if (!empty($row['image_ids'])) {
//                 $image_ids = explode(',', $row['image_ids']);
//                 foreach ($image_ids as $imageId) {
//                     $image_o = LibUtil::getPicUrl($imageId, 3);
//                     if (!empty($image_o)) {
//                         $rows[$k]['images'][] = [
//                             'image_id'=>$imageId,
//                             'img_m' => LibUtil::getPicUrl($imageId, 1),
//                             'img_o' => $image_o,
//                             'rh' => LibUtil::getPicSize($imageId, 1)
//                         ];
//                     }
//                 }
//             }
//             // 地区
//              $rows[$k]['countryname'] = '未知地区';
//              $rows[$k]['cityname'] = '';
//              if(!empty($row['cityid'])){
//                 $cinfo = DB::table('citys')->select('id','name','pid')->where('id',$row['cityid'])->first();
//                 $rows[$k]['countryname'] = $cinfo['name'];
//                 $cpinfo = DB::table('citys')->select('id','name','pid')->where('id',$cinfo['pid'])->first();
//                 $rows[$k]['cityname'] = $cpinfo['name'];
//              }
//             $rows[$k]['min'] = self::cpu_time(time() - strtotime($row['created_at']));
//             $rows[$k]['is_user'] = !empty($user_id)?1:0;
//         }
//         return $rows;
        
//     }
//     //获得收藏商品
//     public  function getProductsByCol ($data,$skip,$num,$user_id =0){
//         $rows = DB::table('cq_cg_record as ccr')->where('ccr.user_id',$user_id);
        
//         $rows = $rows->join('cq_goods as cg','ccr.good_id','=','cg.id')->where('cg.status',1);
//         $rows = $rows->orderBy('ccr.created_at','desc');
//         $rows = $rows->select('cg.*')->skip($skip)->take($num)->get();
        
//         foreach ($rows as $k=>$row) {
//             if (!empty($row['image_ids'])) {
//                 $image_ids = explode(',', $row['image_ids']);
//                 foreach ($image_ids as $imageId) {
//                     $image_o = LibUtil::getPicUrl($imageId, 3);
//                     if (!empty($image_o)) {
//                         $rows[$k]['images'][] = [
//                             'image_id'=>$imageId,
//                             'img_m' => LibUtil::getPicUrl($imageId, 1),
//                             'img_o' => $image_o,
//                             'rh' => LibUtil::getPicSize($imageId, 1)
//                         ];
//                     }
//                 }
//             }
//             // 地区
//              $rows[$k]['countryname'] = '未知地区';
//              $rows[$k]['cityname'] = '';
//              if(!empty($row['cityid'])){
//                 $cinfo = DB::table('citys')->select('id','name','pid')->where('id',$row['cityid'])->first();
//                 $rows[$k]['countryname'] = $cinfo['name'];
//                 $cpinfo = DB::table('citys')->select('id','name','pid')->where('id',$cinfo['pid'])->first();
//                 $rows[$k]['cityname'] = $cpinfo['name'];
//              }
//             $rows[$k]['min'] = self::cpu_time(time() - strtotime($row['created_at']));
//         }
//         return $rows;
        
//     }

//     // 获得发布的其他商品
//     public  function getOproducts ($data,$skip,$num){
//         $good = DB::table('cq_goods')->where('id', $data['good_id'])->first();
//         $rows = DB::table('cq_goods')->where('user_id',$good['user_id'])->where('status',1);
//         $rows = $rows->where('id', '!=',$data['good_id']);
//         $rows = $rows->orderBy('created_at','desc');
//         $rows = $rows->skip($skip)->take($num)->get();

//         foreach ($rows as $k=>$row) {
//             if (!empty($row['image_ids'])) {
//                 $image_ids = explode(',', $row['image_ids']);
//                 foreach ($image_ids as $imageId) {
//                     $image_o = LibUtil::getPicUrl($imageId, 3);
//                     if (!empty($image_o)) {
//                         $rows[$k]['images'][] = [
//                             'image_id'=>$imageId,
//                             'img_m' => LibUtil::getPicUrl($imageId, 1),
//                             'img_o' => $image_o,
//                             'rh' => LibUtil::getPicSize($imageId, 1)
//                         ];
//                     }
//                 }
//             }
//             // 地区
//              $rows[$k]['countryname'] = '未知地区';
//              $rows[$k]['cityname'] = '';
//              if(!empty($row['cityid'])){
//                 $cinfo = DB::table('citys')->select('id','name','pid')->where('id',$row['cityid'])->first();
//                 $rows[$k]['countryname'] = $cinfo['name'];
//                 $cpinfo = DB::table('citys')->select('id','name','pid')->where('id',$cinfo['pid'])->first();
//                 $rows[$k]['cityname'] = $cpinfo['name'];
//              }
//             $rows[$k]['min'] = self::cpu_time(time() - strtotime($row['created_at']));
//         }
//         return $rows;
        
//     }


//     //获得商品详细
//     public  function getProductsDetail ($data,$user_id =0){
//         $row = DB::table('cq_goods')->where('id',$data['good_id'])->first();
//         if (!empty($row['image_ids'])) {
//             $image_ids = explode(',', $row['image_ids']);
//             foreach ($image_ids as $imageId) {
//                 $image_o = LibUtil::getPicUrl($imageId, 3);
//                 if (!empty($image_o)) {
//                     $row['images'][] = [
//                         'image_id'=>$imageId,
//                         'img_m' => LibUtil::getPicUrl($imageId, 1),
//                         'img_o' => $image_o,
//                         'rh' => LibUtil::getPicSize($imageId, 1)
//                     ];
//                 }
//             }
//         }

//         // 地区
//          $row['countryname'] = '未知地区';
//          $row['cityname'] = '';
//          if(!empty($row['cityid'])){
//             $cinfo = DB::table('citys')->select('id','name','pid')->where('id',$row['cityid'])->first();
//             $row['countryname'] = $cinfo['name'];
//             $cpinfo = DB::table('citys')->select('id','name','pid')->where('id',$cinfo['pid'])->first();
//             $row['cityname'] = $cpinfo['name'];
//          }

//         $row['min'] = self::cpu_time(time() - strtotime($row['created_at']));
//         $row['user'] = UserWebsupply::user_info($row['user_id']);
//         // 评论
//         $comments = DB::table('cq_comments')->where('good_id',$data['good_id'])->orderBy('created_at','desc')->get();
//         foreach ($comments as $key => $value) {
//             $comments[$key]['user'] = UserWebsupply::user_info($value['user_id']);
//             $comments[$key]['min'] = self::cpu_time(time() - strtotime($value['created_at']));
//         }
//         $row['comments'] = $comments;
//         return $row;
        
//     }
//     public function cpu_time($time){
//         if($time < 60) return $time.'秒前';
//         if($time >= 60 && $time < 3600) return floor($time/60).'分钟前';
//         if($time >= 3600 && $time < 3600*24) return floor($time/3600).'小时前';
//         if($time >= 3600*24) return floor($time/(3600*24)).'天前';
//     }

   
// }
