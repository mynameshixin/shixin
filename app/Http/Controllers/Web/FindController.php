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
		$user_id = $this->user_id;
		$cate = CateWebsupply::getRecommend(11);
		$cate_all = CateWebsupply::getTree(6);
		// dd($cate_all);

		$recommend = FolderWebsupply::get_recommend(5,3);
		foreach ($recommend as $key => $value) {
			$recommend[$key]['user'] = UserWebsupply::user_info($value['user_id']);
			$collection_folder = DB::table('collection_folder')->where(['user_id'=>$user_id,'folder_id'=>$value['id']])->first();
			$recommend[$key]['is_collection'] = $collection_folder;
		}

		$data = [
			'self_id'=>$this->user_id,
			'cate'=>$cate,
			'self_info'=>$this->self_info,
			'cate_all'=>$cate_all,
			'recommend'=>$recommend
		];

		return view('web.find.index',$data);
	}




}