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

		if(!empty($_COOKIE['user_id']) && self::get_user_cache($_COOKIE['user_id'])) {
            return response()->forApi(['status'=>1],200,'已登录');
        }  
		return response()->forApi(['status'=>0],1001,'未登陆');
	}


}