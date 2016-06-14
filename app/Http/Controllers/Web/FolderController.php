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

		$this->folder_id = !empty($getdata['fid'])?$getdata['fid']:0;
		if(empty($this->folder_id)) die('no access!');
	}

	//查询文件夹对应的文件
	public function getIndex(){
		$folder = $this->postFolders(1);
		if(empty($folder['data']['list'])) die('private folder no access!');
		// dd($folder);
		$data = [
			'folder'=>$folder['data']['list'],
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'user_id'=>$folder['data']['list']['user_id'],
			'type'=>1,
			'self_id'=>$this->user_id
		];
		return view('web.folder.index',$data);

	}


	//查询文件夹被谁关注
	public function getFans(){
		$folder = $this->postFolders(2);
		$user_fans = $this->postFans();
		// dd($user_fans);
		$data = [
			'folder'=>$folder['data']['list'],
			'user_fans'=>$user_fans['data']['list'],
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'user_id'=>$folder['data']['list']['user_id'],
			'type'=>2,
			'self_id'=>$this->user_id
		];
		return view('web.folder.fans',$data);

	}


	public function postFolders($kind = 1){
		$data = Input::all();
		$data = fparam($data);
		$data['kind'] = isset($data['kind']) ? $data['kind'] : $kind;
        $data['num'] = isset($data['num']) ? $data['num'] : 15;
        $data['page'] = isset($data['page'])?$data['page']:1;
		$rs = FolderWebsupply::get_folder_file($this->folder_id,$this->user_id,$data);
		$list['list'] = $rs;
		return response()->forApi($list);
	}

	public function postFans(){
		$data = Input::all();
		$data = fparam($data);
        $data['num'] = isset($data['num']) ? $data['num'] : 15;
        $data['page'] = isset($data['page'])?$data['page']:1;
		$rs = FolderWebsupply::get_folder_fans($this->folder_id,$this->user_id,$data);
		$list['list'] = $rs;
		return response()->forApi($list);
	}



}