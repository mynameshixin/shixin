<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Cache;
use DB;

class HomeController extends CmController{

	public function index(){
		// Cache::store('redis')->put('bar', json_encode($cachedata), 1);
		$user_id = !empty(session('user_id'))?session('user_id'):0;
		return view('web.home.index');
	}



















}