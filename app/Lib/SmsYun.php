<?php
/**
 * Created by PhpStorm.
 * User: anne
 * Date: 15/5/26
 * Time: 上午10:46
 */
namespace App\Lib;

use App\Lib\Sms\SendTemplateSMS;
use Illuminate\Support\Facades\Redis  as Redis;

class SmsYun extends SendTemplateSMS
{

    private $token_key = 'duoDoApp_';//临时会话redis前缀

    private $redisNameSpace = 'sms:';
    private $alias_key = ':captchaAlias';//alias关系redis前缀

    private $exptime = 5;//session过期时间  默认5分钟

    private $redisDb = '';

    private $redis;//公共参数数据源

    public function __construct() {
        $this->redis = Redis::connection($this->redisDb);//redis
    }

    /**
     * 发送模板短信
     * @param to 手机号码集合,用英文逗号分开
     * @param $type 短信类型：自定义  例如：1 注册 2 找回密码
     * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
     * @param $client 用户端 'vendor' 场馆方
     * @return array
     */
    public function sendSMS($to,$type=0,$tempId=68701)
    {
        $captcha = mt_rand(100000, 999999);
        $datas = [$captcha,$this->exptime];
        $result = parent::sendTemplateSMS($to, $datas,$tempId);
        if ($result['code']=='100') {
            $result['captcha'] = $captcha;
            $mobile = $to ;
          //写入redis
            $alias_key = $this->redisNameSpace.$mobile.':'.$type.$this->alias_key;
            $this->redis->setex($alias_key,$this->exptime * 60, $captcha);
            return true;
        }
        return $result;
    }

    /**
     * @param $mobile 手机号码
     * @param $captcha 验证码
     * @param string $client 用户端 'vendor' 场馆方
     * @param int $type 短信类型：自定义  例如：1 注册 2 找回密码
     * @return bool
     */
    public function checkVerificationCode ($mobile,$captcha,$type=0,$client='')
    {
        $alias_key = $this->redisNameSpace . $mobile . ':' . $type . $this->alias_key;
        $code = $this->redis->get($alias_key);
        if ($captcha == $code) {
            return true;
        }
        return false;
    }

}