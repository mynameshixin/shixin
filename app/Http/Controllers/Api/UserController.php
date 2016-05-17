<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/9/11
 * Time: 上午11:50
 */
namespace App\Http\Controllers\Api;

use App\Lib\LibUtil;
use App\Models\CollectionFolder;
use App\Models\Folder;
use App\Models\GoodAction;
use App\Models\Product;
use App\Models\User;
use App\Lib\Transformer\UserTransformer;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Psy\Readline\Libedit;

/**
 * @SWG\Resource(
 *  resourcePath="/users",
 *  description="用户",
 * )
 */
class UserController extends BaseController
{
    private static $user_id = 0 ;

    public function __construct()
    {
        $access_token = Input::get('access_token');
        if (!empty($access_token)) {
            $rs = parent::validateAcessToken($access_token);
            self::$user_id = $rs['user_id'];
        }

    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/users",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="用户列表",
     *       notes="Returns special list",
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="keyword",
     *           description="关键字",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="page",
     *           description="页数",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
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
    public function index(){   
        $params = Input::all();
        $params = fparam($params);
        $keyword = Input::get('keyword');
        $keyword = fparam($keyword);
        $num  = Input::get('num',20);
        $params['current_uid'] = self::$user_id;
//        if (!empty($keyword)) {
//            $users = User::where('username', "like" , "%{$keyword}%")->where('nick', "like" , "%{$keyword}%")->paginate($num);
//        }else{
//            $users = User::paginate($num);
//        }
//
//
//        return $this->paginator($users, new UserTransformer()); //按照格式输出
        $outData = UserService::getInstance()->getUserList($params,$num);
        return response()->forApi($outData);
    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/users/{user_id}",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="获取用户详情",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="user_id",
     *           description="用户id",
     *           paramType="path",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
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
    public function show($id)
    {
        $data = Input::all();
        $userId = 0;
        if (isset($data['access_token']) && $data['access_token']) {
            $vendorData = parent::validateAcessToken($data['access_token']);
            $userId = $vendorData['user_id'];
        }

        $id = is_numeric($id) && $id>0 ? $id : $userId;
        $user = User::find($id);
        if (!empty($user)) {
            unset($user['password']);
            unset($user['is_seller']);
            unset($user['is_manager']);
            $user['pic_o'] = LibUtil::getUserAvatar($id, 3) ;
            if (!empty($user['pic_o'])) {
                $user['pic_b'] = LibUtil::getUserAvatar($id, 2) ;
                $user['pic_m'] = LibUtil::getUserAvatar($id, 1);
            }

            if (empty($user['pic_o']) && !empty($user['auth_avatar'])) {
                $user['pic_o'] = $user['pic_b'] = $user['pic_m'] = $user['auth_avatar'];
            }
                $user = [
                    'id' => $user['id'],
                    'nick' => $user['nick'],
                    'username' => $user['username'],
                    'signature' => $user['signature'],
                    'wechat'=>$user['wechat'],
                    'mobile'=>$user['mobile'],
                    'location'=>$user['location'],
                    'location_x'=>$user['location_x'],
                    'location_y'=>$user['location_y'],
                    'status' => $user['status'],
                    'pic_b' => isset($user['pic_b']) ? $user['pic_b'] : '',
                    'pic_o' => $user['pic_o'],
                    'pic_m' => isset($user['pic_m']) ? $user['pic_m'] : '',
                    'follow_num'=> UserService::getInstance()->getFollowNum($user['id']),
                    'fan_num'=> UserService::getInstance()->getFanNum($user['id']),
                    'is_follow' => 0
                ];
            if ($id!=$userId) {
                $user['is_follow'] = UserService::getInstance()->isFollow($userId,$user['id']);
                $user['folder_num'] = Folder::where(['user_id'=>$id,'private'=>0])->count();
            }else{
                $user['folder_num'] = Folder::where('user_id',$id)->count();

            }

                $folder_ids = CollectionFolder::where('user_id',$id)->lists('folder_id')->toArray();
                $folder_ids = array_unique($folder_ids);
                $user['collection_folder_num'] = count($folder_ids);
                $user['good_num'] = Product::where('user_id',$id)->count();
                $user['praise_num'] = GoodAction::where(['user_id'=>$id,'action'=>1])->count();


            return response()->forApi($user, 200);
        } else {
            return response()->forApi(array(), 1001, 'user  is not exit');
        }

    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/user/avatar",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="上传用户头像",
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
     *           name="image",
     *           description="图片",
     *           paramType="form",
     *           required=true,
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
            'image' => 'required|image'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $vendorData = parent::validateAcessToken($data['access_token']);
        $userId = $vendorData['user_id'];

        $file = array('image' => Input::file('image'));
        // setting up rules
        $rules = array('image' => 'required|mimes:jpeg,png',); //mimes:jpeg,bmp,png and for max size max:10000

        // doing the validation, passing post data, rules and the messages
        parent::validator($file, $rules);
        $images = UserService::getInstance()->uploadAvatar($userId, $_FILES['image']);
        if (!empty($images)) {
            return response()->forApi($images);
        } else {
            // sending back with error message.
            return response()->forApi(array(), 1001, 'uploaded file is not valid');
        }
    }

    /**
     * @SWG\Api(
     *   path="/users/{user_id}",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="PUT",
     *       summary="修改用户信息",
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
     *           name="user_id",
     *           description="用户id",
     *           paramType="path",
     *           required=true,
     *           type="integer"
     *         ),
     *      @SWG\Parameter(
     *           name="wechat",
     *           description="微信号",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *      @SWG\Parameter(
     *           name="qq",
     *           description="QQ号",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="username",
     *           description="用户名",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="nick",
     *           description="昵称",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="signature",
     *           description="签名",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *     @SWG\Parameter(
     *           name="email",
     *           description="邮箱",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *     @SWG\Parameter(
     *           name="gender",
     *           description=" 性别： 1 男 0 女",
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
            'wechat'=> 'unique:users',
            'qq'=> 'unique:users',
            //'mobile' => 'unique:users',
            'email' => 'email|unique:users',
            'username' => 'min:4|unique:users',
            'gender' => 'in:0,1',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userData = parent::validateAcessToken($data['access_token']);
        if (isset($data['mobile']) && $data['mobile']) {
            parent::validateMobile($data['mobile']);
        }
        $userId = $userData['user_id'];
        if ($userId != $id) {
            return response()->forApi(array(), 1001, '无权限修改用户信息');
        }

        $entry = array();
        if (isset($data['qq'])) $entry['qq'] = $data['qq'];
        if (isset($data['wechat'])) $entry['wechat'] = $data['wechat'];
        //if (isset($data['mobile'])) $entry['mobile'] = $data['mobile'];
        if (isset($data['username'])) $entry['username'] = $data['username'];
        if (isset($data['email'])) $entry['email'] = $data['email'];
        if (isset($data['gender'])) $entry['gender'] = $data['gender'];
        if (isset($data['nick'])) $entry['nick'] = $data['nick'];
        if (isset($data['signature'])) $entry['signature'] = $data['signature'];

        if (!empty($entry)) {
            User::where('id', '=', $userId)->update($entry);
        }
        return response()->forApi(['status' => 1]);
    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/user/goods",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="我发布的商品／灵感图列表",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *          @SWG\Parameter(
     *           name="access_token",
     *           description="登录access_token",
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
    public function getGoods()
    {
        $data = Input::all();

        $rules = array(
            'kind' => 'in:1,2',
            'category_id' => 'exists:categories,id',
        );
        //请求参数验证
        parent::validator($data, $rules);
        //$vendorData = parent::validateAcessToken($data['access_token']);
        //$userId = $vendorData['user_id'];
        $userId = 0;
        if (isset($data['access_token']) && $data['access_token']) {
            //$vendorData = parent::validateAcessToken($data['access_token']);
            $rs = parent::getToken($data['access_token']);
            $userId = isset($rs['user_id']) ? $rs['user_id'] : 0;
        }
        $userId = isset($data['user_id']) ? $data['user_id'] : $userId;
        $num = isset($data['num']) ? $data['num'] : 20;
        $data['user_id'] = $userId;
        $data['self'] = 1;
        $rs = ProductService::getInstance()->getProductList ($data,$num);
        //$rs = ProductService::getInstance()->getUserProducts ($userId,$data,$num);
        return response()->forApi($rs);
    }

}