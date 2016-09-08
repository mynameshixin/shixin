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
use App\Models\Folder;
use App\Models\FolderGood;
use App\Models\Product;
use App\Models\Follow;
use Psy\Readline\Libedit;
use DB;

class FolderService extends ApiService
{

    public function update ($id,$data) {
        $entry = array();
        if (isset($data['name'])) $entry['name'] = $data['name'];
        if (isset($data['tags'])) $entry['tags'] = $data['tags'];

        if (!empty($entry)) {
            Folder::where('id', '=', $id)->update($entry);
        }
        return true;
    }

    public function  uploadAvatar ($id,$files,$image_id=0) {
        $entry = [];
        if ($image_id)$entry['image_id'] = $image_id;
        if (isset($files) && !empty($files)) {
            $rs = ImageService::getInstance()->uploadImage(0, $files);
            $image = isset($rs[0]) ? $rs[0] : current($rs);
            $entry['image_id'] = $image['image_id'];
        }
        if (!empty($entry)) {
            Folder::where('id', '=', $id)->update($entry);
        }
        return true;
    }
    /**
     * 用户创建都列表
     * @param $user_id
     * @param $params
     * @return mixed
     */
   public function create ($user_id,$params,$files=array()) {
       $entry = [
           'user_id'=>$user_id,
           'name'=>$params['name'],
           'tags'=>isset($params['tags']) ? $params['tags'] : '',
           'parent_id'=>isset($params['parent_id']) ? $params['parent_id'] : 0,
           'level'=>isset($params['level']) ? $params['level'] : 0,
           'private'=>isset($params['private']) ? $params['private'] : 0,
           'password'=>isset($params['password']) ? $params['password'] : '',
           'image_id'=>isset($params['image_id']) ? $params['image_id'] : ''
       ];


       $id =  Folder::insertGetId($entry);
       if ($id) {
           if (isset($files['image']) && !empty($files['image'])) {

               $images = ImageService::getInstance()->uploadImage($user_id, $files['image']);
               if (!empty($images)) {
                   $images_ids = array_column($images, 'image_id');
                   if(isset($images_ids[0]) && $images_ids[0])Folder::where('id',$id)->update(['image_id'=>$images_ids[0]]);
           }
           }
           //关注他的人关注他的文件夹
//           $user_ids =   Follow::where('userid_follow', $user_id)->lists('user_id')->toArray();
//           if ($user_ids) {
//               foreach ($user_ids as $user_id) {
//                   $arr[] = [
//                       'user_id'=>$user_id,
//                       'folder_id'=>$id
//                   ];
//                   CollectionFolder::insert($arr);
//               }
//           }
       }
       return$id;
   }

