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
		if(empty($this->user_id)) die('you must login to see more!');
		if(isset($getdata['oid']) && !empty($getdata['oid'])){
			$this->other_id = $getdata['oid'];
		}else{
			$this->other_id = $this->user_id;
		}

		if(!empty($this->other_id)){
			$relation = 4;
			if($this->other_id == $this->user_id){
				$relation = 4;
			}else{
				$follow = DB::table('user_follow')->where(['userid_follow'=>$this->other_id,'user_id'=>$this->user_id])->first();
    			$fans = DB::table('user_follow')->where(['user_id'=>$this->other_id,'userid_follow'=>$this->user_id])->first();
    			if($follow && $fans){
    				$relation = 1;
	    		}elseif($follow && !$fans){
	    			$relation = 2;
	    		}elseif(!$follow && $fans){
	    			$relation = 3;
	    		}else{
	    			$relation = 4;
	    		}
			}
			

			$this->user_info = UserWebsupply::user_info($this->other_id);
			$this->user_info['t_relation'] = $relation;
			$this->self_info = UserWebsupply::user_info($this->user_id);
		}
		

		if(isset($this->user_info) && !empty($this->user_info)){
			$this->user_info['count'] = UserWebsupply::get_count(['praise_count','folder_count','follow_count','fans_count','pub_count'],$this->other_id);
		}
	}

	//查询自己的信息 文件夹首页
	public function getIndex(){
		$folders = $this->postFolders(0);
		// dd($this->user_info);
		$folders_private = $this->postFolders(1);
		$data = [
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'folders'=>$folders['data']['list'],
			'folders_private'=>$folders_private['data']['list'],
			'type'=>1,
			'user_id'=>$this->other_id,
			'self_id'=>$this->user_id
		];
		return view('web.user.index',$data);

	}

	//获取用户喜欢的数据
	public function getPraise(){
		$user_like = $this->postGoods(1);
		// dd($user_like);
		$data = [
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'type'=>2,
			'user_like'=>$user_like['data']['list'],
			'user_id'=>$this->other_id,
			'self_id'=>$this->user_id
		];
		return view('web.user.praise',$data);
	}

	//获取用户发布的数据
	public function getPub(){
		$user_like = $this->postGoods(2);
		// dd($user_like);
		$data = [
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'type'=>3,
			'user_like'=>$user_like['data']['list'],
			'user_id'=>$this->other_id,
			'self_id'=>$this->user_id
		];
		return view('web.user.pub',$data);
	}

	//用户粉丝
	public function getFans(){
		$user_fans = $this->postFanfollow(1);
		// dd($user_fans);
		$data = [
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'type'=>4,
			'user_id'=>$this->other_id,
			'self_id'=>$this->user_id,
			'user_fans'=>$user_fans['data']['list']
		];
		return view('web.user.fans',$data);
	}



	// 用户关注的人
	public function getFollow(){
		$user_follow = $this->postFanfollow(2);
		// dd($user_follow);
		$data = [
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'type'=>5,
			'user_id'=>$this->other_id,
			'self_id'=>$this->user_id,
			'user_follow'=>$user_follow['data']['list']
		];
		return view('web.user.follow',$data);
	}

	// 用户关注的文件夹
	public function getFollowfolder(){
		$user_follow_folder = $this->postFollowfolder();
		// dd($user_follow_folder);
		$data = [
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'type'=>5,
			'user_id'=>$this->other_id,
			'self_id'=>$this->user_id,
			'user_follow_folder'=>$user_follow_folder['data']['list'],
			'self_id'=>$this->user_id
		];
		return view('web.user.follow_folder',$data);
	}

	//ajax 传送的数据
	public function postGoods($kind = 1){
		$data = Input::all();
		$data = fparam($data);
        $data['kind'] = isset($data['kind'])?$data['kind']:$kind;
        $num = isset($data['num']) ? $data['num'] : 10;
        $data['page'] = isset($data['page'])?$data['page']:1;
        $rs = UserWebsupply::get_user_lp($this->other_id,$num,$data);
        $list['list'] = $rs;
        return response()->forApi($list);
	}

	public function postFolders($private = 0){
		$data = Input::all();
		$data = fparam($data);
        $num = isset($data['num']) ? $data['num'] : 10;
        $data['page'] = isset($data['page'])?$data['page']:1;
        $data['private'] = isset($data['private'])?$data['private']:$private;
        $rs = FolderWebsupply::get_user_index_folder($this->other_id,$num,3,$data,$this->user_id);
        $list['list'] = $rs;
        return response()->forApi($list);
	}

	public function postFanfollow($kind = 1){
		$data = Input::all();
		$data = fparam($data);
        $data['kind'] = isset($data['kind'])?$data['kind']:$kind;
        $num = isset($data['num']) ? $data['num'] : 15;
        $data['page'] = isset($data['page'])?$data['page']:1;
        $rs = UserWebsupply::get_user_fansfollow($this->other_id,$num,$data,$this->user_id);
        $list['list'] = $rs;
        return response()->forApi($list);
	}

	public function postFollowfolder(){
		$data = Input::all();
		$data = fparam($data);
        $num = isset($data['num']) ? $data['num'] : 15;
        $data['page'] = isset($data['page'])?$data['page']:1;
        $rs = UserWebsupply::get_follow_folder($this->other_id,$data,$this->user_id);
        $list['list'] = $rs;
        return response()->forApi($list);
	}

	public function postRelation(){
		$data = Input::all();
		$self_id = isset($data['self_id']) ? $data['self_id'] : 0;
        $folder_id = isset($data['folder_id']) ? $data['folder_id'] : 0;
        $user_id = isset($data['user_id']) ? $data['user_id'] : 0;
        $content = isset($data['content']) ? $data['content'] : 0;
        
        $rs = UserWebsupply::get_relation($self_id,$folder_id,$user_id,$content);
        $list['list'] = $rs;
        return response()->forApi($list);
	}
}