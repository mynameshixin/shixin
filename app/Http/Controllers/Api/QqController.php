<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/11/10
 * Time: 下午1:32
 */

namespace App\Http\Controllers\Api;


//use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use App\Lib\UserReg as Registrar ;
/**
 * @SWG\Resource(
 *  resourcePath="/qq",
 *  description="qq登录",
 * )
 */

class QqController extends BaseController
{


    public function __construct( Registrar $registrar)
    {
        $this->registrar = $registrar;

    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/qq/auth",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="qq授权登陆",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="uid",
     *           description="qq uid",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="nickname",
     *           description="昵称",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="msg",
     *           description="描述",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="auth_avatar",
     *           description="头像",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="gender",
     *           description="性别",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="province",
     *           description="省份",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="city",
     *           description="城市",
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
    public function auth()
    {
        $data = Input::all();
        $rules = array (
            'uid' =>'required',
            'nickname' =>'required',
            'auth_avatar' =>'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userData = $this->registrar->AuthQqLogin ($data);
        if (!empty($userData)) {
            $entry['access_token'] = $userData['access_token'];
            return response(['data'=>$entry,'code'=>200,'message'=>'']);
        }else{
            return response()->forApi(array(), 1001, 'login failed');
        }

    }

    public function login() {
        return \Socialite::driver('qq')->redirect();
    }


    public function callback() {
        $gender = ['男'=>1,'女'=>0,''=>0];
        @$oauthUser = \Socialite::with('qq')->user();
        $code = isset($_GET['code'])?$_GET['code']:'';
        if($oauthUser->user==-1 && !empty($code)){
            $login_url = "http://www.duitujia.com/webd/tlogin/qqback?code={$code}";
            header("Location: $login_url");
            die();
        }
       $userData = $this->registrar->AuthLogin ($oauthUser);
        if (!empty($userData)) {
            \Auth::loginUsingId($userData['user']['id']);
            return redirect('/');

        }else{

            return redirect('/auth/login')->withErrors(['msg'=>'授权登录失败']);

        }
    }

}