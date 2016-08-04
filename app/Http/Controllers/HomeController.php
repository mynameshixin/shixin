<?php namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Web\CmController;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Lib\LibUtil;
use DB;
class HomeController extends CmController {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/




	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = DB::table('users')->select('id','username','nick','auth_avatar','role')->whereIn('id',[6,5,181,182,183])->get();
		foreach ($user as $key => $value) {
			$user[$key]['pic_m'] = LibUtil::getUserAvatar($value['id'], 1);
			if(empty($user[$key]['pic_m']) && empty($user[$key]['auth_avatar'])){
	            $user[$key]['pic_m'] = url('uploads/sundry/blogo.jpg');
	        }
	        $user[$key]['fans_count'] =  DB::table('user_follow')->where('userid_follow',$value['id'])->count();
		}
		// dd($user);
		$recommend = FolderWebsupply::get_recommend(15,0,0,1);
		// dd($recommend);
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user_info'=>!empty($user_info)?$user_info:[],
			'user'=>$user,
			'recommend'=>$recommend,
			'title'=>'堆图家，链接全球家居资源(家居、室内设计、商品、美图、VR)'
		];
		return view('index',$data);

	}

}
