<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use App\Websupply\CateWebsupply;
use DB;

class ContactController extends CmController{

	public function getIndex(){
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
		];
		
		return view('web.contact.index',$data);
	}




}