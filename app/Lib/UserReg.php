<?php namespace App\Lib;

use App\Models\User;
use App\Models\InvitationCode;
use Illuminate\Support\Facades\Crypt;
use Validator;

use Illuminate\Support\Facades\Redis  as Redis;

class UserReg
{

    private $access_token = '';//默认查询key

    private $token_key = 'SoftApp_';//临时会话redis前缀

    private $redisNameSpace = 'user:';
    private $alias_key = ':tokenAlias';//alias关系redis前缀

    private $exptime = 604800;//session过期时间  默认7天

    private $redisDb = 'session';

    private $redis;//公共参数数据源

    public $ctAlias = array(1=>'mobile',2=>'mobile',3=>'pc');


    //用户redis缓存key
    private $redis_parameter = array(
        'user_id' => '', //userß_id
        'username' => '',    //用户昵称
        'ct' => '',      //ct 客户端类型：1: ios 2: android 3:pc  4:web
        'v' => '',       //客户端版本号
        'lastlogintime' => '', //最后登录时间
    );

    public function __construct() {
        $this->redis = Redis::connection($this->redisDb);//redis

    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public function create(array $data)
    {
//        if (isset($data['mobile'])) {
//            $row = User::where('mobile', '=', $data['mobile'])->first ();
//            if(method_exists($row,'toArray')){
//                return false;
//            }
//        }

        if( isset($data['password']))$data['password'] = bcrypt($data['password']);
        return self::userBaseInit($data);

    }

    /**
     * accessToken 初始化或者更新操作
     * @param $params
     * return $access_token
     *
     */
    public function tokenInit (array $params) {
        if (!isset($params['user_id'])) return false;
        try {
            //if (Agent::isMobile()) {
            //$pt = 'mobile';
            //}else{}
            $pt = $this->ctAlias[$params['ct']];
            $user_id = $params['user_id'];
            $access_token = $this->getTokenById($user_id, $pt);
            if($pt == 'pc' && $access_token ){
            }else{
                // 删除原有的token已经数据
                $this->delTokenById ($user_id, $pt);
                // 创建token
                $access_token = $this->createTokenById ( $user_id, $pt);
            }

            // session缓存
            $this->setSession ( $params );

        } catch ( \Exception $e ) {
            \Log::error ( $e );
            return false;
        }
        return $access_token;
    }

    /**
     * 场馆方登录
     * @param unknown $params
     * @return Vendor
     */
    public function logIn(array $params) {
        //$user = User::where(['mobile'=>$params['mobile']])->first()->toArray();
        if( isset($params['user']) && !empty($params['user']['id']) ){

            unset($params['account']);
            unset($params['password']);
            $params['lastlogintime'] = time();
            $params['user_id'] = $params['user']['id'];
            $access_token = self::tokenInit($params);
            return $access_token ? array('user'=>$params['user'],'access_token'=>$access_token) : false;
        }
        return false;
    }

    public function AuthLogin ($oauthUser) {
        $gender = ['男'=>1,'女'=>0,''=>0];
        $token = $oauthUser->token;
        $id = $oauthUser->getId();
        // $qq_gender = $oauthUser->getGender();
        if(!empty($data['auth_avatar'])){
            $url = parse_url($data['auth_avatar']);
            $arr = explode('/',trim($url['path']));
            if(isset($arr[2]) && is_numeric($arr[2]))$data['qq'] = $arr[2];
        }

        $row = User::where('qq_id',$id)->first();
        if (empty($row)) {
            $data['status']=1;
            $data['qq_id'] =$id;
            $data['qq_token'] = $token;
            $data['username'] = $oauthUser->getName();
            $data['nick'] = $oauthUser->getNickname();
            if(empty( $data['username']))  $data['username'] =  $data['nick'];
            $data['username'] = self::isNameExit($data['username']);
            $data['email'] = $oauthUser->getEmail();
            $data['auth_avatar'] = $oauthUser->getAvatar();

            //$data['gender'] = isset($gender[$qq_gender]) ? $gender[$qq_gender] : 0;
            $user_id =  User::insertGetId($data);
            $row = User::find($user_id);
        }else{
            $data['qq_token'] = $token;
            //$data['username'] = $oauthUser->getName();
            $data['nick'] = $oauthUser->getNickname();
            if (empty($data['username']))$data['username'] = $data['nick'];
            $data['email'] = $oauthUser->getEmail();
            $data['auth_avatar'] = $oauthUser->getAvatar();

            // $data['gender'] = isset($gender[$qq_gender]) ? $gender[$qq_gender] : 0;
            User::where('qq_id',$id)->update($data);
        }
        $row = $row->toArray();

        //用户登陆相关动作
        $params['ct'] = 3;
        $params['v'] = 1;
        $params['auth'] = 'qq';
        $params['user'] = $row;
        $userData = self::logIn($params);
        return $userData;
    }
    public function AuthQqLogin ($params) {
        $token = $params['uid'];
        $id = $params['uid'];
        $gender = ['男'=>1,'女'=>0,''=>0];
//        if(!empty($data['auth_avatar'])){
//            $url = parse_url($data['auth_avatar']);
//            $arr = explode('/',trim($url['path']));
//            if(isset($arr[2])&& is_numeric($arr[2])){
//                $data['qq'] = $arr[2];
//                $data['email'] = $data['qq'].'@qq.com';
//            }
//
//        }

        $row = User::where('qq_id',$id)->first();

        if (empty($row)) {
            $data['status']=1;
            $data['qq_id'] =$id;
            $data['qq_token'] = $token;
            $data['username'] = $params['nickname'];
            $data['nick'] = $params['nickname'];
            $data['signature'] = isset($params['msg']) ? $params['msg'] : '' ;
            if(empty( $data['username']))  $data['username'] =  $data['nick'];
            $data['username'] = self::isNameExit($data['username']);
            $data['auth_avatar'] =isset($params['auth_avatar']) ? $params['auth_avatar'] : '';

            if(isset($params['gender']))$data['gender'] = isset($gender[$params['gender']]) ? $gender[$params['gender']] : 0;
            $user_id =  User::insertGetId($data);
            $row = User::find($user_id);
        }else{
            $data['qq_token'] = $token;
            $data['signature'] = isset($params['msg']) ? $params['msg'] : '' ;
            $data['nick'] =$params['nickname'];
            if (empty($data['username']))$data['username'] = $data['nick'];
            $data['auth_avatar'] =isset($params['auth_avatar']) ? $params['auth_avatar'] : '';
            if(isset($params['gender']))$data['gender'] = isset($gender[$params['gender']]) ? $gender[$params['gender']] : 0;
            User::where('qq_id',$id)->update($data);
        }
        $row = $row->toArray();

        //用户登陆相关动作
        $entry['ct'] = 3;
        $entry['v'] = 1;
        $entry['auth'] = 'qq';
        $entry['user'] = $row;
        $userData = self::logIn($entry);
        return $userData;
    }
    public function AuthWechatLogin ($oauthUser) {
        $token = $oauthUser->token;
        $id = $oauthUser->getId();
        // $qq_gender = $oauthUser->getGender();
        $row = User::where('wechat_id',$id)->first();
        if (empty($row)) {
            $data['status']=1;
            $data['wechat_id'] =$id;
            $data['wechat_token'] = $token;
            $data['nick'] = $oauthUser->getNickname();
            $data['username'] = $oauthUser->getNickname();
            if (empty($data['username']))$data['username'] = $data['nick'];
            $data['username'] = self::isNameExit($data['username']);
            //$data['wechat'] = $oauthUser->getNickname();
            if(empty( $data['username']))  $data['username'] =  $data['nick'];
            $data['email'] = $oauthUser->getEmail();
            $data['auth_avatar'] = $oauthUser->getAvatar();
            //$data['gender'] = isset($gender[$qq_gender]) ? $gender[$qq_gender] : 0;
            $user_id =  User::insertGetId($data);
            $row = User::find($user_id);
        }else{
            $data['wechat_token'] = $token;
            //$data['username'] = $oauthUser->getName();
            $data['nick'] = $oauthUser->getNickname();
            //$data['wechat'] = $oauthUser->getNickname();
            //if (empty($data['username']))$data['username'] = $data['nick'];
            $data['email'] = $oauthUser->getEmail();
            $data['auth_avatar'] = $oauthUser->getAvatar();
            // $data['gender'] = isset($gender[$qq_gender]) ? $gender[$qq_gender] : 0;
            User::where('wechat_id',$id)->update($data);
        }
        $row = $row->toArray();

        //用户登陆相关动作
        $params['ct'] = 3;
        $params['v'] = 1;
        $params['auth'] = 'wechat';
        $params['user'] = $row;
        $userData = self::logIn($params);
        return $userData;
    }

    public function AuthWechatSdkLogin ($params) {
        $token = $params['unionid'];
        $id = $params['openid'];
        $row = User::where('wechat_id',$id)->first();
        if (empty($row)) {
            $data['status']=1;
            $data['wechat_id'] =$id;
            $data['wechat_token'] = $token;
            $data['nick'] = $params['nickname'];
            $data['wechat'] = isset($params['wechat']) ? $params['wechat'] : '';
            $data['username'] = $params['nickname'];
            if (empty($data['username']))$data['username'] = $data['nick'];
            $data['username'] = self::isNameExit($data['username']);
            if(empty( $data['username']))  $data['username'] =  $data['nick'];
            $data['auth_avatar'] = isset($params['headimgurl']) ? $params['headimgurl'] : '';
            if(isset($params['gender']))$data['gender'] = $params['sex'];
            $user_id =  User::insertGetId($data);
            $row = User::find($user_id);
        }else{
            $data['wechat_token'] = $token;
            $data['nick'] =  $params['nickname'];
            $data['wechat'] = isset($params['wechat']) ? $params['wechat'] : '';
            $data['auth_avatar'] = isset($params['headimgurl']) ? $params['headimgurl'] : '';
            if(isset($params['gender']))$data['gender'] = $params['sex'];
            User::where('wechat_id',$id)->update($data);
        }
        $row = $row->toArray();

        //用户登陆相关动作
        $entry['ct'] = 3;
        $entry['v'] = 1;
        $entry['auth'] = 'wechat';
        $entry['user'] = $row;
        $userData = self::logIn($entry);
        return $userData;
    }

    protected function isNameExit($username){
        $row = User::where('username',$username)->first();
        if (!empty($row)) {
            $username = $username.rand(1,100);
        }
        return $username;
    }

    /**
     * 登出
     *
     * @param string $access_token
     * @return boolean
     */
    public function logOut($access_token, $pt = 'mobile'){
        $session = $this->getSession($access_token);
        if($session){
            $pt = $this->ctAlias[$session['ct']];
            $ret = $this->delTokenById($session['user_id'], $pt);
            if($ret){
                return true;
            }
        }
        return false;
    }
    /**
     * 检查用户登陆
     *
     * @param string $access_token
     * @return boolean
     */
    public function checkLogin($access_token){
        if($access_token){
            if($session = $this->getSession($access_token)){
                return $session;
            }
        }
        return false;
    }


    //基础逻辑

    //encode function
    private static function token_encode($string){
        return md5(base64_encode($string));
    }


    //根据用户id创建token
    private function createTokenById($vendors_id, $pt = 'mobile'){
        $this->access_token = self::token_encode($this->token_key.$vendors_id.'_'.date('ymdhis'));
        $this->createAlias($vendors_id, $pt);//创建映射关系

        return $this->access_token;
    }
    //创建uid-》token映射关系
    private function createAlias($vendors_id, $pt){
        $alias_key = $this->redisNameSpace.$vendors_id.':'.$pt.$this->alias_key;
        $this->redis->setex($alias_key,$this->exptime, $this->access_token);
    }

    //删除token
    private function delTokenById($vendors_id, $pt = 'mobile'){
        if($access_token = $this->getTokenById($vendors_id, $pt)){
            $alias_key = $this->redisNameSpace.$vendors_id.':'.$pt.$this->alias_key;
            $this->delSession($access_token);
            return $this->redis->del($alias_key);
        }
        return false;
    }

    /**
     * 根据uid找token
     *
     * @param init $user_id
     * @return string
     */
    public function getTokenById($vendors_id, $pt = 'mobile'){
        $alias_key = $this->redisNameSpace.$vendors_id.':'.$pt.$this->alias_key;
        $alias_string = $this->redis->get($alias_key);
        return $alias_string;
    }

    //redis 操作函数

    //设置会话信息
    private function setSession($params = array()){
        $saveParams = array();
        foreach($params as $k => $v){
            if(array_key_exists($k, $this->redis_parameter)){
                $saveParams[$k] = $v;
            }
        }

        if(!empty($saveParams)){

            $this->redis->setex($this->access_token,$this->exptime, serialize($saveParams));
        }
    }

    /**
     * userid获取用户session
     *
     * @param init $user_id
     * @return array
     */
    public function getSessionById($vendors_id){
        return $this->getSession($this->getTokenById($vendors_id));
    }


    /**
     * access_token获取用户session
     *
     * @param init $user_id
     * @return array
     */
    public function getSession($access_token) {
        $sessionInfo = array();
        if(!isset($access_token)){
            $access_token = $this->access_token;
        }

        $sessionInfo = $this->redis->get($access_token);
        $sessionInfo = unserialize($sessionInfo);
        return $sessionInfo;
    }


    //删除零时会话
    private function delSession($access_token) {
        return $this->redis->del($access_token);

    }





    //基本信息字段
    private $vendorbase_column = array (
        'id' => 'int', //userid
        'mobile' => '',//电话号码
        'email' => '', //邮箱
        'password' => '',//密码
        'username' => '', //用户名
        'invite_uid' => '',//邀请id
        'gender' => '',//性别
        'status' => '',
        'is_seller' => '',//是否开店
    );

    //用户基本信息初始化
    private function userBaseInit($params = array()){
        if(!empty($params)){
            $saveParams = array ();
            foreach ( $params as $k => $v ) {
                if (array_key_exists ( $k, $this->vendorbase_column )) {
                    if($this->vendorbase_column[$k] == 'int'){
                        $v = intval($v);
                    }
                    $saveParams [$k] = $v;
                }
            }

            if(!empty($saveParams)){
                $saveParams['created_at'] = date('Y-m-d h:i:s');
                $saveParams['updated_at'] = date('Y-m-d h:i:s');
                return User::insertGetId($saveParams);
            }
        }
    }
}
