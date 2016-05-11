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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

/**
 * @SWG\Resource(
 *  resourcePath="/folders",
 *  description="豆列",
 * )
 */

class FolderController extends BaseController
{
    private static $user_id = 0 ;

    public function __construct()
    {
        $data = Input::all();
        $access_token = isset($data['access_token']) ? $data['access_token'] : '';
        if (!empty($access_token)) {
            $rs = parent::validateAcessToken($access_token);
            self::$user_id = $rs['user_id'];
        }

    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/folders",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="豆列列表",
     *       notes="豆列列表：GET ",
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
     *           description="用户ID",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="keyword",
     *           description="关键字",
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
        $params = Input::all();
        $num = isset($params['num']) ? $params['num'] : 10;
        if (isset($data['user_id']) && $data['user_id']!=self::$user_id) {
            $params['private'] = 0;
        }
        $params['current_uid'] = self::$user_id;
        $params['user_id'] = self::$user_id;


        $outData = FolderService::getInstance()->getFolders($params,$num);
        return response()->forApi($outData);
    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/folders/{folder_id}",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="文件夹详情",
     *       notes="豆列列表：GET ",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="folder_id",
     *           description="文件ID",
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
    public function show($id)
    {
        $outData = FolderService::getInstance()->getFoldersByIds ([$id]);
        $list = isset($outData[$id]) ? $outData[$id] : [];
        return response()->forApi(['folder'=>$list]);
    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/folders",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="创建豆列",
     *       notes="创建豆列：POST ",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="name",
     *           description="名称",
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
     *        @SWG\Parameter(
     *           name="private",
     *           description="设置为隐私： 0 公开  1 隐私(自己可见) 2 秘密访问",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="password",
     *           description="秘密",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="image[]",
     *           description="照片",
     *           paramType="form",
     *           required=false,
     *           type="file"
     *         ),
     *
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
        $params = fparam($params);
        $rules = array(
            'access_token'=>'required',
            'name' => 'required',
            'private'=>'in:0,1,2',
            'password'=>'min:3'
        );
        //请求参数验证
        parent::validator($params, $rules);
        $user_id = self::$user_id;
        $private = isset($params['private']) ? $params['private'] : 0;
        if ($private >0) {
            $num = Folder::where('user_id',self::$user_id)->where('private','>',0)->count();
            if ($num>=2) {
                return response()->forApi(array(), 1001, '最多只能创建2个隐私文件夹');
            }
            $params['password'] = isset($params['password']) ? $params['password'] : '';
            if ($private==2 && !isset($params['password'])) {
                return response()->forApi(array(), 1001, '秘密不能为空');
            }

        }
        $row = Folder::where(['user_id'=>self::$user_id,'name'=>$params['name']])->first();
        if (!empty($row)) {
            return response()->forApi(array(), 1001, '该名称文件夹已存在！');
        }
        $id = FolderService::getInstance()->create($user_id, $params,$_FILES);
        if ($id) {
            return response()->forApi(['id' => $id], 200, '创建成功');
        } else {
            return response()->forApi(array(), 1001, '创建失败');
        }
    }


    /**
     * @SWG\Api(
     *   path="/folders/{folder_id}",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="PUT",
     *       summary="修改文件夹",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="folder_id",
     *           description="文件夹id",
     *           paramType="path",
     *           required=true,
     *           type="integer"
     *         ),
     *         @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         ),
     *      @SWG\Parameter(
     *           name="name",
     *           description="名称",
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
    public function update($id)
    {
        $data = Input::all();
        $rules = array(
            'access_token' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $folder = Folder::find($id);
        if (empty($folder) || self::$user_id != $folder->user_id) {
            return response()->forApi(array(), 1001, '文件夹不存在或无权限修改');
        }
        FolderService::getInstance()->update ($id,$data);
        return response()->forApi(['status' => 1]);
    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/folder/avatar",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="修改文件夹封面",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="folder_id",
     *           description="文件夹id",
     *           paramType="form",
     *           required=true,
     *           type="integer"
     *         ),
     *        @SWG\Parameter(
     *           name="image_id",
     *           description="图片id",
     *           paramType="form",
     *           required=false,
     *           type="integer"
     *         ),
     *        @SWG\Parameter(
     *           name="image",
     *           description="图片",
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
    public function postAvatar()
    {

        $data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'folder_id' => 'required',
            'image' => 'image',
            'image_id' => 'exists:images,id'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $vendorData = parent::validateAcessToken($data['access_token']);
        $userId = $vendorData['user_id'];
        $folder = Folder::find($data['folder_id']);
        if (empty($folder) || $userId != $folder->user_id) {
            return response()->forApi(array(), 1001, '文件夹不存在或无权限修改');
        }
        $file = [];
        if (isset($_FILES['image']) && !empty($_FILES['image'])){
            $file = array('image' => Input::file('image'));
            // setting up rules
            $rules = array('image' => 'mimes:jpeg,png',); //mimes:jpeg,bmp,png and for max size max:10000

            // doing the validation, passing post data, rules and the messages
            parent::validator($file, $rules);
            $file = $_FILES['image'];
        }

        $image_id = isset($data['image_id']) ? $data['image_id'] : 0;
        $images = FolderService::getInstance()->uploadAvatar($data['folder_id'], $file,$image_id);
        if (!empty($images)) {
            return response()->forApi(['status'=>1]);
        } else {
            // sending back with error message.
            return response()->forApi(array(), 1001, 'uploaded file is not valid');
        }
    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/folder/recommend",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="获取推荐文件夹列表",
     *       notes="Returns special list",
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
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
        $data['sort'] = 1;
        $data['private'] = 0;
        $params['current_uid'] = self::$user_id;
        $outData = FolderService::getInstance()->getFolders($data,$num);
        if (!empty($outData['list'])) {
            foreach($outData['list'] as &$v){
                $images = FolderService::getInstance()->getFolderImages ($v['id']);
                $v['images'] = $images;
            }
        }
        return response()->forApi($outData);

    }

    /**
     *
     * @SWG\Api(
     *   path="/folders/{id}",
     *   @SWG\Operations(
     *    @SWG\Operation(
     *       method="DELETE",
     *       summary="删除自己的文件夹",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="id",
     *           description="文件夹ID",
     *            paramType="path",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="query",
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
    public function destroy($id)
    {
        $data = Input::all();
        $data['id'] = $id;
        $rules = array (
            'id' =>'required',
            'access_token'=>'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $access_token = $data['access_token'];
        $rs = parent::validateAcessToken($access_token);
        $userId = $rs['user_id'];
        $folder  = Folder::find($id);
        if (empty($folder) || $userId != $folder->user_id) {
            return response()->forApi(array(), 1001, '文件夹不存在或无权限操作');
        }
        $rs = FolderService::getInstance()->delFolder($id);
        return response()->forApi(array('status'=>$rs ? 1 : 0));
    }

}