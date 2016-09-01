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
                 if($row['image_id'])$entry['img'] = LibUtil::getPicUrl($row['image_id'],1);
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
         $data = [
            [
              'id'=>1,'level'=>1,'name'=>'风格','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'现代','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'北欧','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'日式','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'法式','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'新中式','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'新古典','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'简欧','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'古典中式','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'古典','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'地中海','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'LOFT','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'东南亚','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'美式工业','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'美式田园','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'美式简约','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'巴洛克','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'意大利','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'混搭','name_e'=>'']
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'居家空间','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'客厅','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'玄关','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'餐厅','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'卧室','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'阳台','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'厨房','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'书房','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'阳光房','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'庭院','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'花园','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'衣帽间','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'卫生间','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'酒窖','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'阁楼','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'走道','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'楼梯过厅','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'儿童房','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'商业空间','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'餐饮店','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'酒店','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'民宿','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'售楼处','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'样板房','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'办公室','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'商业广场','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'沙发','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'三人沙发','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'双人沙发','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'单人沙发','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'沙发床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'布艺沙发','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'皮质沙发','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'古典沙发','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'现代沙发','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'美式沙发','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'东南亚沙发','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'简欧沙发','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'日式沙发','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'桌','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'餐桌','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'书桌','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'茶几','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'办公桌','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'梳妆台','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'吧台','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'会议桌','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'沙发桌','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'咖啡桌','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'床','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'双人床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'儿童床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'单人床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'实木床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'板式床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'铁艺床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'水床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'吊床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'榻榻米床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'欧式床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'折叠床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'美式床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'地中海床','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'高低床','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'柜','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'电视柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'衣柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'书柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'床头柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'浴室柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'酒柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'玄关柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'五斗柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'橱柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'餐边柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'餐具柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'食品柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'文件柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'组合柜','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'吧柜','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'架子','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'书架','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'鞋架','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'衣帽架','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'花架','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'伞架','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'博古架','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'格架','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'其他','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'隔断','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'窗帘','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'淋浴','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'浴缸','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'颜色','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'红','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'橙','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'黄','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'绿','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'青','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'蓝','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'紫','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'黑','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'白','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'灰','name_e'=>''],

              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'装饰摆设','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'摆件','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'镜子','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'钟','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'装置画','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'香薰','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'挂钩','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'收纳','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'相框','name_e'=>''],

              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'灯饰','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'台灯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'吊灯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'壁灯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'户外灯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'镜前灯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'吸顶灯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'创意','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'落地灯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'厨卫灯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'水晶灯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'铜灯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'阳台灯','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'家纺家饰','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'床品','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'抱枕','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'布料','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'窗帘','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'坐垫','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'桌布','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'枕头','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'桌旗','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'靠垫','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'地毯','name_e'=>''],

              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'卫生间','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'浴帘','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'浴巾','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'衣架','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'洗漱套瓶','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'杯子','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'马桶垫','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'防滑垫','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'毛巾架','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'毛巾环','name_e'=>''],

              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'花艺植物','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'多肉植物','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'花瓶','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'花盆','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'仿真花','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'鲜花','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'干花','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'水景','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'野兽派','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'RoseOnly','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'厨房用品','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'餐具','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'盘子','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'杯子','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'勺子','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'刀叉','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'碟子','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'碗架','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'红星美凯龙','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'左右','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'奥卓','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'双叶','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'多喜爱','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'法郎仕','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'柏逸轩','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'大公馆','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'欧意诺','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'欧亚森','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'罗曼迪卡','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'奥克维尔','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'优胜美地','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'fc','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'laz boy','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'m&d','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'吉盛伟邦','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'高点','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'奢世','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'迪信','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'康宝','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'澳瑞','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'百强','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'瑞加设计','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'百合臻品','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'天元尚品','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'皇家爱菲','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'法米尚居','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'富兰帝斯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'Bedont','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'Reflex','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'Sedital','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'艺展中心','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'邸色','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'简末','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'米兰诺','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'物本造','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'一念间','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'明艺韵','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'醒艺廊','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'上坐','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'法诺','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'哒哒饰','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'U+家具','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'罗瓦莎','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'米立方','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'泠空间','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'可立特','name_e'=>''],
              ]
            ],
            [
              'id'=>1,'level'=>1,'name'=>'广州国际家具博览会','name_e'=>'',
              'children'=>[
                ['id'=>1,'level'=>2,'name'=>'扬狮','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'御品','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'摩卡','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'非凡','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'非同','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'纳希','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'雅时','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'舒派','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'逸居','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'欧蒂诺','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'克里斯','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'卡迪娅','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'area','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'armoni','name_e'=>''],
                ['id'=>1,'level'=>2,'name'=>'leta','name_e'=>''],
              ]
            ],
         ];
         // $list = CategoryService::getInstance()->getCategoryTree($pid = 0, $level = 1,$kind);

         return response()->forApi($data , 200);
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