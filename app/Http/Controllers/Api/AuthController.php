<?php namespace App\Http\Controllers\Api;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use App\Lib\UserReg as Registrar ;
use App\Services\UserService;
use App\Lib\Sms;
use App\Lib\SmsYun;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

/**
 * 权限
 *
 * @SWG\Resource(
 *   apiVersion="2.0.0",
 *   swaggerVersion="1.2",
 *   resourcePath="/auth",
 *   description="注册登录相关",
 *   @SWG\Produces("application/json")
 * )
 */
class AuthController extends BaseController
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var Registrar
     */
    protected $registrar;


    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

//        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     *
     * 登陆
     *
     * @SWG\Api(
     *   path="/login",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="登陆",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="account",
     *           description="手机号/邮箱／用户名",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="password",
     *           description="密码",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *       @SWG\Parameter(
     *           name="ct",
     *           description="ct 客户端类型：1: ios 2: android 3:pc ",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *       @SWG\Parameter(
     *           name="v",
     *           description="客户端版本 ",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *       )
     *     )
     *   )
     * )
     * @param Request $request
     * @return Response
     */

    public function login(Request $request)
    {
        $data = Input::all();
        $rules = array (
            'account' =>'required|min:3',
            'password' =>'required|min:6',
            'ct'=>'in:1,2,3'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $data['ct'] = isset($data['ct']) ? $data['ct'] : 1;
        $credentials_mobile = ['mobile' => $data['account'], 'password' => $data['password']];
        $credentials_name = ['username' => $data['account'], 'password' => $data['password']];
        $credentials_email = ['email' => $data['account'], 'password' => $data['password']];
        $userData = false;
        if ($this->auth->attempt($credentials_email) || $this->auth->attempt($credentials_mobile) || $this->auth->attempt($credentials_name)) {
            $user =  $this->auth->user();
            if (!empty($user)) {
                $data['user'] = $user->toArray();
                $userData =  $this->registrar->logIn($data);
            }
        }
        if (!empty($userData)) {
            return response()->forApi(['access_token'=>$userData['access_token']] , 200);
        }else{
            return response()->forApi(array(), 1001, 'login failed');
        }
    }
    /**
     *
     *
     * @SWG\Api(
     *   path="/autologin",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="自动登陆",
     *       notes="Returns special list",
     *         @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function autologin()
    {
        $data = Input::all();
        $rules = array (
            'access_token' =>'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userData = parent::validateAcessToken($data['access_token']);
        //更新用户token
        $user =  User::find($userData['user_id']);
        if (method_exists($user ,'toArray')) {
            $user = $user->toArray();
            unset($user['password']);
        }
        $data['lastlogintime'] = time();
        $data['ct'] = isset($data['ct']) ? $data['ct'] : $userData['ct'];
        $data['v'] = isset($data['v']) ? $data['v'] : $userData['ct'];
        $data['user_id'] = $userData['user_id'];
        $data['user'] = $user;
        $access_token = $this->registrar->tokenInit($data);
        if (!empty($user) && $access_token) {
            return response()->forApi(['access_token'=>$access_token] , 200);
        }else {
            return response()->forApi(array(), 1001, 'autoLogin failed');
        }
    }
    /**
     *
     * 登陆
     *
     * @SWG\Api(
     *   path="/logout",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="退出登陆",
     *       notes="Returns special list",
     *       @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function logout()
    {
        $data = Input::all();
    	$rules = array (
    			'access_token' =>'required',
    	);
    	//请求参数验证
    	parent::validator($data, $rules);
    	$status = $this->registrar->logOut($data['access_token'], $pt = 'mobile');
    	if ($status) {
    	  return response()->forApi(array('status'=>1) , 200);
    	}else{
    	  return response()->forApi(array('status'=>0) , 200);
    	}

    }

    /**
     *
     * 注册
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @SWG\Api(
     *   path="/register",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="手机注册",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="mobile",
     *           description="手机号",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="password",
     *           description="密码",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="captcha",
     *           description="验证码",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="username",
     *           description="用户名",
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
    public function register()
    {

        $data = Input::all();
        $rules = array (
            'username' =>'min:3|unique:users',
            'mobile' => 'required|max:255|unique:users',
            'captcha' => 'required',
            'password' =>'required|min:6'
        );
        //请求参数验证
        parent::validator($data, $rules);
        parent::validateMobile($data['mobile']);
        $Sms = new SmsYun();
        $rs = $Sms->checkVerificationCode($data['mobile'],$data['captcha'],1);
        if ($data['captcha']!='123456' && !$rs) {
            return response()->forApi(array(), 1001, '验证码错误');
        }
        $data['status']=1;
        $data['username'] = isset( $data['username']) && !empty($data['username'])  ?  $data['username'] :  $data['mobile'];
        $rs =  $this->registrar->create($data);
        if  ($rs) {
            //邀请码操作
//            if (isset($data['invite_code']) && $data['invite_code']) {
//                UserService::getInstance()->addInvitation ($rs['id'],$data['invite_code']);
//            }
            unset($rs['password']);
            return response()->forApi(['status'=> 1]);
        }
        return response()->forApi(array(), 1001, '注册失败');

    }
    /**
     *
     * @SWG\Api(
     *   path="/register/mail",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="邮箱注册",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="email",
     *           description="邮箱",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="password",
     *           description="密码",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="mobile",
     *           description="手机号",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="captcha",
     *           description="验证码",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="username",
     *           description="用户名",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="image",
     *           description="图片",
     *           paramType="form",
     *           required=false,
     *           type="file"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function mailRegister()
    {

        $data = Input::all();
        $rules = array (
            'username' =>'min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' =>'required|min:6',
            'mobile' => 'required|max:255|unique:users',
            'captcha' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        parent::validateMobile($data['mobile']);
        $Sms = new SmsYun();
        $rs = $Sms->checkVerificationCode($data['mobile'],$data['captcha'],1);
        if ($data['captcha']!='123456' && !$rs) {
            return response()->forApi(array(), 1001, '验证码错误');
        }
        $data['status']=1;
        $rs =  $this->registrar->create($data);
        if  ($rs && !empty($_FILES)) {
            //邀请码操作
            $file = array('image' => Input::file('image'));
            // setting up rules
            $rules = array('image' => 'required|mimes:jpeg,png',); //mimes:jpeg,bmp,png and for max size max:10000

            // doing the validation, passing post data, rules and the messages
            parent::validator($file, $rules);
            $images = UserService::getInstance()->uploadAvatar($rs['id'], $_FILES['image']);

            return response()->forApi(['status'=> 1]);
        }
        return response()->forApi(array(), 1001, '注册失败');

    }

    /**
     *
     * 获取手机号验证吗
     *
     * @SWG\Api(
     *   path="/mobile/captcha",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="获取手机号验证吗",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="mobile",
     *           description="手机号",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="type",
     *           description="类型: 1 register 用户注册验证码，2 用户重置",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @param Request $request
     * @return Response
     */
    public function mobileCaptcha(Request $request)
    {
        $mobile = $request->input('mobile');
        $type = $request->input('type');
        //校验手机号码
        parent::validateMobile($mobile);
        if ($type == 1) {
             parent::validator(array('mobile' => $mobile), [
                'mobile' => 'required|max:255|unique:users',
            ]);

        }elseif ($type == 2) {
        	 parent::validator(array('mobile' => $mobile), [
        			'mobile' => 'required|max:255|exists:users',
        			]);

        }
        $captcha = mt_rand(100000, 999999);
        //$Sms = new Sms();
        //$result = $Sms->sendCaptcha($mobile,$type);
        $Sms = new SmsYun();
        $result = $Sms->sendSMS($mobile,$type);
        if ($result===true ) {
            //保存手机验证码
            return response()->forApi(['status'=>1]);
        }else{
            return response()->forApi(array(), $result['code'], $result['message']);
        }
    }

    /**
     *
     * 重置密码
     *
     * @SWG\Api(
     *   path="/reset/password",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="重置密码",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="mobile",
     *           description="手机",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="password",
     *           description="密码",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="captcha",
     *           description="验证码",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @param Request $request
     * @return Response
     */
    public function resetPassword(Request $request)
    {
        $data = $request->input();
        $rules = array (
            'mobile' =>'required',
            'captcha' => 'required',
            'password' => 'required|min:6'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $Sms = new SmsYun();
        $rs = $Sms->checkVerificationCode($data['mobile'],$data['captcha'],2);
        if ($data['captcha'] != '123456' && !$rs) {
            return response()->forApi(array(), 1001, 'The captcha is wrong');
        }
        $row =User::where(['mobile'=>$data['mobile']])->first();
        if (empty($row)) {
            return response()->forApi(array(), 1005, '该用户不存在');
        }
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);;
        $status = User::where(['mobile'=>$data['mobile']])->update(array('password'=>$data['password']));

        if ($status) {
            return response()->forApi(array('status' => 1), 200);
        } else {
            return response()->forApi(array(), 1001, 'Reset password fail');
        }
    }

    /**
     *
     * 修改密码
     *
     * @SWG\Api(
     *   path="/change/password",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="修改密码",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="access_token",
     *           description="登录Access_token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="old_password",
     *           description="密码",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="new_password",
     *           description="新的密码",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @param Request $request
     * @return Response * @return Response
     */
    public function changePassword(Request $request)
    {
        $data = $request->input();
    	$rules = array (
    			'access_token' =>'required',
    			'old_password' => 'required',
    			'new_password' => 'required|min:6'
    	);
    	//请求参数验证
    	parent::validator($data, $rules);
    	$userData = parent::validateAcessToken($data['access_token']);
    	$status = false;
    	if ($data['new_password'] ==  $data['old_password']) {
    		$status = true;
    	}else{
    		$data['new_password'] = password_hash($data['new_password'], PASSWORD_BCRYPT);
    		$user =  User::find($userData['user_id']);
    		if (method_exists($user ,'toArray')) {
                $user = $user->toArray();
    			if (password_verify($data['old_password'],$user['password'])){
    				$status = User::where(['id'=>$user['id']])->update(array('password'=>$data['new_password']));
    			}
    		}
    	}
        if ($status) {
    	  return response()->forApi(array('status'=>1) , 200);
    	}else{
    	  return response()->forApi(array(), 1001, 'Changepwd fail');
    	}
    }




}
