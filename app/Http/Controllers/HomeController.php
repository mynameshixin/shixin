<?php namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Web\CmController;

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
//		$user = Auth::user();
//		if ($user) {
//			$user = Auth::user();
//			if ($user->hasRole('administrator') || $user->hasRole('super_administrator')) {
//				return Redirect::to('/admin');
//			}else{
//				return view('index');
//			}
//
//		}
		
		$data = [
			'user_id' => $this->user_id
		];
		return view('index',$data);

	}

}
