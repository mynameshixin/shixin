<?php

namespace App\Http\Controllers\Webadmin;

use App\Http\Controllers\Webadmin\CmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use DB;

class WebadminController extends CmController{

	public function index(){
		if(session('uname') && session('pwd')) return redirect('webadmin/home');
		return view('webadmin.index.index');
	}

	public function store(){
		$data = input::all();
		$data = fparam($data);
		$rules = [
			'logname'=>'required|exists:users,username',
			'logpass'=>'required|max:20'
		];

		parent::validator($data,$rules);
		$res = DB::table('users')->where(['username'=>$data['logname']])->first();
		$pwd = $res['password'];
		if(crypt($data['logpass'],$pwd) != $pwd){
			return response(['code'=>'1001','message'=>'密码不正确！']);
		}

		session(['uname'=>$data['logname']]);
		session(['pwd'=>$data['logpass']]);

		return response(['code'=>'200','message'=>'登陆成功!']);
	}
}