   public function getFolders($params,$num){
        
       $rows = new Folder;
       if (!empty($params['user_id'])) $cond['user_id'] = $params['user_id'];
       if (isset($params['private'])) $cond['private'] = $params['private'];
       if (isset($params['is_recommend'])) $cond['is_recommend'] = $params['is_recommend'];
       if(isset($cond)) $rows = $rows->where($cond);
       //去除count图片为0的
       //if (!isset($params['user_id'])) $rows = $rows->where('count','>',0);
       if (isset($params['keyword']) && !empty($params['keyword'])) {

           $keyword = fparam(urldecode($params['keyword']));

           //模糊查询
           $rows = $rows->where(function ($rows) use ($keyword) {

               $rows = $rows->where('name', "like", "%{$keyword}%")
                   ->orWhere('tags', "like", "%{$keyword}%");

           });
       }

       if (isset($params['ids']) && !empty($params['ids'])) {
           //模糊查询
           $rows = $rows->whereIn('id',$params['ids'] );
       }
       if (isset($params['sort']) && $params['sort'] == 1) {
           $rows = $rows->orderBy('collection_count', 'desc');
       } else {
           $rows = $rows->orderBy('sort', 'asc');
       }

       $rows = $rows->orderBy('count', 'desc');
       $rows = $rows->paginate($num);
       $data = LibUtil::pageFomate ($rows);
       if (!empty($data['list'])){
           $userIds = array_column($data['list'],'user_id');
           $userArr = UserService::getInstance()->getUserArr($userIds);
           $list = [] ;
           if (isset($params['current_uid']) && !empty($params['current_uid'])) {
              $arr = CollectionFolder::where('user_id',$params['current_uid'])->select('folder_id')->get()->toArray();
               $folder_ids = array_column($arr,'folder_id');
           }
           foreach ($data['list'] as $val) {
               $entry = [
                   'id'=>$val['id'],
                   'name'=>$val['name'],
                   'description'=>$val['description'],
                   'tags'=>$val['tags'],
                   'count'=>$val['count'],
                   'collection_count'=>$val['collection_count'],
                   'is_recommend'=>$val['is_recommend'],
                   'created_at'=>$val['created_at'],
                   'is_collection'=>0,
                   'private'=>$val['private'],
                   'privacy'=>$val['private'],
                   'user'=>isset($userArr[$val['user_id']]) ? $userArr[$val['user_id']] : []
               ];
               if (isset($params['current_uid']) && !empty($params['current_uid']) && in_array($val['id'],$folder_ids)) {
                   $entry['is_collection'] = 1;
               }
               if (!empty($val['image_id'])) {
                   //获取文件第一张图片
                   $image_o = LibUtil::getPicUrl($val['image_id'], 4);
                   if (!empty($image_o)) {
                       $entry['images'][] = [
                           'image_id'=>$val['image_id'],
                           'img_b' => LibUtil::getPicUrl($val['image_id'], 1),
                           'img_m' => LibUtil::getPicUrl($val['image_id'], 1),
                           'img_o' => $image_o
                       ];
                   }
               }else{

                   $images =  self::getFolderImages ($val['id'],1);
                   if (!empty($images))$entry['images'] = $images;
               }

               $list[] = $entry;
           }
           //排序
          /* $case = array_map(function($lists) use ($list){
              return $lists['count'];
           }, $list);
           array_multisort($case, SORT_NUMERIC, SORT_DESC,$list);*/

           $data['list'] = $list;

       }
       return $data;
   }

    public function getFolderArr($ids){
        $rows = new Folder;

        if (is_array($ids)) {
            //模糊查询
            $rows = $rows->whereIn('id',$ids)->get()->toArray();
        }else{
            $rows = $rows->where('id',$ids)->get()->toArray();
        }

        if (!empty($rows)){
            $userIds = array_column($rows,'user_id');
            $userArr = UserService::getInstance()->getUserArr($userIds);
            $list = [] ;
            foreach ($rows as $val) {
                $entry = [
                    'id'=>$val['id'],
                    'name'=>$val['name'],
                    'tags'=>$val['tags'],
                    'count'=>$val['count'],
                    'collection_count'=>$val['collection_count'],
                    'is_recommend'=>$val['is_recommend'],
                    'created_at'=>$val['created_at'],
                    'is_collection'=>0,
                    'private'=>$val['private'],
                    'privacy'=>$val['private'],
                    'user'=>isset($userArr[$val['user_id']]) ? $userArr[$val['user_id']] : []
                ];
                if (!empty($val['image_id'])) {
                    //获取文件第一张图片
                    $image_o = LibUtil::getPicUrl($val['image_id'], 4);
                    if (!empty($image_o)) {
                        $entry['images'][] = [
                            'image_id'=>$val['image_id'],
                            'img_b' => LibUtil::getPicUrl($val['image_id'], 1),
                            'img_m' => LibUtil::getPicUrl($val['image_id'], 1),
                            'img_o' => $image_o
                        ];
                    }
                }else{

                    $images =  self::getFolderImages ($val['id'],1);
                    if (!empty($images))$entry['images'] = $images;
                }

                $list[$entry['id']] = $entry;
            }
        }
        return is_array($ids) ?  $list : $entry;
    }



