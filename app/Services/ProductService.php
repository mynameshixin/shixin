<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/19
 * Time: 下午1:32
 */
namespace App\Services;

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

    public function delFolderProduct($good_id,$folder_id){
        $rs  = FolderGood::where(['good_id'=>$good_id,'folder_id'=>$folder_id])->delete();
        Product::where(['id'=>$good_id,'folder_id'=>$folder_id])->delete();
        FolderService::getInstance()->updateFolderCount ($folder_id);
        return true;

    }

    public function delProduct($id)
    {
        $good = Product::find($id);
        Product::where('id',$id)->update(['folder_id'=>0,'is_delete'=>1]);
        if($good && $good->folder_id>0){
            FolderGood::where(['good_id'=>$id,'action'=>0,'user_id'=>$good->user_id])->delete();
            GoodAction::where(['good_id'=>$id])->delete();
            FolderService::getInstance()->updateFolderCount ($good->folder_id);

        }
        return $good;
    }

    /**
     * 新增商品
     * @param $userId
     * @param array $data
     * @return int
     */
    public function addProduct($userId, $data = array(), $files = array())
    {
        if ($data['kind'] == 2) {
            return self::addImageProduct($userId, $data , $files );
        }
        $tags = isset($data['tags']) ? trim($data['tags']) : '';
        if(isset($data['folder_name'])) $tags =  $tags.';'.$data['folder_name'];
        $entry = array(
            'user_id' => $userId,
            'kind' => $data['kind'],
            'title' => isset($data['title']) ? $data['title'] : $data['title'],
            'description' => isset($data['description']) ? $data['description'] : '',
            'category_id' => isset($data['category_id']) ? $data['category_id'] : 0,
            'price' => isset($data['price']) ? $data['price'] : 0,
            'reserve_price' => isset($data['reserve_price']) ? $data['reserve_price'] : 0,
            'is_mall' => isset($data['is_mall']) ? $data['is_mall'] : 0,
            //'tb_item_id' => isset($data['tb_item_id']) ? $data['tb_item_id'] : '',
            //'tb_id' => isset($data['tb_iid']) ? $data['tb_id'] : '',
            'detail_url' => isset($data['detail_url']) ? $data['detail_url'] : '',
            'folder_id' => isset($data['folder_id']) ? $data['folder_id'] : 0,
            'status' => isset($data['status']) ? $data['status'] : 0,
            'is_recommend' => isset($data['is_recommend']) ? $data['is_recommend'] : 0,
            'source' => isset($data['source']) ? $data['source'] : 0,
            'sort' => isset($data['sort']) ? $data['sort'] : 9999,
            'cityid'=>isset($data['cityid']) ? (int)$data['cityid'] : 0,
            'devid'=>isset($data['devid']) ? (int)$data['devid'] : 0,
            'huid'=>isset($data['huid']) ? (int)$data['huid'] : 0,
            'typeid'=>isset($data['typeid']) ? (int)$data['typeid'] : 0,
            'btypeid'=>isset($data['btypeid']) ? (int)$data['btypeid'] : 0,
            'saleid'=>isset($data['saleid']) ? (int)$data['saleid'] : 0,
            'tags' => $tags,
        );
        if (isset($data['image_ids']) && !empty($data['image_ids'])) {
            $entry['image_ids'] = $data['image_ids'];
            $data['image_ids'] = trim($data['image_ids']);
            $images_arr = explode(',', $data['image_ids']);
        }
        $id = Product::insertGetId($entry);
        if (isset($files['image']) && !empty($files['image'])) {

            $images = ImageService::getInstance()->uploadImage($userId, $files['image']);
            if (!empty($images)) {
                $images_arr = array_column($images, 'image_id');
                $image_ids = implode(',', $images_arr);
                Product::where(['id' => $id])->update(['image_ids' => $image_ids]);
            }
        }
        $entry['folder_id'] = isset( $entry['folder_id']) ?   $entry['folder_id'] : 0;
        FolderGood::insert(['good_id' => $id, 'folder_id' => $entry['folder_id'],'kind'=>$data['kind'],'user_id'=>$userId]);
        if (!empty($entry['folder_id'])) {

            //修改文件夹商品数量
           // $image_id = current($images_arr);
            $image_id = isset($images_arr[0]) ? $images_arr[0] : 0;
            FolderService::getInstance()->updateFolderCount($entry['folder_id'], $image_id);

        }
        return $id;
    }

    public function addImageProduct($userId, $data = array(), $files = array())
    {
        $data['title'] = isset($data['title']) ? trim($data['title']) : '';
        $tags = isset($data['tags']) ? trim($data['tags']) : '';
        if(isset($data['folder_name'])) $tags =  $tags.';'.$data['folder_name'];
        $entry = array(
            'user_id' => $userId,
            'kind' => $data['kind'],
            'title' => $data['title'],
            'tags' => $tags,
            'description' => isset($data['description']) ? $data['description'] : '',
            'category_id' => isset($data['category_id']) ? $data['category_id'] : 0,
            'price' => isset($data['price']) ? $data['price'] : 0,
            'reserve_price' => isset($data['reserve_price']) ? $data['reserve_price'] : 0,
            'is_mall' => isset($data['is_mall']) ? $data['is_mall'] : 0,
            'detail_url' => isset($data['detail_url']) ? $data['detail_url'] : '',
            'folder_id' => isset($data['folder_id']) ? $data['folder_id'] : 0,
            'status' => isset($data['status']) ? $data['status'] : 0,
            'is_recommend' => isset($data['is_recommend']) ? $data['is_recommend'] : 0,
            'source' => isset($data['source']) ? $data['source'] : 0,
            'sort' => isset($data['sort']) ? $data['sort'] : 9999,
            'cityid'=>isset($data['cityid']) ? (int)$data['cityid'] : 0,
            'devid'=>isset($data['devid']) ? (int)$data['devid'] : 0,
            'huid'=>isset($data['huid']) ? (int)$data['huid'] : 0,
            'typeid'=>isset($data['typeid']) ? (int)$data['typeid'] : 0,
            'btypeid'=>isset($data['btypeid']) ? (int)$data['btypeid'] : 0,
            'saleid'=>isset($data['saleid']) ? (int)$data['saleid'] : 0,
        );
        if (isset($data['image_ids']) && !empty($data['image_ids'])) {
            $entry['image_ids'] = $data['image_ids'];
            $data['image_ids'] = trim($data['image_ids']);
            $images_arr = explode(',', $data['image_ids']);
        }
        if (isset($files['image']) && !empty($files['image'])) {
            $images = ImageService::getInstance()->uploadImage($userId, $files['image']);
            if (!empty($images)) {
                $images_arr = array_column($images, 'image_id');
            }
        }
        $entry['folder_id'] = isset( $entry['folder_id']) ?   $entry['folder_id'] : 0;
        if (!empty($images_arr)) {
            if (empty($entry['title']))$fileNames = Images::whereIn('id',$images_arr)->lists('name','id')->toArray();
            foreach ($images_arr as $image_id) {
                if(isset($fileNames[$image_id]) && $fileNames[$image_id] && empty($data['title'])){
                    $entry['title']= $fileNames[$image_id];
                    $entry['title']= str_replace(strrchr($entry['title'], "."),"",$entry['title']);
                }
                $entry['image_ids'] = $image_id;
                $id = Product::insertGetId($entry);
               FolderGood::insert(['good_id' => $id, 'folder_id' => $entry['folder_id'],'kind'=>$data['kind'],'user_id'=>$userId]);
            }
        } else {

            $id = Product::insertGetId($entry);
            FolderGood::insert(['good_id' => $id, 'folder_id' => $entry['folder_id'],'kind'=>$data['kind'],'user_id'=>$userId]);
        }


        if (!empty($entry['folder_id'])) {
            //修改文件夹商品数量
            $image_id = isset($images_arr[0]) ? $images_arr[0] : 0;
            FolderService::getInstance()->updateFolderCount($entry['folder_id'], $image_id);
        }
        return $id;
    }

    public function updateProduct($productId, $data = array())
    {
        $good = Product::find($productId);
        if (empty($good)) return false;
        $good = $good->toArray();

        if (isset($data['kind'])) $entry['kind'] = $data['kind'];
        if (isset($data['title'])) $entry['title'] = trim($data['title']);
        if (isset($data['tags'])) $entry['tags'] = trim($data['tags']);
        if (isset($data['category_id'])) $entry['category_id'] = $data['category_id'];
        if (isset($data['description'])) $entry['description'] = $data['description'];
        if (isset($data['price'])) $entry['price'] = $data['price'];
        if (isset($data['reserve_price'])) $entry['reserve_price'] = $data['reserve_price'];
        if (isset($data['category_id'])) $entry['category_id'] = $data['category_id'];
        if (isset($data['user_id'])) $entry['user_id'] = $data['user_id'];
        if (isset($data['image_ids'])) $entry['image_ids'] = $data['image_ids'];
        if (isset($data['is_recommend'])) $entry['is_recommend'] = $data['is_recommend'];
        if (isset($data['detail_url'])) $entry['detail_url'] = $data['detail_url'];
        if (isset($data['description'])) $entry['description'] = $data['description'];
        if (isset($data['title'])) $entry['title'] = $data['title'];
        if (isset($data['sort'])) $entry['sort'] = $data['sort'];
        if (isset($data['status'])) $entry['status'] = $data['status'];
        if (isset($data['folder_id']) && !empty($data['folder_id']) && $data['folder_id'] !=$good['folder_id']) {
            $entry['folder_id'] = $data['folder_id'];
            FolderGood::where(['folder_id'=>$good['folder_id'],'good_id'=>$productId])->delete();
            FolderGood::insert(['good_id' => $productId, 'folder_id' => $entry['folder_id'],'kind'=>$good['kind'],'user_id'=>$good['user_id']]);
            //修改文件夹商品数量
            FolderService::getInstance()->updateFolderCount($entry['folder_id']);
        }
        if (isset($data['image_ids'])) {

            if ($good['kind']==2 && $good['image_ids']!=$data['image_ids']){
                $images_arr = explode(',',$data['image_ids']);
                $image_id = isset($images_arr[0]) ? $images_arr[0] : 0;
                //if (!isset($entry['title']) && empty($entry['title'])) $fileNames = Images::whereIn('id',$images_arr)->lists('name','id')->toArray();
		$fileNames = Images::whereIn('id',$images_arr)->lists('name','id')->toArray();
                $entry['title']= $fileNames[$image_id];
                $entry['title']= pathinfo($entry['title'],PATHINFO_FILENAME);
            }
        }
        if (isset($entry)) $id = Product::where('id', $productId)->update($entry);

        return isset($id) ? $id : false;
    }

    public function getPraiseProductList($user_id, $params, $num = 10)
    {
        $rows = GoodAction::where(['user_id' => $user_id, 'action' => 1]);
        if (isset($params['kind'])) $rows = $rows->where('kind', $params['kind']);
        $rows = $rows->select('good_id');
        $rows = $rows->OrderBy('id','DESC')->paginate($num);
        $outDate = LibUtil::pageFomate($rows);

        if (!empty($outDate['list'])) {
            $entry['ids'] = $product_ids = array_column($outDate['list'], 'good_id');
            $entry['sort'] = 2;
            $list = self::getProductListByIds($product_ids, $entry);
            $list = array_values($list);
            $outDate['list'] = $list;
        }
        return $outDate;

    }

    public  function getUserProducts ($uids,$params,$num) {
        if (is_array($uids)) {
            $rows = FolderGood::whereIn('user_id',$uids);
        }else{
            $rows = FolderGood::where('user_id',$uids);
        }

        if (isset($params['kind'])) $rows = $rows->where('kind', $params['kind']);
        $rows = $rows->select('good_id')->groupBy('good_id')->orderBy('id','desc');
        $rows = $rows->paginate($num);
        $outDate = LibUtil::pageFomate($rows);
        if (!empty($outDate['list'])) {
            $params['ids'] = $product_ids = array_column($outDate['list'], 'good_id');
            $params['sort'] = 2;
            $list = self::getProductListByIds($product_ids, $params);
            $list = array_values($list);
            $outDate['list'] = $list;
        }
        return $outDate;
    }


    public  function getProductsByFids ($folder_ids,$user_ids,$params,$num,$self_id){
        $kind = isset($params['kind']) ? $params['kind'] : 1;
        $user_ids = array_unique($user_ids);
        $self_id  = !empty($self_id)?$self_id:0;
        //加入$self_id
        /*if(!empty($self_id)){
            $rows = FolderGood::where('kind', $kind);
            $rows = $rows->join('folders','folder_goods.folder_id','=','folders.id');
            $rows = $rows->where('folder_goods.user_id',$self_id);     
            $rows = $rows->select('folder_goods.id','folder_goods.good_id','folder_goods.user_id','folder_goods.folder_id','folder_goods.created_at','folders.private')->orderBy('folder_goods.created_at','desc');
            $rows = $rows->paginate(2);
            $outDate_self = LibUtil::pageFomate($rows);
        }
        $outDate_self = !empty($outDate_self)?$outDate_self:[];
        $count_self = isset($outDate_self['list'])?count($outDate_self['list']):0;*/

        $rows = FolderGood::where('folder_goods.kind', $kind);
        $rows = $rows->join('folders','folder_goods.folder_id','=','folders.id')->where('folders.private',0);
        if (empty($folder_ids)) {
            $rows = $rows->whereIn('folder_goods.user_id',$user_ids);
        }else{
            $rows = $rows->where(function ($rows) use ($user_ids,$folder_ids,$self_id) {
                $rows = $rows->whereIn('folder_goods.user_id',$user_ids)
                    ->orwhereIn('folder_goods.folder_id',$folder_ids);
            });
        }        
        // $rows = $rows->where('folders.private',0);
        $rows = $rows->select('folder_goods.id','folder_goods.good_id','folder_goods.user_id','folder_goods.folder_id','folder_goods.created_at','folders.private')->orderBy('folder_goods.created_at','desc')->orderBy('folder_goods.id','desc');
        $rows = $rows->paginate($num);
        $outDate = LibUtil::pageFomate($rows);
        
        
        //融合
       /* if(!empty($outDate_self) && isset($outDate_self['list'])){
            $outDate['list'] = array_merge($outDate_self['list'],$outDate['list']);
            $outDate['per_page']  = $count_self+$count;
        }*/
        /*$count = 0;
        foreach ($outDate['list'] as $key => $value) {
            if($value['private'] == 1 && $self_id != $value['user_id']){
                unset($outDate['list'][$key]);
                $count++;
            }
            
        }
        $outDate['per_page'] = $num-$count;*/

        if (!empty($outDate['list'])) {
            $params['ids'] = $product_ids = array_column($outDate['list'], 'good_id');
            //$params['sort'] = 2;
            $list = self::getProductListByIds($product_ids, $params,false);
            $user_ids = array_column($outDate['list'], 'user_id');
            $userArr = UserService::getInstance()->getUserArr($user_ids);
            $arr = [];
            foreach ($outDate['list'] as $v) {
                if (isset($list[$v['good_id']])) {
                    $good = $list[$v['good_id']];
                    if (isset($userArr[$v['user_id']])) $good['user'] = $userArr[$v['user_id']] ;
                    //$good['c_id'] = $v['id'];
                    $good['folder_id'] = $v['folder_id'];
                    $good['created_at'] = $v['created_at'];
                    $arr[] =$good;
                }
            }
            $outDate['list'] = $arr;
        }
        return $outDate;
    }

    public function getRelationProducts($good_id, $num = 10,$kind=0)
    {
        $rs = GoodAction::where('good_id', $good_id)->select('user_id')->get()->toArray();
        $user_ids = array_column($rs, 'user_id');
        if (!empty($kind)){
            $rows = GoodAction::whereIn('user_id', $user_ids)->where(['action'=>1,'kind'=>$kind])->where('good_id', '<>', $good_id)->select('good_id');
        }else{
            $rows = GoodAction::whereIn('user_id', $user_ids)->where('action', 1)->where('good_id', '<>', $good_id)->select('good_id');
        }

        $rows = $rows->paginate($num);
        $outDate = LibUtil::pageFomate($rows);

        if (!empty($outDate['list'])) {
            $params['ids'] = $product_ids = array_column($outDate['list'], 'good_id');
            if($kind)$params['kind'] = $kind;
            //$data = self::getProductList($params, $num);
            $list = self::getProductListByIds($product_ids);
            $list = array_values($list);
            $outDate['list'] = $list;
        }
        return $outDate;
    }


    /**
     * @param $params
     * @param int $last_id
     * @param int $num
     */
    public function getProductList($params, $num = 10,$self_id = 0,$uid=0)
    {
        $condtion = ['goods.is_delete' => 0,'goods.status'=>1];
//        if (!isset($data['self']) || empty($data['self'])) {
//            $condtion['status'] = 1;
//        }
        if (isset($params['category_id'])) {
            $condtion['goods.category_id'] = $params['category_id'];
            //更新分类检索次数
            CategoryService::getInstance()->updateCategoryHot($params['category_id']);
        }
        if (isset($params['is_delete'])) $condtion['goods.is_delete'] = $params['is_delete'];
        if (isset($params['kind'])) $condtion['goods.kind'] = $params['kind'];
        if (!empty($params['user_id'])) $condtion['goods.user_id'] = $params['user_id'];
        if (isset($params['folder_id'])) {
            if ($params['folder_id'] > 0) {
                $params['ids'] = self::getFolderGoodIds($params['folder_id']);
            }
            if (empty($params['ids'])) {
                $condtion['goods.folder_id'] = $params['folder_id'];
            }


        }
        if (isset($params['folder_ids'])) {
            if(isset($params['good_id'])){
                $params['ids'] = FolderGood::where('goods.good_id','<>',$params['good_id'])->whereIn('goods.folder_id',$params['folder_ids'])->lists('good_id')->toArray();
            }else{
                $params['ids'] = FolderGood::whereIn('goods.folder_id',$params['folder_ids'])->lists('goods.good_id')->toArray();
            }


        }

        if (isset($params['is_recommend'])) $condtion['goods.is_recommend'] = $params['is_recommend'];

        $rows = Product::where($condtion);
        
        if (isset($params['ids']) ) {
            $rows = $rows->whereIn('goods.id', $params['ids']);
        }

        if (isset($params['user_ids']) ) {
            $rows = $rows->whereIn('goods.user_id', $params['user_ids']);
        }
        if (isset($params['keyword']) && !empty($params['keyword'])) {
            $keyword = urldecode($params['keyword']);
            //模糊查询
            $rows = $rows->where(function ($rows) use ($keyword) {

                $rows = $rows->where('goods.title', "like", "%{$keyword}%")
                    ->orWhere('goods.tags', "like", "%{$keyword}%");

            });
            
        }
       
        $rows = $rows->select('goods.id', 'goods.user_id', 'goods.kind', 'goods.price', 'goods.folder_id', 'goods.reserve_price', 'goods.image_ids', 'goods.title', 'goods.tags', 'goods.category_id', 'goods.description', 'goods.source', 'goods.is_recommend', 'goods.collection_count', 'goods.praise_count', 'goods.boo_count', 'goods.detail_url', 'goods.created_at');
        if (isset($params['sort']) && $params['sort'] == 1) {
            $rows = $rows->orderBy('goods.collection_count', 'desc');
        } elseif (isset($params['sort']) && $params['sort'] == 2) {
            $rows = $rows->orderBy('goods.praise_count', 'desc');
        } elseif(isset($params['sort']) && $params['sort'] == 0) {
            $rows = $rows->orderBy('goods.sort', 'asc')->orderBy('goods.is_recommend', 'asc');
        }
//        if (isset($params['folder_id'])){
//            $rows = $rows->orderBy('updated_at', 'desc');
//        }else{
//            $rows = $rows->orderBy('id', 'desc');
//        }
        $rows = $rows->orderBy('goods.updated_at', 'desc');

        if($self_id!=$uid){
            $rows = $rows->leftJoin('folders','goods.folder_id','=','folders.id')->where('folders.private',0);
        }else{
            $rows = $rows->leftJoin('folders','goods.folder_id','=','folders.id');
        }

        $rows = $rows->paginate($num);
        $outDate = LibUtil::pageFomate($rows);
        if (!empty($outDate['list'])) {
            $user_ids = array_column($outDate['list'], 'user_id');
            $userArr = UserService::getInstance()->getUserArr($user_ids);
            $good_ids = array_column($outDate['list'], 'id');
            $commentArr = CommentService::getInstance()->getCommentFirst($good_ids);
            $folder_ids = array_column($outDate['list'], 'folder_id');
            $folderArr = Folder::whereIn('id', $folder_ids)->lists('name', 'id')->toArray();
            
            foreach ($outDate['list'] as &$row) {
                $row['folder_name'] = isset($folderArr[$row['folder_id']]) ? $folderArr[$row['folder_id']] : '';
                $row['source'] = isset(self::$sources[$row['source']]) ? self::$sources[$row['source']] : '';
                if (isset($commentArr[$row['id']])) $row['comment'] = $commentArr[$row['id']];
                if (!empty($row['image_ids'])) {
                    $image_ids = explode(',', $row['image_ids']);
                    foreach ($image_ids as $imageId) {
                        //var_dump($imageId);
                        $fileNames = Images::where('id', $imageId)->lists('name', 'id')->toArray();
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
            }
        }

        return $outDate;
    }

    public function getFolderGoodIds($folder_id)
    {
        $rows = FolderGood::where('folder_id', $folder_id)->select('good_id')->get()->toArray();
        $ids = array_column($rows, 'good_id');
        return $ids;
    }

    public function getProductListByIds($product_ids, $params = [],$user_info=true)
    {
        $rows = Product::whereIn('id', $product_ids);
        //$condtion = [];
        $condtion = ['is_delete' => 0,'status'=>1];
        if (isset($params['kind'])) $condtion['kind'] = $params['kind'];
        if (isset($params['user_id'])) $condtion['user_id'] = $params['user_id'];
        if (!empty($condtion)) $rows = $rows->where($condtion);

        $rows = $rows->select('id', 'user_id', 'folder_id', 'kind', 'price', 'reserve_price', 'image_ids', 'title', 'tags', 'category_id', 'description', 'source', 'is_recommend', 'collection_count', 'praise_count', 'boo_count', 'detail_url', 'created_at');
        $rows = $rows->get()->toArray();
        $list = [];
        if (!empty($rows)) {
            if ($user_info) {
                $user_ids = array_column($rows, 'user_id');
                $userArr = UserService::getInstance()->getUserArr($user_ids);
            }

            $folder_ids = array_column($rows, 'folder_id');
            $folderArr = Folder::whereIn('id', $folder_ids)->lists('name', 'id')->toArray();
            $commentArr = CommentService::getInstance()->getCommentFirst($product_ids);
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

    public function getProductDetail($id)
    {
        $row = Product::where(['is_delete' => 0])->find($id);
        if (empty($row)) return false;
        $row = $row->toArray();
        $row['source'] = isset(self::$sources[$row['source']]) ? self::$sources[$row['source']] : '';
        if (!empty($row['image_ids'])) {
            $image_ids = explode(',', $row['image_ids']);
            foreach ($image_ids as $imageId) {
                $image_o = LibUtil::getPicUrl($imageId, 3);
                $fileNames = Images::where('id', $imageId)->lists('name', 'id')->toArray();
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
        $rs =  FolderGood::where('good_id',$id)->OrderBy('id','desc')->first();
        $user_id = isset($rs->user_id) ? $rs->user_id : $row['user_id'];
        $userArr = UserService::getInstance()->getUserArr([$user_id]);
        $row['user'] = isset($userArr[$user_id]) ? $userArr[$user_id] : [];
        if(isset($rs->folder_id)) $row['folder_id'] = $rs->folder_id;
        $row['created_at'] = $rs->created_at;
        if ($row['folder_id']){
            $row['folder'] = FolderService::getInstance()->getFolderArr($row['folder_id']);
        }
        return $row;

    }

    public function addAction($user_id, $good_id, $action = 1)
    {
        $good = Product::find($good_id);
        if (empty($good)) return false;
        $good = $good->toArray();
        $row = GoodAction::where(['user_id' => $user_id, 'good_id' => $good_id, 'action' => $action])->first();
        $rs = true;
        if (empty($row)) {
            $entry = [
                'user_id' => $user_id,
                'good_id' => $good_id,
                'kind' => $good['kind'],
                'action' => $action
            ];
            $rs = GoodAction::insert($entry);
            if ($rs) {
                if ($action == 2) {
                    $entry2['boo_count'] = $good['boo_count'] + 1;
                } else {
                    $entry2['praise_count'] = $good['praise_count'] + 1;

                }
                Product::where('id', $good_id)->update($entry2);
            }
        }
        return $rs;
    }

    public function getActionUsers($good_id, $action, $num = 20)
    {
        $rows = GoodAction::where(['good_id' => $good_id, 'action' => $action])->select('user_id')->orderBy('id', 'desc')->paginate($num);

        $outDate = LibUtil::pageFomate($rows);
        $user_ids = array_column($outDate['list'], 'user_id');
        $users = UserService::getInstance()->getUserArr($user_ids);
        $outDate['list'] = $users;
        return $outDate;
    }

    public function getSearchCount($keyword, $kind,$data=[])
    {   $keyword = fparam($keyword);
        $rows = Product::where(['kind' => $kind, 'status' => 1]);
        
        if(!empty($data['user_id'])){
            $rows = $rows->where('user_id',$data['user_id']);
        }
        
        return $rows->where(function($query) use ($keyword){
            $query->where('title', "like", "%{$keyword}%")->orWhere('tags','like',"%{$keyword}%");
        })->count();
    }
}
