<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/10/29
 * Time: 下午2:46
 */
namespace App\Http\Controllers\Api;

use App\Lib\LibUtil;
use App\Services\CollectionService;
use App\Models\CollectionGood;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

/**
 * @SWG\Resource(
 *  resourcePath="/collections",
 *  description="商品收藏",
 * )
 */

class CollectionController extends BaseController
{
    private static $user_id;

    public function __construct()
    {

    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/collections",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="收藏列表",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="user_id",
     *           description="用户id",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="folder_id",
     *           description="豆列目录ID",
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
    public function index()
    {   $params = Input::all();
        $num = isset($params['num']) ? $params['num'] : 10;
        if (isset($data['access_token']) && !empty($data['access_token'])){
            $rs = parent::getToken($data['access_token']);
            self::$user_id = isset($rs['user_id']) ? $rs['user_id'] : 0;
        }
        $params['user_id'] = isset($params['user_id']) ? $params['user_id'] : self::$user_id;
        $outData = CollectionService::getInstance()->getCollections($params,$num);
        return response()->forApi($outData);
    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/collections",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="收藏商品",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="good_id",
     *           description="商品ID",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="folder_id",
     *           description="豆列目录ID",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="action",
     *           description="操作: 1 添加 2 取消",
     *           paramType="form",
     *           required=true,
     *           type="string"
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

        $params = Input::all();
        $rules = array(
            'good_id' => 'required|exists:goods,id',
            'folder_id' => 'exists:folders,id',

        );
        //请求参数验证
        parent::validator($params, $rules);
        $rs = parent::validateAcessToken($params['access_token']);
        $user_id = self::$user_id = $rs['user_id'];
        $action = isset($params['action']) ? $params['action'] : 1;
        if  ($action==2) {
            $folder_id = isset($params['folder_id']) ? $params['folder_id'] : 0;
            $rs = CollectionService::getInstance()->delCollection ($user_id,$params['good_id'],$folder_id);
        }else{
            $folder_id = isset($params['folder_id']) ? $params['folder_id'] : 0;
            $row = CollectionGood::where(['user_id'=>$user_id,'good_id'=>$params['good_id'],'folder_id'=>$folder_id])->first();
            if (!empty($row)) {
                return response()->forApi(array(), 1001, '你已采集过该商品');
            }
            $rs = CollectionService::getInstance()->addCollection ($user_id,$params['good_id'],$folder_id);

        }

        if ($rs) {
            return response()->forApi(['status' => 1], 200, '操作成功');
        } else {
            return response()->forApi(array(), 1001, '操作失败');
        }
    }


}