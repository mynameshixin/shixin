<?php
namespace App\Http\Controllers\Web;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use App\Lib\UserReg as Registrar;
use DB;

class TloginController extends CmController
{
    public $userinfo = '';
    public static $rurl = '';
    public function __construct( Registrar $registrar){
        $this->registrar = $registrar;
        self::$rurl = url('/');
    }

    public function getQq(){
        $redirect_url = urldecode(Input::get('rurl'));
        require_once("tlogin/qq/qqConnectAPI.php");
        $qc = new \QC();
        $login_url = $qc->qq_login($redirect_url);
        header("Location: $login_url"); 
        die();
        
    }

    public function getQqback(){
        require_once("tlogin/qq/qqConnectAPI.php");
        $auth = new \QC();
        $token = $auth->qq_callback();
        $rurl = $auth->get_rurl();
        $openid = $auth->get_openid();
        $redirect_url = !empty($rurl)?$rurl:self::$rurl;
        
        if(!empty($token) && !empty($openid)){
            $qc = new \QC($token,$openid);
            $userinfo = $qc->get_user_info();
            // var_dump($userinfo);
            $this->userinfo = $userinfo;
            $this->userinfo['uid'] = $openid;
            $this->userinfo['open_id'] = $openid;
            $this->userinfo['auth_avatar'] = $userinfo['figureurl_qq_2'];
            $r = $this->weblogin(1);
            if($r) return redirect($redirect_url);
        }
    }

    public function getWechat(){
        $redirect_url = urldecode(Input::get('rurl'));
        require_once("tlogin/wechat/wechat.php");
        $wechat = new \Wechat($redirect_url);
        $url = $wechat->login();
        header("Location: $url"); 
        die();
    }

    public function getWback(){
        require_once("tlogin/wechat/wechat.php");
        $code = Input::get('code');
        $state = base64_decode(Input::get('state'));
        $redirect_url = !empty($state)?$state:self::$rurl;
        $wechat = new \Wechat();
        $token = $wechat->gettoken($code);
        if(!empty($token['access_token']) && !empty($token['openid'])){
            $userinfo = $wechat->get_user_info($token['access_token'],$token['openid']);
            $this->userinfo = $userinfo;
            $r = $this->weblogin(2);
            if($r) return redirect($redirect_url);
        }else{
            die('expired,please relogin!');
        }
        
    }

    //登陆返回检测
    public function weblogin($type = ''){
        $data = $this->userinfo;
        $userData = [];
        if($type == 1){
            $user = DB::table('users')->where('qq_id',$data['open_id'])->first();
            if(!empty($user)){
                $userData['user']['id'] = $user['id']; 
            }else{
                $userData = $this->registrar->AuthQqLogin ($data);
            }
            
        }elseif($type==2){
            $user = DB::table('users')->where('wechat_token',$data['unionid'])->first();
            if(!empty($user)){
                $userData['user']['id'] = $user['id']; 
            }else{
                $userData = $this->registrar->AuthWechatSdkLogin ($data);
            }
        }
        // dd($userData);
        if (!empty($userData)) {
            self::crypt_cookie('user_id',$userData['user']['id']);
            return  1;
        }else{
            return 0;
        }

    }

    public function getWeibo(){
        require_once("tlogin/weibo/config.php");
        require_once("tlogin/weibo/saetv2.ex.class.php");
        $o = new \SaeTOAuthV2( WB_AKEY , WB_SKEY );
        $code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
        header("Location: $code_url"); 
        die();
    }

    public function getWeiboback(){
        require_once("tlogin/weibo/config.php");
        require_once("tlogin/weibo/saetv2.ex.class.php");
        $o = new \SaeTOAuthV2( WB_AKEY , WB_SKEY );

        if (isset($_REQUEST['code'])) {
            $keys = array();
            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] = WB_CALLBACK_URL;
            $token = $o->getAccessToken( 'code', $keys ) ;
        }

        if(!empty($token)){
            $c = new \SaeTClientV2( WB_AKEY , WB_SKEY , $token['access_token'] );
            $ms  = $c->home_timeline(); // done
            $uid_get = $c->get_uid();
            var_dump($uid_get);
            $uid = $uid_get['uid'];
            $userinfo = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息*/
            $this->userinfo = $userinfo;
            dd($userinfo);
            $r = $this->weblogin(3);
            if($r) return redirect();
        }
    }
}