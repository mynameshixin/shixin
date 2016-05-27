<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use DB;


class UserController extends CmController{

	public $uid;

	public function __construct(){
		parent::__construct();
		$getdata = fparam(Input::all());
		if(empty($this->user_id)) die('no access!');
		if(isset($getdata['oid']) && !empty($getdata['oid'])){
			$this->other_id = $getdata['oid'];
		}else{
			$this->other_id = $this->user_id;
		}
	}

	//查询自己的信息 文件夹首页
	public function getIndex(){

		if(!empty($this->other_id)) $user_info = UserWebsupply::user_info($this->other_id);
		if(isset($user_info) && !empty($user_info)){
			$user_info['count'] = UserWebsupply::get_count(['praise_count','folder_count','follow_count','fans_count','pub_count'],$this->other_id);
			$folders = FolderWebsupply::get_user_folder($this->other_id,'all',3);
			/*foreach ($folders as $key => $value) {
				$collection_folder = DB::table('collection_folder')->where(['user_id'=>$user_id,'folder_id'=>$value['id']])->first();
				$folders[$key]['is_collection'] = $collection_folder;
			}*/
		}
		// dd($folders);
		$data = [
			'user_info'=>$user_info,
			'folders'=>$folders,
			'type'=>1,
			'user_id'=>$this->other_id
		];
		return view('web.user.index',$data);

	}

	//获取用户喜欢的数据
	public function getPraise(){
		if(!empty($this->other_id)) $user_info = UserWebsupply::user_info($this->other_id);
		if(isset($user_info) && !empty($user_info)){
			$user_info['count'] = UserWebsupply::get_count(['praise_count','folder_count','follow_count','fans_count','pub_count'],$this->other_id);
		}
		$user_like = $this->postGoods();
		// dd($user_like);
		$data = [
			'user_info'=>$user_info,
			'type'=>2,
			'user_like'=>$user_like['data']['list'],
			'user_id'=>$this->other_id
		];
		return view('web.user.praise',$data);
	}

	//获取用户发布的数据
	public function getPub(){
		if(!empty($this->other_id)) $user_info = UserWebsupply::user_info($this->other_id);
		if(isset($user_info) && !empty($user_info)){
			$user_info['count'] = UserWebsupply::get_count(['praise_count','folder_count','follow_count','fans_count','pub_count'],$this->other_id);
		}
		$user_like = $this->postGoods(2);
		// dd($user_like);
		$data = [
			'user_info'=>$user_info,
			'type'=>3,
			'user_like'=>$user_like['data']['list'],
			'user_id'=>$this->other_id
		];
		return view('web.user.praise',$data);
	}


	public function postGoods($kind = 1){
		$data = Input::all();
		$data = fparam($data);
        $data['kind'] = isset($data['kind'])?$data['kind']:$kind;
        $num = isset($data['num']) ? $data['num'] : 10;
        $data['page'] = isset($data['page'])?$data['page']:1;
        $rs = UserWebsupply::get_user_lp($this->other_id,$num,$data);
        return response()->forApi($rs);
	}

	//用户粉丝
	public function getFans(){
		if(!empty($this->other_id)) $user_info = UserWebsupply::user_info($this->other_id);
		if(isset($user_info) && !empty($user_info)){
			$user_info['count'] = UserWebsupply::get_count(['praise_count','folder_count','follow_count','fans_count','pub_count'],$this->other_id);
		}
		$user_fans = UserWebsupply::get_user_fans($this->other_id);
		
		// dd($user_fans);
		$data = [
			'user_info'=>$user_info,
			'type'=>4,
			'user_id'=>$this->other_id,
			'user_fans'=>$user_fans
		];
		return view('web.user.fans',$data);
	}



	// 用户关注的人
	public function getFollow(){
		if(!empty($this->other_id)) $user_info = UserWebsupply::user_info($this->other_id);

		if(isset($user_info) && !empty($user_info)){
			$user_info['count'] = UserWebsupply::get_count(['praise_count','folder_count','follow_count','fans_count','pub_count'],$this->other_id);
		}
		$user_follow = UserWebsupply::get_user_follow($this->other_id);
		// dd($user_follow);
		$data = [
			'user_info'=>$user_info,
			'type'=>5,
			'user_id'=>$this->other_id,
			'user_follow'=>$user_follow
		];
		return view('web.user.follow',$data);
	}

	// 用户关注的文件夹
	public function getFollowfolder(){
		if(!empty($this->other_id)) $user_info = UserWebsupply::user_info($this->other_id);

		if(isset($user_info) && !empty($user_info)){
			$user_info['count'] = UserWebsupply::get_count(['praise_count','folder_count','follow_count','fans_count','pub_count'],$this->other_id);
		}
		$user_follow_folder = UserWebsupply::get_follow_folder($this->other_id);
		$data = [
			'user_info'=>$user_info,
			'type'=>5,
			'user_id'=>$this->other_id,
			'user_follow_folder'=>$user_follow_folder
		];
		return view('web.user.follow_folder',$data);
	}

}