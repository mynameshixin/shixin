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
        $entry = array(
            'user_id' => $userId,
            'kind' => $data['kind'],
            'title' => $data['title'],
            'tags' => isset($data['tags']) ? trim($data['tags']) : '',
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
                if (!isset($entry['title']) && empty($entry['title']))$fileNames = Images::whereIn('id',$images_arr)->lists('name','id')->toArray();
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

    public  function getProductsByFids ($folder_ids,$user_ids,$params,$num) {
        $kind = isset($params['kind']) ? $params['kind'] : 1;
        $user_ids = array_unique($user_ids);
        $rows = FolderGood::where('kind', $kind);
        if (empty($folder_ids)) {
            $rows = $rows->whereIn('user_id',$user_ids);
        }else{
            $rows = $rows->where(function ($rows) use ($user_ids,$folder_ids) {
                $rows = $rows->whereIn('user_id',$user_ids)
                    ->orwhereIn('folder_id',$folder_ids);

            });
        }
        //$rows = $rows->select('id','good_id','user_id')->groupBy('good_id')->orderBy('id','desc');
        $rows = $rows->select('id','good_id','user_id','folder_id','created_at')->orderBy('id','desc');
        //echo $rows->toSql();
       // exit();
        $rows = $rows->paginate($num);
        $outDate = LibUtil::pageFomate($rows);
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
    public function getProductList($params, $num = 10)
    {
        $condtion = ['is_delete' => 0,'status'=>1];
//        if (!isset($data['self']) || empty($data['self'])) {
//            $condtion['status'] = 1;
//        }
        if (isset($params['category_id'])) {
            $condtion['category_id'] = $params['category_id'];
            //更新分类检索次数
            CategoryService::getInstance()->updateCategoryHot($params['category_id']);
        }
        if (isset($params['is_delete'])) $condtion['is_delete'] = $params['is_delete'];
        if (isset($params['kind'])) $condtion['kind'] = $params['kind'];
        if (isset($params['user_id'])) $condtion['user_id'] = $params['user_id'];
        if (isset($params['folder_id'])) {
            if ($params['folder_id'] > 0) {
                $params['ids'] = self::getFolderGoodIds($params['folder_id']);
            }
            if (empty($params['ids'])) {
                $condtion['folder_id'] = $params['folder_id'];
            }


        }
        if (isset($params['folder_ids'])) {
            if(isset($params['good_id'])){
                $params['ids'] = FolderGood::where('good_id','<>',$params['good_id'])->whereIn('folder_id',$params['folder_ids'])->lists('good_id')->toArray();
            }else{
                $params['ids'] = FolderGood::whereIn('folder_id',$params['folder_ids'])->lists('good_id')->toArray();
            }


        }

        if (isset($params['is_recommend'])) $condtion['is_recommend'] = $params['is_recommend'];

        $rows = Product::where($condtion);
        if (isset($params['ids']) ) {
            $rows = $rows->whereIn('id', $params['ids']);
        }
        if (isset($params['user_ids']) ) {
            $rows = $rows->whereIn('user_id', $params['user_ids']);
        }
        if (isset($params['keyword']) && !empty($params['keyword'])) {
            $keyword = urldecode($params['keyword']);
            //模糊查询
            $rows = $rows->where(function ($rows) use ($keyword) {

                $rows = $rows->where('title', "like", "%{$keyword}%")
                    ->orwhere('tags', "like", "%{$keyword}%");

            });
        }
        $rows = $rows->select('id', 'user_id', 'kind', 'price', 'folder_id', 'reserve_price', 'image_ids', 'title', 'tags', 'category_id', 'description', 'source', 'is_recommend', 'collection_count', 'praise_count', 'boo_count', 'detail_url', 'created_at');
        if (isset($params['sort']) && $params['sort'] == 1) {
            $rows = $rows->orderBy('collection_count', 'desc');
        } elseif (isset($params['sort']) && $params['sort'] == 2) {
            $rows = $rows->orderBy('praise_count', 'desc');
        } elseif(isset($params['sort']) && $params['sort'] == 0) {
            $rows = $rows->orderBy('sort', 'asc')->orderBy('is_recommend', 'asc');
        }
//        if (isset($params['folder_id'])){
//            $rows = $rows->orderBy('updated_at', 'desc');
//        }else{
//            $rows = $rows->orderBy('id', 'desc');
//        }
        $rows = $rows->orderBy('updated_at', 'desc');

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
            $fileNames = Images::where('name', '>', '0')->lists('name', 'id')->toArray();
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

    public function getSearchCount($keyword, $kind)
    {
        $rows = Product::where(['kind' => $kind, 'status' => 1]);
        return $rows->where('title', "like", "%{$keyword}%")->count();
    }
}