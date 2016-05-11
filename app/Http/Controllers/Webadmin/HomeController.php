<?php


namespace App\Http\Controllers\Webadmin;

use App\Http\Controllers\Webadmin\CmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use DB;

class HomeController extends CmController{

	public function getIndex(){
		return view('webadmin.home.index');
	}


	public function getDestorysession(){
		session(['uname'=>null]);
		return redirect('webadmin');
	}
















}