<?php
class Wechat
{
  public $appid = "";
  public $appsecret = "";
  public $code = "";
  //构造函数，获取Access Token
  public function __construct($code = NULL){
      $this->appid = 'wx11d5991f5ed048f8';
      $this->appsecret = 'def48bece237339faad4f6e253a8036f';
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
//获取用户基本信息
  public function get_user_info($openid)
  {
    $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->access_token."&openid=".$openid."&lang=zh_CN";
    $res = $this->https_request($url);
    return json_decode($res, true);
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

  public function login(){
    $appid = $this->appid;
    $csrf = md5(mt_rand(5,1000).time());
    $url = "https://open.weixin.qq.com/connect/qrconnect?appid={$appid}&redirect_uri={$this->callurl}&response_type=code&scope=snsapi_login&state={$csrf}#wechat_redirect";
    return $url;
  }

  public function gettoken($code = ''){
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code";
    $res =  $this->https_request($url);
    return json_decode($res,1);
  }
}