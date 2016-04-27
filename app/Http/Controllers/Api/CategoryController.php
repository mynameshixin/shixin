<?php
namespace App\Http\Controllers\Api;
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/10
 * Time: 下午1:39
 */
use App\Lib\LibUtil;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Input;

/**
 *
 * @SWG\Resource(
 *   apiVersion="2.0.0",
 *   swaggerVersion="1.2",
 *   resourcePath="/categories",
 *   description="分类相关",
 *   @SWG\Produces("application/json")
 * )
 */
 class CategoryController extends BaseController {
     /**
      *
      * @SWG\Api(path="/categories",
      *   @SWG\Operation(
      *     method="GET",
      *     summary="分类列表",
      *     notes="",
      *     @SWG\Parameter(
      *           name="level",
      *           description="分类级别",
      *           paramType="query",
      *           required=false,
      *           type="string"
      *     ),
      *     @SWG\Parameter(
      *           name="parent_id",
      *           description="父级ID",
      *           paramType="query",
      *           required=false,
      *           type="string"
      *     ),
      *     @SWG\Parameter(
      *           name="kind",
      *           description="分类： 1商品分类 2 图片分类 ，默认 1",
      *           paramType="query",
      *           required=false,
      *           type="string"
      *     ),
      *     authorizations={},
      *   )
      * )
      * */
     public function index() {
         $data = Input::all();
         $cond = [];
         $cond['kind'] = isset($data['kind']) ? $data['kind'] : 1;
         if (isset($data['level'])) $cond['level'] = $data['level'];
         if (isset($data['parent_id'])) $cond['parent_id'] = $data['parent_id'];
         if (!empty($cond)) {
             $rows = Category::where($cond)->get()->toArray();
         } else {
             $rows = Category::All()->toArray();
         }
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $entry = [
                    'id'=>$row['id'],
                    'level'=>$row['level'],
                    'parent_id'=>$row['parent_id'],
                    'name' => $row['name'],
                    'img' => '',
                ];
                if($row['image_id'])$entry['img'] = LibUtil::getPicUrl($row['image_id'],3);
                $list[] = $entry;
            }
        }
        return response()->forApi($list , 200);
     }

     /**
      *
      * @SWG\Api(path="/category/recommend",
      *   @SWG\Operation(
      *     method="GET",
      *     summary="推荐分类列表",
      *     notes="",
      *     @SWG\Parameter(
      *           name="kind",
      *           description="分类： 1商品分类 2 图片分类 ，默认 1",
      *           paramType="query",
      *           required=false,
      *           type="string"
      *     ),
      *     authorizations={},
      *   )
      * )
      * */
     public function getRecommend() {
         $data = Input::all();
         $cond = [];
         $cond['kind'] = isset($data['kind']) ? $data['kind'] : 1;
         if (isset($data['level'])) $cond['level'] = 2;
         $cond['recommend'] = 1;
         if (!empty($cond)) {
             $rows = Category::where($cond)->get()->toArray();
         } else {
             $rows = Category::All()->toArray();
         }
         if (!empty($rows)) {
             foreach ($rows as $row) {
                 $entry = [
                     'id'=>$row['id'],
                     'level'=>$row['level'],
                     'parent_id'=>$row['parent_id'],
                     'name' => $row['name'],
                     'img' => '',
                 ];
                 if($row['image_id'])$entry['img'] = LibUtil::getPicUrl($row['image_id'],3);
                 $list[] = $entry;
             }
         }
         return response()->forApi($list , 200);
     }

     /**
      *
      * @SWG\Api(path="/category/tree",
      *   @SWG\Operation(
      *     method="GET",
      *     summary="分类树",
      *     notes="",
      *     @SWG\Parameter(
      *           name="kind",
      *           description="分类： 1商品分类 2 图片分类 ，默认 1",
      *           paramType="query",
      *           required=false,
      *           type="string"
      *     ),
      *     authorizations={},
      *   )
      * )
      * */
     public function getTree() {
         $data = Input::all();
         $kind = isset($data['kind']) ? $data['kind'] : 1;

         $list = CategoryService::getInstance()->getCategoryTree($pid = 0, $level = 1,$kind);

         return response()->forApi($list , 200);
     }
     /**
      *
      * @SWG\Api(path="/category/hot",
      *   @SWG\Operation(
      *     method="GET",
      *     summary="热门检索分类",
      *     notes="",
      *     authorizations={},
      *   )
      * )
      * */
     public function getHot() {
         $rows = Category::take(6)->orderBy('hot','desc')->get()->toArray();

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
         return response()->forApi($list , 200);
     }


 }