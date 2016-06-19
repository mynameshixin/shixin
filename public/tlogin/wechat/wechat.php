<?php
class Wechat
{
  public $appid = "";
  public $appsecret = "";
  public $code = "";
  //构造函数，获取Access Token
  public function __construct($code = NULL){
      $this->appid = 'wx11d5991f5ed048f8';
      $this->appsecret = 'c22d0eecf0dbd9ac8ed77ae48f485095';
      $this->lasttime = 1395049256;
      $this->callurl = urlencode("http://www.duitujia.com/webd/tlogin/wback");
      $this->code = $code;
      /*$this->access_token = "nRZvVpDU7LxcSi7GnG2LrUcmKbAECzRf0NyDBwKlng4nMPf88d34pkzdNcvhqm4clidLGAS18cN1RTSK60p49zIZY4aO13sF-eqsCs0xjlbad-lKVskk8T7gALQ5dIrgXbQQ_TAesSasjJ210vIqTQ";
      if (time() > ($this->lasttime + 7200)){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
        $res = $this->https_request($url);
        $result = json_decode($res, true);
        
        $this->access_token = $result["access_token"];
        $this->lasttime = time();
      }*/
  }


//https请求
  public function https_request($url, $data = null)
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
  }
  //弹出登录框
  public function login(){
    $appid = $this->appid;
    $csrf = md5(mt_rand(5,1000).time());
    $url = "https://open.weixin.qq.com/connect/qrconnect?appid={$appid}&redirect_uri={$this->callurl}&response_type=code&scope=snsapi_login&state={$csrf}#wechat_redirect";
    return $url;
  }

  // 获取token
  public function gettoken($code = ''){
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code";
    $res =  $this->https_request($url);
    return json_decode($res,1);
  }

  //获取用户基本信息
  public function get_user_info($token = '',$openid = ''){
    $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$token}&openid={$openid}";
    $res = $this->https_request($url);
    return json_decode($res, true);
  }
}