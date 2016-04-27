<?php
/**
 * 短信
 * User: yantingting
 * Date: 15/8/28
 * Time: 上午8:46
 */

namespace App\Lib;

use App\Lib\Sms\SMSClient;

class SmsBase {

    private  $ServerIP  = 'http://sdk.zyer.cn/SmsService/SmsService.asmx';


    private  $LoginName = 'paxxkj';

    private  $Password = 'etuo2015';

    function __construct()
    {
        $this->Password = substr(md5($this->Password),8,16);
    }

    /**
     * @param $mobile
     * @param $content
     * @param int $ExpSmsId
     * @return bool
     */
    public function sendSMS ($mobile,$content,$ExpSmsId=0) {
        $url = $this->ServerIP.'/SendEx' ;
        $data = [
            'LoginName' => $this->LoginName,
            'Password' => $this->Password,
            'SmsKind' => 808,
            'SendSim' => $mobile,
            'ExpSmsId' => $ExpSmsId ? $ExpSmsId : rand(100,1000),
            'MsgContext' => $content,

        ];
        $data['MsgContext'] = mb_convert_encoding($data['MsgContext'], "GBK");
        $result = LibUtil::curlGet($url,$data);
        $result = simplexml_load_string($result);
        if ($result->code) {
            \Log::error($result);
        }
        return $result->code ? false : true;
    }
}