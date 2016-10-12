<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/10/29
 * Time: 下午2:52
 */

namespace App\Services;


use App\Lib\LibUtil;
use App\Models\CollectionFolder;
use App\Models\CollectionGood;
use App\Models\Folder;
use App\Models\FolderGood;
use App\Models\Follow;
use App\Models\Product;
use App\Models\User;

class CollectionService extends ApiService
{
    /**
     * 添加
     * @param $user_id
     * @param $userid_follow
     * @return mixed
     */
   public function addCollection ($user_id,$good_id,$folder_id=0) {
       $row = CollectionGood::where(['user_id'=>$user_id,'good_id'=>$good_id,'folder_id'=>$folder_id])->first();
       if (empty($row)) {
           $good = Product::select('id','user_id','collection_count','title','image_ids','kind','tags')->find($good_id);
           if (empty($good))return false;
           $good = $good->toArray();
           $tags = '';
           if ($folder_id) {
               $folder =  Folder::where(['user_id'=>$user_id,'id'=>$folder_id])->first();
               $tags = $good['tags'].';'.$folder['name'];
               Product::where('id',$good_id)->update(['tags'=>$tags]);
               if (empty($folder)) $folder_id = 0 ;
           }
           $rs = CollectionGood::insert(['user_id'=>$user_id,'good_id'=>$good_id,'folder_id'=>$folder_id,'kind'=>$good['kind']]);
           FolderGood::insert(['good_id'=>$good_id,'folder_id'=>$folder_id,'kind'=>$good['kind'],'action'=>1,'user_id'=>$user_id]);

           if ($rs) {
               Product::where('id',$good_id)->increment('collection_count');
               if($folder_id){
                  // Folder::where('id',$folder_id)->update(['count'=>$folder['count'] + 1]);

                   //$good['image_ids'] = trim($good['image_ids']);
                   $imageArr = explode(',',$good['image_ids']);
                   $image_id = isset($imageArr[0]) ? $imageArr[0] : 0;
                   FolderService::getInstance()->updateFolderCount ($folder_id,$image_id);

               }
               if ($user_id!=$good['user_id']) {
                   //发送 文件夹被收藏消息
                   $msg_content = "收藏了你发布的 {$good['title']}！";
                   $var = json_encode(['good_id'=>$good_id,'folder_id'=>$folder_id,'image_ids'=>$good['image_ids'],'title'=>$good['title'],'kind'=>$good['kind']]);
                   MessageService::getInstance()->addMessage($user_id,$good['user_id'],1,$msg_content,2,$var,$good_id);
               }

           }
       }
       return true;
   }
    /**
     * 删除
     * @param $user_id
     * @param $userid_follow
     * @return mixed
     */
    public function delCollection ($user_id,$good_id,$folder_id=0) {
        $cond = ['user_id'=>$user_id,'good_id'=>$good_id];
        if ($folder_id) $cond['folder_id'] = $folder_id;
        $row = CollectionGood::where($cond)->first();
        if($row['folder_id'])
        {
            FolderGood::where(['good_id'=>$good_id,'folder_id'=>$row['folder_id']])->delete();
            FolderService::getInstance()->updateFolderCount ($row['folder_id']);

        }
        return CollectionGood::where($cond)->delete();
    }

    public function getCollections($params,$num=10){
         $cond['user_id'] = $params['user_id'];
         if (isset($params['folder_id']) && $params['folder_id']) $cond['folder_id'] = $params['folder_id'];
         if (isset($params['kind']) && $params['kind']) $cond['kind'] = $params['kind'];
         $rs = CollectionGood::where($cond)->select('good_id')->orderBy('created_at','desc')->paginate($num);
         $data = LibUtil::pageFomate($rs);
        if (!empty($data['list'])){
            $product_ids = array_column($data['list'],'good_id');
            $list = ProductService::getInstance()->getProductListByIds($product_ids);
            $data['list'] = array_values($list);
            foreach ($product_ids as $product_id) {
               if(isset($list[$product_id]))$arr[] = $list[$product_id];
            }
            $data['list'] = $arr;
        }
        return $data;


    }


