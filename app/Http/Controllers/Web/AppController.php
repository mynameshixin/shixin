<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use App\Websupply\CateWebsupply;
use DB;

class AppController extends CmController{

	public function getIndex(){
		$data = [
			'self_info'=>$this->self_info,
		];
		
		return view('web.app.index',$data);
	}




}