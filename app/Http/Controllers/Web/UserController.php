<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use App\Services\UserService;
use App\Lib\SmsYun;
use DB;


class UserController extends CmController{

	public $uid;

	public function __construct(){
		parent::__construct();
		$getdata = fparam(Input::all());
		// if(empty($this->user_id)) die('you must login to see more!');
		// 查询留言信息
		
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
		
		/*if(!empty($getdata['oid']) && !empty($this->user_id) && $getdata['oid']!=$this->user_id){
			$this->self_info['message'] = DB::table('messages')->where('from_id',$this->user_id)->where('to_id',$getdata['oid'])->get();
			$this->user_info['message'] = DB::table('messages')->where('to_id',$this->user_id)->where('from_id',$getdata['oid'])->get();
		}*/

		if(isset($this->user_info) && !empty($this->user_info)){
			$this->user_info['count'] = UserWebsupply::get_count(['praise_count','folder_count','follow_count','fans_count','pub_count'],$this->other_id);
		}
	}

	//查询自己的信息 文件夹首页
	public function getIndex(){
		$folders = $this->postFolders(0);
		$folders_private = $this->postFolders(1);
		// dd($folders_private);
		$data = [
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'folders'=>$folders['data']['list'],
			'folders_private'=>$folders_private['data']['list'],
			'type'=>1,
			'user_id'=>$this->other_id,
			'self_id'=>$this->user_id
		];
		//第二页 'user_id'=>$data['user_info']['id'], 
		$da=DB::table('goods')->where('detail_url', '!=' , '')->Where(array('kind'=>'2','user_id'=>$data['user_info']['id']))->select('detail_url')->first();
	
		if($da){
			$data['user_info']['vr']=$da;
		}else{
			$data['user_info']['vr']=0;
		}
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
			'user_follow_folder'=>$user_follow_folder['data']['list'],
			'self_id'=>$this->user_id
		];
		return view('web.user.follow_folder',$data);
	}

	//设置用户的账号
	public function getSetaccount(){
		$data = [
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'user_id'=>$this->other_id,
			'self_id'=>$this->user_id,
		];
		// dd($this->self_info);
		return view('web.user.setaccount',$data);
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
	//修改用户个人信息
	public function postEinfo(){
		$data = Input::all();
		$data = fparam($data);
		if(isset($data['/webd/user/einfo'])) unset($data['/webd/user/einfo']);
        $rules = array(
            'user_id' => 'required',
        );

        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');
		unset($data['user_id']);
		$res = DB::table('users')->where('id',$user['id'])->update($data);
		// dd($res);
		if($res){
			return response()->forApi(['status'=>1]);
		}else{
			return response()->forApi([],1001,'您没有修改信息');
		}
	}

	//修改用户个人密码
	public function postEpwd(){
		$data = Input::all();
		$data = fparam($data);
        $rules = array(
            'user_id' => 'required',
            'password'=>'required',
            'repassword'=>'required'
        );

        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');
		if(trim($data['password']) == '' || trim($data['repassword']) == '') return response()->forApi([],1001,'密码不能为空');
		if(trim($data['password'])!=trim($data['password'])) return response()->forApi([],1001,'密码不一致');
		$password = password_hash($data['password'], PASSWORD_BCRYPT);
		$res = DB::table('users')->where('id',$user['id'])->update(['password'=>$password]);
		// dd($res);
		if($res){
			return response()->forApi(['status'=>1]);
		}else{
			return response()->forApi([],1001,'您没有修改信息');
		}
	}

	//修改用户手机
	public function postEphone(){
		$data = Input::all();
        $rules = array (
        	'user_id' => 'required',
            'mobile' => 'required|max:255|unique:users',
            'captcha' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        parent::validateMobile($data['mobile']);
        $mobile = $data['mobile'];
        $Sms = new SmsYun();
        $rs = $Sms->checkVerificationCode($data['mobile'],$data['captcha'],1);
        if ($data['captcha']!='123456' && !$rs) {
            return response()->forApi(array(), 1001, '验证码错误');
        }
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');
       	$res = DB::table('users')->where('id',$user['id'])->update(['mobile'=>$mobile]);
        if($res) {
            return response()->forApi(['status'=> 1]);
        }else{
        	return response()->forApi(array(), 1001, '修改失败');
        }
        
	}
	//修改用户头像
	 public function postAvatar(){

        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
            'fhead' => 'required|image'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');
        $userId = $user['id'];

        $file = array('image' => Input::file('fhead'));
        // setting up rules
        $rules = array('image' => 'required|mimes:jpeg,png',); //mimes:jpeg,bmp,png and for max size max:10000

        // doing the validation, passing post data, rules and the messages
        parent::validator($file, $rules);

        /*//8M大小验证
        foreach ($_FILES['fhead']['size'] as $key => $value) {
            if($value>8388608) return response()->forApi(array(), 1001, '图片大小大于8M');
        }*/
        $images = UserService::getInstance()->uploadAvatar($userId, $_FILES['fhead']);
        if (!empty($images)) {
            return response()->forApi($images);
        } else {
            // sending back with error message.
            return response()->forApi(array(), 1001, 'uploaded file is not valid');
        }
    }
	
}