    public function getFoldersByIds ($ids) {
        $rows = Folder::whereIn('id',$ids)->get()->toArray();
        $list = [] ;
             if (!empty($rows)){
                 $userIds = array_column($rows,'user_id');
                 $userArr = UserService::getInstance()->getUserArr($userIds);

                 if (isset($params['current_uid']) && !empty($params['current_uid'])) {
                     $arr = CollectionFolder::where('user_id',$params['current_uid'])->select('folder_id')->get()->toArray();
                     $folder_ids = array_column($arr,'folder_id');
                 }
                 foreach ($rows as $val) {
                     $entry = [
                         'id'=>$val['id'],
                         'name'=>$val['name'],
                         'description'=>$val['description'],
                         'tags'=>$val['tags'],
                         'count'=>$val['count'],
                         'collection_count'=>$val['collection_count'],
                         'is_recommend'=>$val['is_recommend'],
                         'created_at'=>$val['created_at'],
                         'is_collection'=>0,
                         'private'=>$val['private'],
                         'privacy'=>$val['private'],
                         'user'=>isset($userArr[$val['user_id']]) ? $userArr[$val['user_id']] : []
                     ];
                     if (isset($params['current_uid']) && !empty($params['current_uid']) && in_array($val['id'],$folder_ids)) {
                         $entry['is_collection'] = 1;
                     }
                     if (!empty($val['image_id'])) {
                         //获取文件第一张图片
                         $image_o = LibUtil::getPicUrl($val['image_id'], 4);
                         if (!empty($image_o)) {
                             $entry['images'][] = [
                                 'image_id'=>$val['image_id'],
                                 'img_b' => LibUtil::getPicUrl($val['image_id'], 1),
                                 'img_m' => LibUtil::getPicUrl($val['image_id'], 1),
                                 'img_o' => $image_o
                             ];
                         }
                     }else{
                         $entry['images'] = self::getFolderImages ($val['id'],1);
                     }
                     $list[$val['id']] = $entry;
                 }
             }
        return $list;
    }

    public function getFolderImages ($folder_id,$num=6) {
        $rows = Product::where('folder_id',$folder_id)->where('image_ids','>','0')->select('folder_id','image_ids')->take($num)->get()->toArray();
        $list = [];
        if (!empty($rows)) {
            foreach ($rows as $row) {
                if (!empty($row['image_ids'])) {
                    $image_ids = explode(',', $row['image_ids']);
                    foreach ($image_ids as $imageId) {
                        $image_o = LibUtil::getPicUrl($imageId, 4);
                        if (!empty($image_o)) {
                                $list[] = [
                                    'image_id'=>$imageId,
                                    'img_m' => LibUtil::getPicUrl($imageId, 1),
                                    'img_b'  => LibUtil::getPicUrl($imageId, 1),
                                    'img_o' => $image_o
                                ];


                        }

                    }
                }
            }
        }
        return $list;
    }

    public function updateFolderCount ($folder_id,$image_id=0) {
        $count = FolderGood::where(['folder_id'=>$folder_id])->count();
        $folder = Folder::find($folder_id);
        $entry = [
            'count'=>$count
        ];
        if ($count==0) {
            $entry['image_id'] = 0;
        }elseif (!empty($image_id)  && empty($folder->image_id)) {
            $entry['image_id'] = $image_id;
        }

        Folder::where('id',$folder_id)->update($entry);
        return true;
    }

    public function getSearchCount ($keyword,$data=[]) {
        $keyword = fparam($keyword);
        $rows = new Folder;
        if(!empty($data['user_id'])){
            $rows = $rows->where('user_id',$data['user_id']);
        }
        return $rows->where(function ($rows) use ($keyword) {
         $rows  = $rows->where('name', "like" , "%{$keyword}%")->orWhere('tags','like',"%{$keyword}%");
       })->count();
    }

    public function delFolder($id)
    {
        Product::where('folder_id',$id)->delete();
        FolderGood::where('folder_id',$id)->delete();
        CollectionFolder::where('folder_id',$id)->delete();
        DB::table('collection_good')->where('folder_id',$id)->delete();
        CollectionFolder::where('folder_id',$id)->delete();
        Folder::where('id',$id)->delete();
        return true;
    }


}