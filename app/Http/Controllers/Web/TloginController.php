<?php
namespace App\Http\Controllers\Web;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use App\Lib\UserReg as Registrar ;

class TloginController extends CmController
{
    public $userinfo = '';
    public $url;
    public function __construct( Registrar $registrar)
    {
        $this->registrar = $registrar;
        $this->url = url('/');
    }

    public function getQq(){
        $url = Input::get('url');
        $this->url = !empty($url)?$url:url('/');
        require_once("tlogin/qq/qqConnectAPI.php");
        $qc = new \QC();
        $login_url = $qc->qq_login();
        header("Location: $login_url"); 
        die();
        
    }

    public function getUrl(){
        
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
            $this->userinfo['auth_avatar'] = $userinfo['figureurl_qq_2'];
            $r = $this->weblogin();
            if($r) return redirect($this->url);
        }
        

    }


    public function getWeblogin(){
        $data = $this->userinfo;
        $userData = $this->registrar->AuthQqLogin ($data);
        // dd($userData);
        if (!empty($userData)) {
            self::crypt_cookie('user_id',$userData['user']['id']);
            return  1;
        }else{
            return 0;
        }

    }
}