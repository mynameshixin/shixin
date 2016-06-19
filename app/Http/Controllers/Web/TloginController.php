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
    public static $url;
    public function __construct( Registrar $registrar)
    {
        $this->registrar = $registrar;
        self::$url = url('/');
    }

    public function getQq(){
        $url = Input::get('url');
        self::$url = !empty($url)?$url:url('/');
        require_once("tlogin/qq/qqConnectAPI.php");
        $qc = new \QC();
        $login_url = $qc->qq_login();
        header("Location: $login_url"); 
        die();
        
    }

    public function getQqback(){
        require_once("tlogin/qq/qqConnectAPI.php");
        $auth = new \QC();
        $token = $auth->qq_callback();
        $openid = $auth->get_openid();
        
        if(!empty($token) && !empty($openid)){

            $qc = new \QC($token,$openid);
            $userinfo = $qc->get_user_info();
            // var_dump($userinfo);
            $this->userinfo = $userinfo;
            $this->userinfo['uid'] = $openid;
            $this->userinfo['open_id'] = $openid;
            $this->userinfo['auth_avatar'] = $userinfo['figureurl_qq_2'];
            $r = $this->weblogin(1);
            if($r) return redirect(self::$url);
        }
    }

    public function getWechat(){
        require_once("tlogin/wechat/wechat.php");
        $wechat = new \Wechat();
        $url = $wechat->login();
        header("Location: $url"); 
        die();
    }

    public function getWback(){
        require_once("tlogin/wechat/wechat.php");
        $code = Input::get('code');
        $state = base64_decode(Input::get('state'));
        $redirect_url = !empty($state)?$state:self::$url;
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

    //qq wechat 登陆返回检测
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
                $userData = $this->registrar->AuthQqLogin ($data);
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
}