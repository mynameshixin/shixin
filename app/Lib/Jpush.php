<?php
/**
 * 极光推送
 * Created by PhpStorm.
 * User: anne
 * Date: 15/5/26
 * Time: 上午9:53
 */
namespace App\Lib;

use JPush\Model as M;
use JPush\JPushClient;
use JPush\Exception\APIConnectionException;
use JPush\Exception\APIRequestException;
use JPush\JPushLog;


class Jpush
{

    private $app_key = '57818d5486c39c5600c8b4f0';
    private $master_secret = 'dd359f37f0da01a6bccefbf3';
    protected $client = null;

    public function __construct()
    {
        $app_key = $this->app_key;
        $master_secret = $this->master_secret;
        return $this->client = new JPushClient($app_key, $master_secret);
    }
    /**
     * 发送消息推送
     * @param int $sendno 发送编号。由开发者自己维护，标识一次发送请求
     * @param int $receiver_type 接收者类型。1、指定的 registration_id。此时必须指定 appKeys。2、指定的 tag。3、指定的 alias。4、 对指定 appkey 的所有用户推送消息。
     * @param string $receiver_value 发送范围值，与 receiver_type相对应。 1、IMEI只支持一个 2、tag 支持多个，使用 "," 间隔。 3、alias 支持多个，使用 "," 间隔。 4、不需要填
     * @param int $msg_type 发送消息的类型：1、通知 2、自定义消息
     * @param string $msg_content 发送消息的内容。 与 msg_type 相对应的值
     * @param string $platform 目标用户终端手机的平台类型，如： android, ios 多个请使用逗号分隔
     * @param array $data 消息类型附加参数
     * @return bool
     */
    public function sendMsg ($sendno,$receiver_type ,$receiver_value='',$msg_type,$msg_content,$platform='',$data=array()) {
        $client = $this->client;
        try {
            $result = $client->push();
            if (in_array($platform,['android', 'ios'])) {
                $result = $result->setPlatform(M\platform($platform));

            }else{
                $result = $result->setPlatform(M\all);
            }
            $receiver_value = is_array($receiver_value) ? $receiver_value : array("$receiver_value");
            switch ($receiver_type) {
                case 1:
                    $result = $result->setAudience(M\audience(M\registration_id($receiver_value)));
                    break;
                case 2:
                    $result = $result->setAudience(M\audience(M\tag($receiver_value)));
                    break;
                case 3:
                    $result = $result->setAudience(M\audience(M\alias($receiver_value)));
                    break;
                case 4:
                    $result = $result->setAudience(M\all);
                    break;
                default:
                    $result = $result->setAudience(M\audience(M\alias($receiver_value)));
                    break;
            }
            if ($msg_type==2) {
                $result = $result ->setNotification(M\notification($msg_content, M\android($msg_content), M\ios($msg_content, 'happy', 1, true, null, 'THE-CATEGORY')));
            }else{
                $result = $result->setMessage(M\message($msg_content, null, null, $data));
            }

            $result = $result->setOptions(M\options($sendno, null, null, false, 0))->send();

            return array('code'=>100,'message'=>'Push Success.');
        } catch (APIRequestException $e) {
            return array('code'=>$e->code,'message'=>$e->message);

        } catch (APIConnectionException $e) {
            return array('code'=>1001,'message'=>$e->getMessage());
        }

        return true;
    }
    /**
     * 发送通知推送
     * @param string $msg_content 发送消息的内容
     * @param string $platform  全部
     * @return bool
     */
    public function sendNotice( $msg_content = '')
    {
        $client = $this->client;
        try {
            $result = $client->push()
                ->setPlatform(M\all)
                ->setAudience(M\all)
                ->setNotification(M\notification($msg_content, M\ios($msg_content, "happy", "+1")))
                ->printJSON()
                ->send();
            return array('code'=>100,'message'=>'Push Success.');
        } catch (APIRequestException $e) {
            return array('code'=>$e->code,'message'=>$e->message);

        } catch (APIConnectionException $e) {
            return array('code'=>1001,'message'=>$e->getMessage());
        }
    }



}