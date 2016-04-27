<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/11/10
 * Time: 下午1:32
 */

namespace App\Http\Controllers\Api;


//use Laravel\Socialite\Facades\Socialite;
use App\Lib\UserReg as Registrar ;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;

/**
 * @SWG\Resource(
 *  resourcePath="/wechat",
 *  description="微信登录",
 * )
 */

class WechatController extends BaseController
{

    public function __construct( Registrar $registrar)
    {
        $this->registrar = $registrar;

    }

    public function login() {
        return \Socialite::driver('wechat')->redirect();
    }


    public function callback() {

        $oauthUser = \Socialite::with('wechat')->user();


        $userData = $this->registrar->AuthWechatLogin ($oauthUser);

       if (!empty($userData)) {
//           if (\Agent::isMobile()) {
//               return response(['access_token'=>$userData['access_token'],'code'=>200,'message'=>''])->withCookie(cookie('access_token',$userData['access_token']));
//           }
               \Auth::loginUsingId($userData['user']['id']);
               return redirect('/');

        }else{

            return redirect('/auth/login')->withErrors(['msg'=>'授权登录失败']);

        }
    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/wechat/auth",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="微信授权登陆",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="openid",
     *           description="微信openid",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="unionid",
     *           description="unionid",
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
     *           name="wechat",
     *           description="微信号",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="headimgurl",
     *           description="头像",
     *           paramType="form",
     *           required=false,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="sex",
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
            'openid' =>'required',
            'nickname' =>'required',
            'unionid' =>'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userData = $this->registrar->AuthWechatSdkLogin ($data);
        if (!empty($userData)) {
            $entry['access_token'] = $userData['access_token'];
            return response(['data'=>$entry,'code'=>200,'message'=>'']);
        }else{
                return response()->forApi(array(), 1001, 'login failed');
        }

    }

}