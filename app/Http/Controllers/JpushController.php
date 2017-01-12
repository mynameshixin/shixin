<?php 
namespace App\Http\Controllers;

use Jpush\Model as M;
use Jpush\JpushClient;
use Jpush\Exception\APIConnectionException;
use Jpush\Exception\APIRequestExcetion;
use DB;
class JpushController extends Controller {
	
	
	public function index(){	
		$alias=array("堆图家");
		$content="你是，SB";
		$app_key='f82bcb1da07da859b3e15761';
		$masrter_secret='d82e4fdeee431e5a5a3f5864';
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
}
