<?php 
namespace App\Http\Controllers\Api;

use Jpush\Model as M;
use Jpush\JpushClient;
use Jpush\Exception\APIConnectionException;
use Jpush\Exception\APIRequestExcetion;
use DB;
class JpushController extends BaseController {
	public function getIndex(){
		$data = Input::all();
			
		   	// $rules = array(
		   	// 'sike' => 'required',
      //      	'num' => 'required',
      //  		);
		   	// $renews = [
      //   	'sike.required'=>'写入从第几个开始',
      //   	'num.required'=>'需要多少篇',       
      //   	];
        	//parent::validator($data, $rules,$renews);
        	$rs=WzService::getInstance()->newwz(1,2);

		return view('cq.index');
	}
	public function getJpusha(){	
		 $data = Input::all();
		 $rules = array(
		    	'alias'=>'required',
            	'content'=>'required',
            	'app_key' => 'required',
        	);
		    	$renews = [
         	'alias.required'=>'alias必传',
         	'content.required'=>'没内容调用什么接口', 
         	'app_key.required' => 'app_key你知道是什么不',        	    
         	];
         parent::validator($data, $rules,$renews);
		//$alias=array("堆图家");
		//$content="你是，SB";
		//$app_key='0b457b7ce996c2f0e1654b27';
		$masrter_secret='c3e132e459b68e7de26582af';
		$client = new JpushClient($app_key,$masrter_secret);
		$result = $client->push()
				->setPlatform(M\platform('ios','android'))
				->setAudience(M\audience(
					M\alias($alias)
					))
				->setNotification(M\notification($content))
				->send();

				echo "push success".'<br>';
				echo 'sendno:'.$result->sendno.'<br>';
				echo "msg_id:".$result->msg_id.'<br>';
				echo 'response json'.$result->json.'<br>';

	}
	public function iospush(){
		// 这里是我们上面得到的deviceToken，直接复制过来（记得去掉空格）
		$deviceToken = '740f4707bebcf74f 9b7c25d4 8e3358945f6aa01da5ddb387462c7eaf 61bb78ad';

		// Put your private key's passphrase here 把你的私钥的密码在这里:
		$passphrase = 'abc123456';

		// Put your alert message here 把你的警告信息放在这里:
		$message = 'My first push test!';

		////////////////////////////////////////////////////////////////////////////////

		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

		// Open a connection to the APNS server 打开到APNS服务器连接
		//这个为正是的发布地址
		 //$fp = stream_socket_client(“ssl://gateway.push.apple.com:2195“, $err, $errstr, 60, //STREAM_CLIENT_CONNECT, $ctx);
		//这个是沙盒测试地址，发布到appstore后记得修改哦
		$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		//此处有两个服务器需要选择，如果是开发测试用，选择第二名sandbox的服务器并使用Dev的pem证书，如果是正是发布，使用Product的pem并选用正式的服务器
		// $fp = stream_socket_client("ssl://gateway.push.apple.com:2195", $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
		// $fp = stream_socket_client("ssl://gateway.sandbox.push.apple.com:2195", $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

		
		if (!$fp)
		exit("Failed to connect: $err $errstr" . PHP_EOL);

		echo 'Connected to APNS' . PHP_EOL;

		// Create the payload body
		$body['aps'] = array(
		'alert' => $message,
		'sound' => 'default'
		);

		// Encode the payload as JSON
		$payload = json_encode($body);

		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));

		if (!$result)
		echo 'Message not delivered' . PHP_EOL;
		else
		echo 'Message successfully delivered' . PHP_EOL;

		// Close the connection to the server
		fclose($fp);
	}
}