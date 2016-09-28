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

        /*$rows = DB::table('folder_goods');
        $rows = $rows->join('folders','folder_goods.folder_id','=','folders.id');
        $rows = $rows->where('folders.private',0);

        $rows = $rows->join('goods','folder_goods.good_id','=','goods.id');
        $rows = $rows->where('goods.status',1);

        $rows = $rows->where('folder_goods.kind', $kind);*/
        
        /*if (empty($folder_ids)) {
            $rows = $rows->whereIn('folder_goods.user_id',$user_ids);
        }else{
            $rows = $rows->where(function ($rows) use ($user_ids,$folder_ids,$self_id) {
                $rows = $rows->whereIn('folder_goods.user_id',$user_ids)
                    ->orwhereIn('folder_goods.folder_id',$folder_ids);
            });
        }  */      

        /*$rows = $rows->select('folder_goods.id','folder_goods.good_id','folder_goods.user_id','folder_goods.folder_id','folder_goods.created_at','folders.private','folders.name')->orderBy('folder_goods.created_at','desc')->orderBy('folder_goods.id','desc');
        $skip = ($params['page']-1)*$num;*/

        $skip = ($params['page']-1)*$num;
        $rows = DB::select("select fg.id,fg.good_id,fg.user_id,fg.folder_id,fg.created_at,f.private,f.name from (select * from folder_goods as fg  where kind = {$kind} ORDER BY fg.created_at desc,id desc) as fg join folders as f on fg.folder_id=f.id  join goods as g on fg.good_id = g.id where f.private=0 and g.status=1 limit {$skip},{$num}");
        
        /*foreach ($rows as $key => $value) {
            if($value['private'] == 1 && $self_id != $value['user_id']){
                unset($rows[$key]);
            }
            
        }*/
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
        $condtion = [];
        // $condtion = ['is_delete' => 0,'status'=>1];
        if (isset($params['kind'])) $condtion['kind'] = $params['kind'];
        if (isset($params['user_id'])) $condtion['user_id'] = $params['user_id'];
        if (!empty($condtion)) $rows = $rows->where($condtion);

        $rows = $rows->select('id', 'user_id', 'folder_id', 'kind', 'price', 'reserve_price', 'image_ids', 'title', 'tags', 'category_id', 'description', 'source', 'is_recommend', 'collection_count', 'praise_count', 'boo_count', 'detail_url', 'created_at');
        if (isset($params['keyword']) && !empty($params['keyword'])) {
            $keyword = urldecode($params['keyword']);
            $rows = $rows->where(function ($rows) use ($keyword) {
                $rows = $rows->where('goods.title', "like", "%{$keyword}%")
                    ->orWhere('goods.tags', "like", "%{$keyword}%");
            });
        }
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
                                'img_o' => $image_o,
                                'rh'=>LibUtil::getPicSize($imageId, 1),
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
    public static function get_folder_detail($self_id,$other_id,$data,$good_id){
        $num = isset($data['num'])?$data['num']:4;
        $page = isset($data['page'])?$data['page']:1;
        $skip = ($page-1)*$num;
        $id = $data['img_id'];
        $condition = ['cg.good_id'=>$good_id];
        if($other_id!=$self_id) $condition['f.private'] = 0;
        $collection = DB::table('collection_good as cg')->join('folders as f','cg.folder_id','=','f.id')->orderBy('cg.updated_at','desc')->where('f.user_id','<>',$self_id)->where($condition)->skip($skip)->take($num)->select('cg.*')->get();
        // dd($collection);
        foreach ($collection as $key => $value) {
            $collection[$key] = self::get_collection_folder($value['folder_id'],$value['user_id'],$other_id,$self_id,$data);
            //if($collection[$key] == null) unset($collection[$key]);
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

    //根据时间戳计算时间维度
    public static function cpu_time($time){

        if($time < 60) return $time.'秒';
        if($time >= 60 && $time < 3600) return floor($time/60).'分钟';
        if($time >= 3600 && $time < 3600*24) return floor($time/3600).'小时';
        if($time >= 3600*24) return floor($time/(3600*24)).'天';
    }


    //获得图片详细
    public static function get_pic_detail($self_id,$data){
        $id = $data['img_id'];
        $goods = DB::table('goods')->where(['id'=>$id])->first();
        if($goods){
            $goods['dev'] = $dev = [['id'=>0,'name'=>'不限'],['id'=>1,'name'=>'世茂'],['id'=>2,'name'=>'万科'],['id'=>3,'name'=>'恒大'],['id'=>4,'name'=>'绿地'],['id'=>5,'name'=>'保利'],['id'=>6,'name'=>'中国海外发展'],['id'=>7,'name'=>'碧桂园'],['id'=>8,'name'=>'融创中国'],['id'=>9,'name'=>'龙湖'],['id'=>10,'name'=>'富力'],['id'=>11,'name'=>'华润'],['id'=>12,'name'=>'华夏幸福基业'],['id'=>13,'name'=>'招商'],['id'=>14,'name'=>'金地'],['id'=>15,'name'=>'远洋'],['id'=>16,'name'=>'绿城'],['id'=>17,'name'=>'荣盛'],['id'=>18,'name'=>'北京首都'],['id'=>19,'name'=>'复地'],['id'=>20,'name'=>'金科'],['id'=>21,'name'=>'其他']];
            $goods['huxing'] = $huxing = [['id'=>0,'name'=>'不限'],['id'=>1,'name'=>'1居'],['id'=>2,'name'=>'2居'],['id'=>3,'name'=>'3居'],['id'=>4,'name'=>'4居'],['id'=>5,'name'=>'5居'],['id'=>6,'name'=>'5居以上']];
            $goods['type'] = $types = [['id'=>0,'name'=>'不限'],['id'=>1,'name'=>'样板房'],['id'=>2,'name'=>'新房'],['id'=>3,'name'=>'二手房改造'],['id'=>4,'name'=>'实体店']];
            $goods['btype'] = $btype = [['id'=>0,'name'=>'不限'],['id'=>1,'name'=>'家具店'],['id'=>2,'name'=>'饰品店'],['id'=>3,'name'=>'卫浴店'],['id'=>4,'name'=>'其他']];
            $goods['sales'] = $sales = [['id'=>0,'name'=>'不限'],['id'=>1,'name'=>'百案居'],['id'=>2,'name'=>'红星美凯龙'],['id'=>3,'name'=>'居然之家'],['id'=>4,'name'=>'集美家居'],['id'=>5,'name'=>'吉盛伟邦'],['id'=>6,'name'=>'艺展中心'],['id'=>7,'name'=>'曹家渡花鸟市场'],['id'=>8,'name'=>'文定生活馆'],['id'=>9,'name'=>'其他']];
            $goods['cityname'] = '未知';
            $goods['devname'] = '不限';
            $goods['huname'] = '不限';
            $goods['typename'] = '不限';
            $goods['btypename'] = '不限';
            $goods['salename'] = '不限';
            if($city = DB::table('citys')->where('id',$goods['cityid'])->select('name')->first()) $goods['cityname'] = $city['name'];
            foreach ($dev as $key => $value) {
                if($value['id'] == $goods['devid']){
                    $goods['devname'] = $value['name'];
                    break;
                }
            }
            foreach ($huxing as $key => $value) {
                if($value['id'] == $goods['huid']){
                    $goods['huname'] = $value['name'];
                    break;
                }
            }
            foreach ($types as $key => $value) {
                if($value['id'] == $goods['typeid']){
                    $goods['typename'] = $value['name'];
                    break;
                }
            }
            foreach ($btype as $key => $value) {
                if($value['id'] == $goods['btypeid']){
                    $goods['btypename'] = $value['name'];
                    break;
                }
            }
            foreach ($sales as $key => $value) {
                if($value['id'] == $goods['saleid']){
                    $goods['salename'] = $value['name'];
                    break;
                }
            }
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

            $goods['more'] = self::get_more_goods($folder_id,$goods['id']);
            // dd($goods['more']);
            $comments = DB::table('comments')->where(['good_id'=>$id])->orderBy('praise_count','desc')->orderBy('created_at','desc')->take(20)->get();
            foreach ($comments as $key => $value) {
                $innertime = time() - strtotime($value['created_at']);
                $comments[$key]['min'] = self::cpu_time($innertime);
                $comments[$key]['user'] = UserWebsupply::user_info($value['user_id']);

            }
            $goods['comments'] = $comments;

            $goods['collection_folders'] = [];
            $collection_folders = self::get_folder_detail($self_id,$goods['user_id'],$data,$goods['id']);
            if(!empty($collection_folders)) $goods['collection_folders'] = $collection_folders;

            $fid = isset($collection_folders[0]['id'])?$collection_folders[0]['id']:0;
            $goods['folders_one'] = [];
            if(!empty($fid)) $goods['folders_one'] = self::get_folder_file($fid,$collection_folders[0]['user_id'],$self_id,$data);
            $folder = [];
            $folder = DB::table('folders')->where('id',$goods['folder_id'])->first();
            
            if(empty($folder)){
                $folder['id'] = 0;
                $folder['name'] = '无文件夹';
                $folder['img_url'] = url('uploads/sundry/blogo.jpg');
                $folder['is_follow'] = 0;
            }else{
                $follow = DB::table('collection_folder')->where(['user_id'=>$self_id,'folder_id'=>$folder['id']])->first();
                $folder['is_follow'] = !empty($follow)?1:0;
                $folder['img_url'] = !empty(LibUtil::getPicUrl($folder['image_id'],1))?LibUtil::getPicUrl($folder['image_id'],1):url('uploads/sundry/blogo.jpg');
            }
            $goods['folder'] = $folder;
            
        }

        return $goods;
    }

    // 获得该文件夹的其他文件
    public static function get_more_goods($folder_id,$good_id){
        $page = isset($data['page'])?$data['page']:1;
        $num = isset($data['num'])?$data['num']:15;
        $skip = ($page-1)*$num;
        
        $goods = DB::table('folder_goods as fg')->leftJoin('goods as g','fg.good_id','=','g.id')->where(['fg.folder_id'=>$folder_id])->select('g.image_ids','g.id','g.title','g.description')->take(100)->get();
        $last = count($goods)-1;
        foreach ($goods as $k => $v) {
            if($good_id == $v['id']){
                if(isset($goods[$k+1])){
                    $goods['next'] = $goods[$k+1]['id'];
                }else{
                    $goods['next'] = isset($goods[0]['id'])?$goods[0]['id']:'';
                }
                if(isset($goods[$k-1])){
                    $goods['pre'] = $goods[$k-1]['id'];
                }else{
                    $goods['pre'] = isset($goods[$last]['id'])?$goods[$last]['id']:'';
                }
            }
            if(strpos($v['image_ids'],',') == 0){
                    $goods[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_ids'], 1))?LibUtil::getPicUrl($v['image_ids'], 1):url('uploads/sundry/blogo.jpg');
                    $goods[$k]['rh'] = LibUtil::getPicSize($v['image_ids'], 1);
                }else{
                    $goods[$k]['image_url'] = url('uploads/sundry/blogo.jpg');
                }
        }
        if(!isset($goods['pre'])) $goods['pre'] = $goods[0]['id'];
        if(!isset($goods['next'])) $goods['next'] = $goods[$last]['id'];
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
                //$goods = DB::table('goods')->where('folder_id',$id)->select('id','image_ids')->take($gnum)->get();
                $goods = DB::table('folder_goods as fg')->join('goods as g','fg.good_id','=','g.id')->where(['fg.user_id'=>$folders['user_id'],'fg.folder_id'=>$id])->take($gnum)->select('g.id','g.image_ids','g.title','g.description')->orderBy('fg.created_at','desc')->get();
                    foreach ($goods as $k => $v) {
                        if(strpos($v['image_ids'],',') == 0){
                            $goods[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_ids'], 1))?LibUtil::getPicUrl($v['image_ids'], 1):url('uploads/sundry/blogo.jpg');
                        }
                    }
                $folders['goods'] = $goods;         
            }
            $folders['user'] = UserWebsupply::user_info($user_id);
            // $folders['count'] = DB::table('goods')->where('folder_id',$id)->count();
        }
        return $folders;

    }   
  
    //推荐给你的采集文件
    public static function get_folder_file($folder_id,$other_id,$self_id,$data){

        $page = isset($data['page'])?$data['page']:1;
        $num = isset($data['num'])?$data['num']:15;
        $skip = ($page-1)*$num;
        $condition =['id'=>$folder_id];
        if($other_id!=$self_id) $condition['private'] = 0;
        $folder = DB::table('folders')->where($condition)->first();
        $goods = [];
        if($folder){
            $id = $folder['id'];
            //$goods = DB::table('goods')->where(['folder_id'=>$id])->orderBy('updated_at','desc')->skip($skip)->take($num)->get();
            $goods = DB::table('folder_goods as fg')->join('goods as g','fg.good_id','=','g.id')->where(['fg.user_id'=>$folder['user_id'],'fg.folder_id'=>$id])->skip($skip)->take($num)->select('g.*')->orderBy('fg.created_at','desc')->get();
            foreach ($goods as $k => $v) {
                if(strpos($v['image_ids'],',') == 0){
                    $goods[$k]['image_url'] = LibUtil::getPicUrl($v['image_ids'], 1);
                    $goods[$k]['rh'] = LibUtil::getPicSize($v['image_ids'], 1);
                }else{
                    $goods[$k]['image_url'] = url('uploads/sundry/blogo.jpg');
                }
                $goods[$k]['collection_good'] = $collection = DB::table('collection_good as cg')->join('users as u','cg.user_id','=','u.id')->join('folders as f','cg.folder_id','=','f.id')->where('cg.user_id','<>',$self_id)->where('f.private',0)->where('cg.good_id',$v['id'])->orderBy('cg.updated_at','desc')->take(3)->get();
                // 如果没人采集，则返回发布人
                if(empty($collection)){
                    $arr = [];
                    $arr[0] = DB::table('users')->where('id',$v['user_id'])->select('*','id as user_id')->first();
                    $res = DB::table('folders')->where('id',$v['folder_id'])->select('id','name')->first();
                    $arr[0]['folder_id']  = $res['id'];
                    $arr[0]['name']  = $res['name'];
                    $collection = $goods[$k]['collection_good'] = $arr;
                }
                foreach ($collection as $key => $value) {
                    $goods[$k]['collection_good'][$key]['user'] = UserWebsupply::user_info($value['user_id']);
                }
             }
            
        }

        return $goods;
    }

}