    public function getCollectionFolders($user_id,$num=10,$curent_uid){

        $rs = CollectionFolder::select('folder_id')->where('user_id',$user_id)->groupBy('folder_id')->orderBy('id','desc');
        $rs = $rs->paginate($num);
        $data = LibUtil::pageFomate($rs);

        if (!empty($data['list'])){
            $ids = array_column($data['list'],'folder_id');
            $rows = Folder::whereIn('id',$ids)->get()->toArray();
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    $folders[$row['id']] = $row;
                }
            }
            $userIds = array_column($rows,'user_id');
            $userArr = UserService::getInstance()->getUserArr($userIds);
            $user_ids = Follow::where('user_id',$user_id)->whereIn('userid_follow',$userIds)->lists('userid_follow')->toArray();
            $folder_ids = [];
            if ($user_id !=$curent_uid){
                $folder_ids = CollectionFolder::with('folder')->where('user_id',$curent_uid)->lists('folder_id')->toArray();
                //$folder_ids = array_column($arr2,'folder_id');
                //$folder_ids  = array_unique($folder_ids);
            }
            $list = [] ;
            foreach ($data['list'] as $val) {
                $val = isset($folders[$val['folder_id']]) ? $folders[$val['folder_id']] : [];
                if (!empty($val)) {
                    $user = isset($userArr[$val['user_id']]) ? $userArr[$val['user_id']] : [];
                    if (in_array($user['id'],$user_ids)) {
                        $user['is_follow'] = 1;
                    }else{
                        $user['is_follow'] = 0;
                    }
                    $entry = [
                        'id'=>$val['id'],
                        'name'=>$val['name'],
                        'count'=>$val['count'],
                        'collection_count'=>$val['collection_count'],
                        'is_recommend'=>$val['is_recommend'],
                        'created_at'=>$val['created_at'],
                        'is_collection'=>0,
                        'is_follow'=>0,
                        'user'=>$user
                    ];
                    if ($user_id==$curent_uid || in_array($val['id'],$folder_ids)) {
                        $entry['is_collection'] = 1;
                        $entry['is_follow'] = 1;
                    }

                    $image_o = LibUtil::getPicUrl($val['image_id'], 4);
                    if (!empty($image_o)) {
                        $entry['images'][] = [
                            'img_b' => LibUtil::getPicUrl($val['image_id'], 2),
                            'img_o' => $image_o
                        ];
                    }
                    $list[] = $entry;
                }

            }
            $data['list'] = $list;
        }
        return $data;


    }

    public function addFolderCollection ($user_id,$folder_id=0) {
        $row = CollectionFolder::where(['user_id'=>$user_id,'folder_id'=>$folder_id])->first();
        if (empty($row)) {
            $folder = Folder::where(['id'=>$folder_id,'private'=>0])->first();
            if (empty($folder))return false;
            $folder = $folder->toArray();
            $rs = CollectionFolder::insert(['user_id'=>$user_id,'folder_id'=>$folder_id]);
            if ($folder_id && $rs) {
                Folder::where('id',$folder_id)->update(['collection_count'=>$folder['collection_count'] + 1]);
                if ($user_id != $folder['user_id']){
                    //发送 文件夹被收藏消息
                    $msg_content = "关注你的 {$folder['name']} 文件夹！";
                    $var = json_encode(['folder_id'=>$folder_id,'image_ids'=>$folder['image_id'],'name'=>$folder['name']]);
                    MessageService::getInstance()->addMessage($user_id,$folder['user_id'],1,$msg_content,3,$var,$folder_id);
                }

            }

        }
        return true;
    }
    public function delFolderCollection ($user_id,$good_id) {
        return CollectionFolder::where(['user_id'=>$user_id,'folder_id'=>$good_id])->delete();
    }





}