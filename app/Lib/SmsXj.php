<?php
/**
 * 短信
 * User: yantingting
 * Date: 15/8/28
 * Time: 上午8:46
 */

namespace App\Lib;

use App\Lib\Sms\SMSClient;

class SmsXj {

    private  $ServerIP  = 'http://www.jianzhou.sh.cn/JianzhouSMSWSServer/http';


    private  $LoginName = 'jzyy904';

    private  $Password = '20150701';

    function __construct()
    {
    }

    /**
     * @param $mobile
     * @param $content
     * @param int $ExpSmsId
     * @return bool
     */
    public function sendSMS ($mobile,$content) {
        $url = $this->ServerIP.'/sendBatchMessage' ;
        $data = [
            'account' => $this->LoginName,
            'password' => $this->Password,
            'destmobile' => $mobile,
            'msgText' => $content,

        ];
        $result = LibUtil::reqPost($url,$data);
        if ($result<0) {
            \Log::error($result);
        }
        return $result ? false : true;
    }
}