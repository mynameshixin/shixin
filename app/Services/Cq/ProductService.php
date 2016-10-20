<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/19
 * Time: 下午1:32
 */
namespace App\Services\Cq;

use App\Lib\LibUtil;
use App\Models\Folder;
use App\Models\FolderGood;
use App\Models\GoodAction;
use App\Models\Images;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopAddress;
use App\Services\Admin\ImageService;
use App\Services\UserService;
use App\Websupply\UserWebsupply;
use App\Services\ApiService;
use DB;

class ProductService extends ApiService
{
    private static $sources = ['0' => '用户发布', '1' => '淘宝网'];

    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }



    public function addProduct($userId, $data = array(), $files = array())
    {

        $entry = array(
            'user_id' => $userId,
            'title' => isset($data['title']) ? $data['title'] : $data['title'],
            'description' => isset($data['description']) ? $data['description'] : '',
            'price' => isset($data['price']) ? $data['price'] : 0,
            'reserve_price' => isset($data['reserve_price']) ? $data['reserve_price'] : 0,
            'detail_url' => isset($data['detail_url']) ? $data['detail_url'] : '',
            'status' => isset($data['status']) ? $data['status'] : 1,
            'contact' => isset($data['contact']) ? $data['contact'] : '',
            'source' => isset($data['source']) ? $data['source'] : 1,
            'cityid'=>isset($data['cityid']) ? (int)$data['cityid'] : 0,
            'tags' => isset($data['tags']) ? $data['tags'] : '',
        );

        $images_arr = [];
        if (isset($files['image']) && !empty($files['image'])) {
            $images = ImageService::getInstance()->uploadImage($userId, $files['image']);
            if (!empty($images)) {
                $images_arr = array_column($images, 'image_id');
                $image_ids = implode(',', $images_arr);
                $entry['image_ids'] = $image_ids;
                $id = DB::table('cq_goods')->insertGetId($entry);
                return $id;
            }
        }
        return 0;
    }
    // 获得主页商品
    public  function getProductsByFids ($data,$skip,$num,$user_id = 0){
        $rows = DB::table('cq_goods')->where('status', 1);
        if(!empty($user_id)) $rows = $rows->where('user_id',$user_id);
        if(!empty($data['keyword'])){
            $keyword = $data['keyword'];
            $rows = $rows->where(function ($rows) use ($keyword) {
                $rows = $rows->where('title', "like", "%{$keyword}%")
                    ->orWhere('tags', "like", "%{$keyword}%");

            });
        }
        if(!empty($data['cityid'])) $rows = $rows->where('cityid',$data['cityid']);
        if(!empty($data['tags'])) $rows = $rows->where('tags','like',"%{$data['tags']}%");
        if(!empty($data['price1'])){
            if(!empty($data['price2'])){
                $rows = $rows->where('reserve_price','>',$data['price1'])->where('price','<',$data['price2']);
            }else{
                $rows = $rows->where('reserve_price','<',$data['price1']);
            }
        }
        if(!empty($data['source'])) $rows = $rows->where('source',$data['source']);

        $rows = $rows->orderBy('created_at','desc');
        $rows = $rows->skip($skip)->take($num)->get();
        foreach ($rows as $k=>$row) {
            if (!empty($row['image_ids'])) {
                $image_ids = explode(',', $row['image_ids']);
                foreach ($image_ids as $imageId) {
                    $image_o = LibUtil::getPicUrl($imageId, 3);
                    if (!empty($image_o)) {
                        $rows[$k]['images'][] = [
                            'image_id'=>$imageId,
                            'img_m' => LibUtil::getPicUrl($imageId, 1),
                            'img_o' => $image_o
                        ];
                    }
                }
            }
            // 地区
             $rows[$k]['countryname'] = '未知地区';
             $rows[$k]['cityname'] = '';
             if(!empty($row['cityid'])){
                $cinfo = DB::table('citys')->select('id','name','pid')->where('id',$row['cityid'])->first();
                $rows[$k]['countryname'] = $cinfo['name'];
                $cpinfo = DB::table('citys')->select('id','name','pid')->where('id',$cinfo['pid'])->first();
                $rows[$k]['cityname'] = $cpinfo['name'];
             }
            $rows[$k]['min'] = self::cpu_time(time() - strtotime($row['created_at']));
        }
        return $rows;
        
    }
    //获得收藏商品
    public  function getProductsByCol ($data,$skip,$num,$user_id =0){
        $rows = DB::table('cq_cg_record as ccr')->where('ccr.user_id',$user_id);
        
        $rows = $rows->join('cq_goods as cg','ccr.good_id','=','cg.id');
        $rows = $rows->orderBy('ccr.created_at','desc');
        $rows = $rows->select('cg.*')->skip($skip)->take($num)->get();
        
        foreach ($rows as $k=>$row) {
            if (!empty($row['image_ids'])) {
                $image_ids = explode(',', $row['image_ids']);
                foreach ($image_ids as $imageId) {
                    $image_o = LibUtil::getPicUrl($imageId, 3);
                    if (!empty($image_o)) {
                        $rows[$k]['images'][] = [
                            'image_id'=>$imageId,
                            'img_m' => LibUtil::getPicUrl($imageId, 1),
                            'img_o' => $image_o
                        ];
                    }
                }
            }
            // 地区
             $rows[$k]['countryname'] = '未知地区';
             $rows[$k]['cityname'] = '';
             if(!empty($row['cityid'])){
                $cinfo = DB::table('citys')->select('id','name','pid')->where('id',$row['cityid'])->first();
                $rows[$k]['countryname'] = $cinfo['name'];
                $cpinfo = DB::table('citys')->select('id','name','pid')->where('id',$cinfo['pid'])->first();
                $rows[$k]['cityname'] = $cpinfo['name'];
             }
            $rows[$k]['min'] = self::cpu_time(time() - strtotime($row['created_at']));
        }
        return $rows;
        
    }

    // 获得发布的其他商品
    public  function getOproducts ($data,$skip,$num,$user_id = 0){
        $good = DB::table('cq_goods')->where('id', $data['good_id'])->first();
        $rows = DB::table('cq_goods')->where('id', '!=',$data['good_id'])->where('user_id',$good['user_id']);

        $rows = $rows->orderBy('created_at','desc');
        $rows = $rows->skip($skip)->take($num)->get();
        foreach ($rows as $k=>$row) {
            if (!empty($row['image_ids'])) {
                $image_ids = explode(',', $row['image_ids']);
                foreach ($image_ids as $imageId) {
                    $image_o = LibUtil::getPicUrl($imageId, 3);
                    if (!empty($image_o)) {
                        $rows[$k]['images'][] = [
                            'image_id'=>$imageId,
                            'img_m' => LibUtil::getPicUrl($imageId, 1),
                            'img_o' => $image_o
                        ];
                    }
                }
            }
            // 地区
             $rows[$k]['countryname'] = '未知地区';
             $rows[$k]['cityname'] = '';
             if(!empty($row['cityid'])){
                $cinfo = DB::table('citys')->select('id','name','pid')->where('id',$row['cityid'])->first();
                $rows[$k]['countryname'] = $cinfo['name'];
                $cpinfo = DB::table('citys')->select('id','name','pid')->where('id',$cinfo['pid'])->first();
                $rows[$k]['cityname'] = $cpinfo['name'];
             }
            $rows[$k]['min'] = self::cpu_time(time() - strtotime($row['created_at']));
        }
        return $rows;
        
    }

    //获得商品详细
    public  function getProductsDetail ($data,$user_id =0){
        $row = DB::table('cq_goods')->where('id',$data['good_id'])->first();
        if (!empty($row['image_ids'])) {
            $image_ids = explode(',', $row['image_ids']);
            foreach ($image_ids as $imageId) {
                $image_o = LibUtil::getPicUrl($imageId, 3);
                if (!empty($image_o)) {
                    $row['images'][] = [
                        'image_id'=>$imageId,
                        'img_m' => LibUtil::getPicUrl($imageId, 1),
                        'img_o' => $image_o
                    ];
                }
            }
        }

        // 地区
         $row['countryname'] = '未知地区';
         $row['cityname'] = '';
         if(!empty($row['cityid'])){
            $cinfo = DB::table('citys')->select('id','name','pid')->where('id',$row['cityid'])->first();
            $row['countryname'] = $cinfo['name'];
            $cpinfo = DB::table('citys')->select('id','name','pid')->where('id',$cinfo['pid'])->first();
            $row['cityname'] = $cpinfo['name'];
         }

        $row['min'] = self::cpu_time(time() - strtotime($row['created_at']));
        $row['user'] = UserWebsupply::user_info($row['user_id']);
        // 评论
        $comments = DB::table('cq_comments')->where('good_id',$data['good_id'])->get();
        foreach ($comments as $key => $value) {
            $comments[$key]['user'] = UserWebsupply::user_info($value['user_id']);
        }
        $row['comments'] = $comments;
        return $row;
        
    }
    public function cpu_time($time){
        if($time < 60) return $time.'秒前';
        if($time >= 60 && $time < 3600) return floor($time/60).'分钟前';
        if($time >= 3600 && $time < 3600*24) return floor($time/3600).'小时前';
        if($time >= 3600*24) return floor($time/(3600*24)).'天前';
    }

   
}
