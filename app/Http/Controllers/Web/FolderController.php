<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use DB;

class FolderController extends CmController{

	public function __construct(){

		parent::__construct();
		$getdata = fparam(Input::all());
		
		$this->other_id = !empty($getdata['oid'])?$getdata['oid']:$this->user_id;
		$this->folder_id = !empty($getdata['fid'])?$getdata['fid']:0;
		if(empty($this->folder_id)) die('no access!');

		if(!empty($this->other_id)){
			$this->user_info = UserWebsupply::user_info($this->other_id);
			$this->self_info = UserWebsupply::user_info($this->user_id);
		}

		if(isset($this->user_info) && !empty($this->user_info)){
			$this->user_info['count'] = UserWebsupply::get_count(['praise_count','folder_count','follow_count','fans_count','pub_count'],$this->other_id);
		}
	}

	//查询文件夹对应的文件
	public function getIndex(){
		$folder = $this->postFolders();
		// dd($folder);
		$data = [
			'folder'=>$folder['data']['list'],
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'user_id'=>$this->other_id,
			'type'=>1,
			'self_id'=>$this->user_id
		];
		return view('web.folder.index',$data);

	}


	//查询文件夹被谁关注
	public function getFans(){
		$folder = $this->postFans();
		$data = [
			'folder'=>$folder['data']['list'],
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'user_id'=>$this->other_id,
			'type'=>2,
			'self_id'=>$this->user_id
		];
		return view('web.folder.fans',$data);

	}


	public function postFolders(){
		$data = Input::all();
		$data = fparam($data);
        $data['num'] = isset($data['num']) ? $data['num'] : 15;
        $data['page'] = isset($data['page'])?$data['page']:1;
		$rs = FolderWebsupply::get_folder_file($this->folder_id,$this->other_id,$this->user_id,$data);
		$list['list'] = $rs;
		return response()->forApi($list);
	}

	public function postFans(){
		$data = Input::all();
		$data = fparam($data);
        $data['num'] = isset($data['num']) ? $data['num'] : 15;
        $data['page'] = isset($data['page'])?$data['page']:1;
		$rs = FolderWebsupply::get_folder_fans($this->folder_id,$this->other_id,$this->user_id,$data);
		$list['list'] = $rs;
		return response()->forApi($list);
	}



}