<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/10/29
 * Time: 下午2:46
 */
namespace App\Http\Controllers\Api;


use App\Services\CollectionService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

/**
 * @SWG\Resource(
 *  resourcePath="/collection/folders",
 *  description="关注文件夹",
 * )
 */

class CollectionFolderController extends BaseController
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
     *   path="/collection/folders",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="关注文件夹列表",
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
        $data = Input::all();
        $num = isset($data['num']) ? $data['num'] : 10;
        $user_id = isset($data['user_id']) ? $data['user_id'] : self::$user_id;
        $outData = CollectionService::getInstance()->getCollectionFolders($user_id,$num,self::$user_id);
        return response()->forApi($outData);
    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/collection/folders",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="关注文件夹",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="folder_id",
     *           description="豆列目录ID",
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
            'folder_id' => 'required|exists:folders,id',

        );
        //请求参数验证
        parent::validator($params, $rules);
        $user_id = self::$user_id;
        $action = isset($params['action']) ? $params['action'] : 1;
        if  ($action==2) {
            $rs = CollectionService::getInstance()->delFolderCollection ($user_id,$params['folder_id']);
        }else{
            $folder_id = isset($params['folder_id']) ? $params['folder_id'] : 0;
            $rs = CollectionService::getInstance()->addFolderCollection ($user_id,$folder_id);

        }

        if ($rs) {
            return response()->forApi(['status' => 1], 200, '操作成功');
        } else {
            return response()->forApi(array(), 1001, '操作失败');
        }
    }

}