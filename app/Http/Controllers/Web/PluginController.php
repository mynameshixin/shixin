<?php 
namespace App\Http\Controllers\Web;


use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Websupply\UserWebsupply;
use App\Lib\UserReg as Registrar;
use DB;
use Input;
use Cache;

class PluginController extends CmController {

	public function getIndex(){
		$callback = isset($_GET['callback'])?$_GET['callback']:'';
		if(!empty($_COOKIE['user_id']) && self::get_user_cache($_COOKIE['user_id'])) {
            $r = response()->forApi(['user_id'=>$_COOKIE['user_id']],200,'已登录');
            die($callback.'('.json_encode($r).')');
        }  
		$r = response()->forApi(['status'=>0],1001,'未登陆');
		die($callback.'('.json_encode($r).')');
	}


}