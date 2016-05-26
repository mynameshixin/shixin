<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use App\Websupply\CateWebsupply;
use DB;

class FindController extends CmController{

	public function getIndex(){
		$cate = CateWebsupply::getCate(11);
		$data = [
			'cate'=>$cate
		];

		return view('web.find.index',$data);
	}




}