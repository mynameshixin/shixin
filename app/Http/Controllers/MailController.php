<?php 
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use DB;
class MailController extends Controller {
	//发送邮件
		public function send()
			{
		$name = '学院君';

		$flag = Mail::send('emails.test',['name'=>$name],function($message){

			$to =array('583566032@qq.com','317010701@qq.com');

			$message ->to($to)->subject('堆图家');

		});
			
		// Mail::send('这是一封测试邮件', function ($message) {
  //  		$to = '31701070@qq.com';
  //   	$message ->to($to)->subject('测试邮件');
		// });
		if($flag){			
			echo '发送邮件成功，请查收！';
		}else{
			echo '发送邮件失败，请重试！';
		}
	}
	//发送邮件所用视图显示
	public function test(){	
		$a=DB::table('users')->where('email','<>','')->select('email')->get();
		//dump($a);
		// utf-8编码
		$EncodeStr=base64_encode("死哦啊活动");


		echo $EncodeStr;
		echo "<a href=http://la.com/mail/testt?name=$EncodeStr>我的名字</a>";
		//urlencode结果:
		//echo urlencode($url);
		
		//link_urldecode结果:
		 //echo $url;
		
		// //link_urldecode函数:
		
		return View ('emails.test');
	}
	public function testt(){	
		dump($_GET);
		dump (base64_decode($_GET['name']));
		return View ('emails.test');
	}
	// public function link_urldecode($url) {
	// 	   $uri = '';
	// 	   $cs = unpack('C*', $url);
	// 	   $len = count($cs);
	// 	   for ($i=1; $i<=$len; $i++) {
	// 	     $uri .= $cs[$i] > 127 ? '%'.strtoupper(dechex($cs[$i])) : $url{$i-1};
	// 	   }
	// 	   return $uri;
	// 	 }
}
