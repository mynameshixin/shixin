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
use App\Services\FolderService;
use App\Services\FollowService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

/**
 * @SWG\Resource(
 *  resourcePath="/follows",
 *  description="关注",
 * )
 */

class FollowController extends BaseController
{
    private static $user_id;

    public function __construct()
    {
        $access_token = Input::get('access_token');
        $rs = parent::validateAcessToken($access_token);
        self::$user_id = $rs['user_id'];
    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/follows",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="关注／粉丝 列表",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
     *           paramType="query",
     *           required=true,
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
     *           name="kind",
     *           description="分类：1 粉丝 2 关注的人",
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
    {
        $num = Input::get('num');
        $num = $num ? $num : 10;
        $kind = Input::get('kind');
        $user_id = Input::get('user_id');
        $user_id = $user_id ? $user_id : self::$user_id;
        if ($kind==2) {
            $outData = FollowService::getInstance()->getFollows($user_id,$num,self::$user_id);
        }else{
            $outData = FollowService::getInstance()->getFans($user_id,$num,self::$user_id);
        }
        return response()->forApi($outData);
    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/follows",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="添加／取消 关注",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="user_id",
     *           description="用户ID",
     *           paramType="form",
     *           required=true,
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
            'access_token' => 'required',
            'user_id' => 'required|exists:users,id',
        );
        //请求参数验证
        parent::validator($params, $rules);
        $user_id = self::$user_id;
        $action = isset($params['action']) ? $params['action'] : 1;
        if  ($action==2) {
            $rs = FollowService::getInstance()->delFollow ($user_id,$params['user_id']);
        }else{
            $rs = FollowService::getInstance()->addFollow ($user_id,$params['user_id']);
        }

        if ($rs) {
            return response()->forApi(['status' => 1], 200, '操作成功');
        } else {
            return response()->forApi(array(), 1001, '操作失败');
        }
    }

}