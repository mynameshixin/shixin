<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/19
 * Time: 下午1:47
 */

namespace App\Http\Controllers\Api;

use App\Lib\LibUtil;
use App\Models\Folder;
use App\Models\FolderGood;
use App\Models\GoodAction;
use App\Models\Product;
use App\Services\TaoBaoService;
use App\Services\FancyService;
use Illuminate\Support\Facades\Input;
use App\Services\ProductService;
use App\Models\Shop;

/**
 *
 * @SWG\Resource(
 *   apiVersion="2.0.0",
 *   swaggerVersion="1.2",
 *   resourcePath="/goods",
 *   description="商品",
 *   @SWG\Produces("application/json")
 * )
 */

class ProductController extends BaseController
{
    private static $user_id;

    public function __construct()
    {

    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/goods",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="商品列表",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *          @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *          @SWG\Parameter(
     *           name="keyword",
     *           description="名称模糊查询",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="category_id",
     *           description="分类Id",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="folder_id",
     *           description="文件夹Id",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="password",
     *           description="隐私文件夹秘密",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="kind",
     *           description="类型：1 => 采集商品, 2 => 灵感图",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="user_id",
     *           description="用户Id",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="page",
     *           description="页数",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *        @SWG\Parameter(
     *           name="num",
     *           description="条数",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *         @SWG\Parameter(
     *           name="sort",
     *           description="排序：0 后台设置排序 1 收藏数  2 喜欢数 默认为 0",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function index()
    {
        $data = Input::all();

        $rules = array(
            'kind' => 'in:1,2',
            'category_id' => 'exists:categories,id',
            'folder_id' => 'exists:folders,id',
            'user_id' => 'exists:users,id',
        );
        $self_id = $uid = 0;
        $uid = isset($data['user_id'])?$data['user_id']:0;
        //请求参数验证
        parent::validator($data, $rules);
        if (isset($data['folder_id']) && $data['folder_id']) {
            $folder = Folder::find($data['folder_id'])->toArray();
            if($folder){
                $uid = $folder['user_id'];
                $self_id = $folder['user_id'];
            }
            $data['password'] = isset($data['password']) ? $data['password'] : '';
            if ($folder['private']>0 && trim($folder['password'])!=trim($data['password'])) {
                $access_token = Input::get('access_token');
                $rs = parent::validateAcessToken($access_token);
                if ($rs['user_id'] !=$folder['user_id']){
                    return response()->forApi(array(), 1001, '无权限查看该文件夹');
                }
            }
        }
        
        if (isset($data['access_token']) && $data['access_token']) {
            $rs = parent::getToken($data['access_token']);
            $self_id = isset($rs['user_id']) ? $rs['user_id'] : 0;
        }

        $num = isset($data['num']) ? $data['num'] : 20;
        $data['sort'] = isset($data['sort']) ? $data['sort'] : 0;
        //先搜索folders 查询到结果后返回id

        $rs = ProductService::getInstance()->getProductList ($data,$num,$self_id,$uid);
        return response()->forApi($rs);
    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/goods/{id}",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="获取商品详情",
     *       notes="Returns special list",
     *         @SWG\Parameter(
     *           name="id",
     *           description="商品ID",
     *           paramType="path",
     *           required=false,
     *           type="string"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function show ($id) {
        $good = ProductService::getInstance()->getProductDetail ($id);
        if (!empty($good)) {
            return response()->forApi(['good'=>$good]);
        }else{
            return response()->forApi(array(), 1001, '宝贝不存在或者已删除');
        }

    }


    /**
     * @SWG\Api(
     *   path="/goods/{id}",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="PUT",
     *       summary="修改商品信息",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="id",
     *           description="商品ID",
     *           paramType="path",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="title",
     *           description="标题",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="folder_id",
     *           description="文件夹",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="description",
     *           description="描述",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function update($id)
    {
        $data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'id'=> 'required|exists:goods,id',
            'category_id' => 'exists:categories,id',
            'folder_id' => 'exists:folders,id',
            'title' => 'min:4',
            'description' => 'min:4',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userData = parent::validateAcessToken($data['access_token']);
        $good = Product::find($id);
        $userId = $userData['user_id'];
        if ($userId != $good->user_id) {
            return response()->forApi(array(), 1001, '无权限修商品信息');
        }

        $rs = ProductService::getInstance()->updateProduct($id, $data);
        return response()->forApi(['status' => 1]);
    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/good/recommend",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="获取推荐商品列表",
     *       notes="Returns special list",
     *         @SWG\Parameter(
     *           name="kind",
     *           description="类型：1 => 采集商品, 2 => 灵感图",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="sort",
     *           description="排序：0 后台设置排序 1 收藏数  2 喜欢数 默认为 0",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *         @SWG\Parameter(
     *           name="page",
     *           description="页数",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *        @SWG\Parameter(
     *           name="num",
     *           description="条数",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function getRecommend () {
        $data = Input::all();

        $rules = array(
            'kind' => 'in:1,2',
        );
        //请求参数验证
        parent::validator($data, $rules);

        $num = isset($data['num']) ? $data['num'] : 10;
        $data['is_recommend'] = 1;
        $data['sort'] = isset($data['sort']) ? $data['sort'] : 0;
        $self_id = 0;
        if (isset($data['access_token']) && $data['access_token']) {
            $rs = parent::getToken($data['access_token']);
            $self_id = isset($rs['user_id']) ? $rs['user_id'] : 0;
        }
        $rs = ProductService::getInstance()->getProductList ($data,$num,$self_id);
        return response()->forApi($rs);

    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/good/relations",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="喜欢它的人也喜欢商品列表",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="good_id",
     *           description="商品",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="kind",
     *           description="类型：1 => 采集商品, 2 => 灵感图",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="page",
     *           description="页数",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="num",
     *           description="条数",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */

    public function getRelations () {
        $data = Input::all();

        $rules = array(
            'good_id' => 'required|exists:goods,id',
            'kind' =>'in:1,2'
        );
        //请求参数验证
        parent::validator($data, $rules);
        //$kind = isset($data['kind']) ? $data['kind'] : 0;
        //$rs = ProductService::getInstance()->getRelationProducts ($data['good_id'],$num=10,$kind);
        $good = Product::find($data['good_id']);
        $num = isset($data['num']) ? $data['num'] : 20;
        $data['folder_ids'] = FolderGood::where('good_id',$good['folder_id'])->lists('folder_id')->toArray();

        $self_id = 0;
        if (isset($data['access_token']) && $data['access_token']) {
            $rs = parent::getToken($data['access_token']);
            $self_id = isset($rs['user_id']) ? $rs['user_id'] : 0;
        }
        $rs = ProductService::getInstance()->getProductList ($data,$num,$self_id);
        return response()->forApi($rs);
    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/good/praise",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="获取用户喜欢商品列表",
     *       notes="Returns special list",
     *         @SWG\Parameter(
     *           name="access_token",
     *           description="用户登录access_token",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="user_id",
     *           description="用户id",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="kind",
     *           description="类型：1 => 采集商品, 2 => 灵感图",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="page",
     *           description="页数",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *        @SWG\Parameter(
     *           name="num",
     *           description="条数",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function getPraise () {
        $data = Input::all();
        $rules = array(
            'kind' => 'in:1,2',
            //'access_token' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $access_token = Input::get('access_token');
        if (!empty($access_token)){
            $rs = parent::getToken($access_token);
            self::$user_id = isset($rs['user_id']) ? $rs['user_id'] : 0;
        }

        $userId = isset($data['user_id']) ? $data['user_id'] : self::$user_id;
        $num = isset($data['num']) ? $data['num'] : 10;
        $rs = ProductService::getInstance()->getPraiseProductList ($userId,$data,$num);
        return response()->forApi($rs);

    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/goods",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="发布商品",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="access_token",
     *           description="登录的AccessToken",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="kind",
     *           description="类型：1 => 采集商品, 2 => 灵感图",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="category_id",
     *           description="分类Id",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="title",
     *           description="标题",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="folder_id",
     *           description="文件夹Id",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="tags",
     *           description="标签： 多标签 ; 分割",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="description",
     *           description="描述",
     *           paramType="form",
     *           required=false,
     *           type="text"
     *         ),
     *         @SWG\Parameter(
     *           name="price",
     *           description="线下价格",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *      @SWG\Parameter(
     *           name="reserve_price",
     *           description="优惠价格",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *      @SWG\Parameter(
     *           name="detail_url",
     *           description="商品跳转地址",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *      @SWG\Parameter(
     *           name="source",
     *           description="来源：0 自己上传 1 淘宝采集",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="image[]",
     *           description="照片",
     *           paramType="form",
     *           required=true,
     *           type="file"
     *         ),
     *         @SWG\Parameter(
     *           name="image[]",
     *           description="照片",
     *           paramType="form",
     *           required=false,
     *           type="file"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function store()
    {
        $data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'kind' => 'required|in:1,2',
           // 'folder_id' => 'required',
            'category_id' => 'exists:categories,id',
            'image' => 'required',
            'source' => 'in:0,1',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);
        self::$user_id = $rs['user_id'];
        $userId = self::$user_id;
//        if($data['kind']==2){
//            $data['status'] = 1;
//        }
        $rulesImage = $file = array();
        if (is_array($data['image']) && !empty($data['image'])) {
            foreach ($data['image'] as $k => $v) {
                $rulesImage[$k] = 'image';
            }
            parent::validator($data['image'], $rulesImage);
        }
        if (isset($data['folder_id'])) {
            $row = Folder::find($data['folder_id']);
            if (empty($row) || $userId !=$row->user_id){
                return response()->forApi(array(), 1001, '请选择正确文件夹！');
            }
        }
        //用户发布，先发后审
        $data['status'] = 1;
        $id = ProductService::getInstance()->addProduct ($userId,$data,$_FILES);
        if ($id) {
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '发布失败！');
        }
    }

    //上传 vr
    public function postVr(){
        $data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'kind' => 'required|in:1,2',
            'title'=>'required',
            'detail_url'=>'required',
            'typeid'=>'required',
            'cityid'=>'required',
            'folder_id' => 'required',
            'image' => 'required',
        );
        $pa = [
            'access_token.required'=>'没有传入令牌',
            'cityid.required'=>'没有选择省市县',
            'kind.required'=>'没有传入图片类型',
            'title.required'=>'没有传入标题',
            'detail_url.required'=>'没有传入地址',
            'typeid.required'=>'没有传入类型',
            'folder_id.required'=>'没有传入文件夹',
            'image.required'=>'没有传入图片'
        ];
        //请求参数验证
        parent::validator($data, $rules,$pa);
        $rs = parent::validateAcessToken($data['access_token']);
        self::$user_id = $rs['user_id'];
        $userId = self::$user_id;

        $rulesImage = $file = array();
        if (is_array($data['image']) && !empty($data['image'])) {
            foreach ($data['image'] as $k => $v) {
                $rulesImage[$k] = 'image';
            }
            parent::validator($data['image'], $rulesImage);
        }
        if (isset($data['folder_id'])) {
            $row = Folder::find($data['folder_id']);
            if (empty($row) || $userId !=$row->user_id){
                return response()->forApi(array(), 1001, '请选择正确文件夹！');
            }
        }
        //用户发布，先发后审
        $data['status'] = 1;
        $data['description'] = $data['title'];
        $id = ProductService::getInstance()->addProduct ($userId,$data,$_FILES);
        if ($id) {
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '发布失败！');
        }
    }



    /**
     *
     *
     * @SWG\Api(
     *   path="/good/item",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="获取淘宝商品详情",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *          @SWG\Parameter(
     *           name="url",
     *           description="商品地址",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="num_iids",
     *           description="淘宝客商品数字id串",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function anyItem () {
        $data = Input::all();
        $rules = array(
            'url' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $url = $data['url'];

        $fancy = ['m.fancy.com'];

        $host = parse_url($url);
        if(!empty($host['host']) && in_array($host['host'],$fancy)){
            $res = FancyService::getInstance()->getItemDetail($url);
            if($res){
                return response()->forApi(['x_item'=>$res], 200);
            }
            return response()->forApi(array(), 1001, ' 商品信息采集失败！');
        }

        $params = LibUtil::getKeyValue($url);
        $id = isset($params['id']) ? $params['id'] : 0;
        $outdata = TaoBaoService::getInstance()->getItemDetail ($id);

        //$str = '{"product_get_response":{"product":{"binds":"21433:492838444;122216423:21959;29649:106945069;29659:525908246;29655:494072139;29656:78275;29658:106945069;3372090:78128","binds_str":"尺寸:17英寸及以下;是否宽屏:否;垂直可视角度:140°;黑白响应时间:16毫秒;平均亮度:260cd\/m^2;分辨率:1280x1024;水平可视角度:140°;标称对比度:450#cln#1;","cat_name":"显示器","cid":110502,"created":"2007-07-12 11:54:26","desc":"","modified":"2014-02-24 00:23:13","name":"冠捷D371","pic_url":"https:\/\/img.alicdn.com\/bao\/uploaded\/i4\/T1GJ0qXlFgXXajW7Db_094656.jpg","price":"0.00","product_id":10,"props":"20000:78296","props_str":"品牌:AOC","sale_props":""}}}';
        //$outdata = json_decode($str,true);
        if (isset($outdata) && !empty($outdata)) {
            return response()->forApi($outdata);
        }else{
            return response()->forApi(array(), 1001, ' 商品信息采集失败！');
        }


    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/good/del",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="删除自己发布的商品",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *          @SWG\Parameter(
     *           name="access_token",
     *           description="用户登陆ACCESS_TOKEN",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *          @SWG\Parameter(
     *           name="good_id",
     *           description="商品Id",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function anyDel () {
        $data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'good_id' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);
        self::$user_id = $rs['user_id'];
        $good = Product::find($data['good_id']);
        if (empty($folder) || self::$user_id != $good->user_id || $good->collection_count > 0 ) {
            return response()->forApi(array(), 1001, '无权限删除改商品');
        }
        ProductService::getInstance()->delProduct($data['good_id']);
        return response()->forApi(['status'=>1]);

    }


    public function anyItem2 () {
        $data = Input::all();
        $rules = array(
            'url' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $url = $data['url'];
        $params = LibUtil::getKeyValue($url);
        $id = isset($params['id']) ? $params['id'] : 0;
        $open_iid = isset($params['open_iid']) ? $params['open_iid'] : 0;
        $outdata = TaoBaoService::getInstance()->getDetail ($id,$open_iid);

        //$str = '{"product_get_response":{"product":{"binds":"21433:492838444;122216423:21959;29649:106945069;29659:525908246;29655:494072139;29656:78275;29658:106945069;3372090:78128","binds_str":"尺寸:17英寸及以下;是否宽屏:否;垂直可视角度:140°;黑白响应时间:16毫秒;平均亮度:260cd\/m^2;分辨率:1280x1024;水平可视角度:140°;标称对比度:450#cln#1;","cat_name":"显示器","cid":110502,"created":"2007-07-12 11:54:26","desc":"","modified":"2014-02-24 00:23:13","name":"冠捷D371","pic_url":"https:\/\/img.alicdn.com\/bao\/uploaded\/i4\/T1GJ0qXlFgXXajW7Db_094656.jpg","price":"0.00","product_id":10,"props":"20000:78296","props_str":"品牌:AOC","sale_props":""}}}';
        //$outdata = json_decode($str,true);
        if (isset($outdata) && !empty($outdata)) {
            return response()->forApi($outdata);
        }else{
            return response()->forApi(array(), 1001, ' 商品信息采集失败！');
        }


    }



}