<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/10/29
 * Time: 下午2:46
 */
namespace App\Http\Controllers\Api;

use App\Lib\LibUtil;
use App\Models\Folder;
use App\Models\GoodAction;
use App\Services\FolderService;
use App\Services\FollowService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

/**
 * @SWG\Resource(
 *  resourcePath="/good/action",
 *  description="商品操作",
 * )
 */

class GoodActionController extends BaseController
{
    private static $user_id;

    public function __construct()
    {

    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/good/action/users",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="点赞／同情 列表",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="good_id",
     *           description="商品ID",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="action",
     *           description="1 点赞 2 喝倒彩",
     *           paramType="query",
     *           required=true,
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
    public function getUsers()
    {
        $params = Input::all();
        $rules = array(
            'good_id' => 'required|exists:goods,id',
            'action' => 'required|in:1,2',

        );
        //请求参数验证
        parent::validator($params, $rules);
        $num = Input::get('num');
        $num = $num ? $num : 10;
        $outData = ProductService::getInstance()->getActionUsers($params['good_id'],$params['action'],$num);
        return response()->forApi($outData);
    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/good/action/create",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="商品操作",
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
     *           name="action",
     *           description="操作: 1 点赞 2 喝倒彩",
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

    public function postCreate()
    {

        $params = Input::all();
        $rules = array(
            'good_id' => 'required|exists:goods,id',
            'action' => 'required|in:1,2',

        );
        //请求参数验证
        parent::validator($params, $rules);
        $access_token =$params['access_token'];
        $rs = parent::validateAcessToken($access_token);
        self::$user_id = $rs['user_id'];
        $user_id = self::$user_id;
        $row = GoodAction::where(['user_id'=>$user_id,'good_id'=>$params['good_id'],'action'=>$params['action']])->first();
        if (!empty($row)) {
            return response()->forApi(array(), 1001, '你已赞过该商品');
        }
        $rs = ProductService::getInstance()->addAction ($user_id,$params['good_id'],$params['action']);
        if ($rs) {
            return response()->forApi(['status' => 1], 200, '操作成功');
        } else {
            return response()->forApi(array(), 1001, '操作失败');
        }
    }


    /**
     *
     *
     * @SWG\Api(
     *   path="/good/action/del",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="删除文件夹商品",
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
     *         ),
     *         @SWG\Parameter(
     *           name="folder_id",
     *           description="文件夹ID",
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
    public function anyDel () {
        $data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'good_id' => 'required',
            'folder_id' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);
        self::$user_id = $rs['user_id'];
        $folder = Folder::find($data['folder_id']);
        if (empty($folder) || self::$user_id != $folder->user_id) {
            return response()->forApi(array(), 1001, '文件夹不存在或无权限操作');
        }
        ProductService::getInstance()->delFolderProduct($data['good_id'],$data['folder_id']);
        return response()->forApi(['status'=>1]);

    }

}