<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use Illuminate\Support\Facades\Crypt;
use DB;

class HomeController extends CmController{

	// 首页展示
	public function getIndex(){
		$user_id = $this->user_id;
		if(!empty($user_id)) $user_info = UserWebsupply::user_info($user_id);
		if(isset($user_info) && !empty($user_info)){
			$user_info['count'] = UserWebsupply::get_count(['collection_count','folder_count','fans_count'],$user_id);
		}

		$recommend = FolderWebsupply::get_recommend(3,0,['group'=>'user_id']);
		// dd($recommend);
		foreach ($recommend as $key => $value) {
			$recommend[$key]['user'] = UserWebsupply::user_info($value['user_id']);
			$collection_folder = DB::table('collection_folder')->where(['user_id'=>$user_id,'folder_id'=>$value['id']])->first();
			$recommend[$key]['is_collection'] = $collection_folder;
		}
		$goods = $this->postGoods();
		// dd($goods);
		$data = [
			'self_id'=>$user_id,
			'self_info'=>$this->self_info,
			'goods'=>$goods['data']['list'],
			'user_info'=>!empty($user_info)?$user_info:[],
			'recommend'=>!empty($recommend)?$recommend:[]
		];
		return view('web.home.index',$data);
	}




	//获取瀑布流数据
	public function postGoods(){
		
		$data = Input::all();
		$data = fparam($data);
        $data['kind'] = 1;
        
        $num = isset($data['num']) ? $data['num'] : 15;
        $data['page'] = isset($data['page'])?$data['page']:1;
        $user_ids = $folder_ids = [];
        $user_id = $this->user_id;
        if (isset($user_id) && !empty($user_id)){
            $user_follow =  DB::table('user_follow')->where('user_id',$user_id)->lists('userid_follow');
            $folder_ids1 = DB::table('collection_folder')->where('user_id',$user_id)->lists('folder_id');
            $user_ids = $user_follow;
        }
        $adminIds = UserWebsupply::getAdminIds();
        $user_ids = array_merge($user_ids,$adminIds);

        if (isset($user_id) && !empty($user_id))    $user_ids[] = $user_id;

        $user_ids = array_unique($user_ids);
        $folder_ids = DB::table('folders')->whereIn('user_id',$user_ids)->lists('id');
        if(isset($folder_ids1) && !empty($folder_ids1)) $folder_ids = array_merge($folder_ids,$folder_ids1);
        $folder_ids = array_unique($folder_ids);
        $rs = ProductWebsupply::getProductsByFids($folder_ids,$user_ids,$data,$num,$user_id);
        return response()->forApi($rs);


	}

	// 注册先请求api接口后生成浏览器cookie和缓存
	public function postSet(){
		// return json_encode(['status'=>1]);
		$data = Input::all();
		$user_id = isset($data['u'])?$data['u']:'';
		$arr = explode('_',$user_id);
        $id = Crypt::decrypt($arr[1]);
        $id = ($id/100)-50;
        $res = DB::table('users')->where(['id'=>$id])->first();
		if(!empty($id) && is_int($id) && !empty($res)){
			self::crypt_cookie('user_id',$id);
			return json_encode(['status'=>1]);
		}else{
			return json_encode(['status'=>0]);
		}
		
	}

	// 登陆后生成浏览器cookie和缓存
	public function postLogin(){
		$data = fparam(Input::all());
		if(empty($data['account']) || empty($data['password'])){
			return response()->forApi([],1001,'账号或密码不为空');
		}
		$res = DB::table('users')->where(['username'=>$data['account']])->orWhere(['mobile'=>$data['account']])->first();
		if(empty($res)) return response()->forApi([],'1001','没有该账号');
		$pwd = $res['password'];
		if(crypt($data['password'],$pwd) != $pwd){
			return response()->forApi([],'1001','账号或密码不正确');
		}
		self::crypt_cookie('user_id',$res['id']);
		return  response()->forApi([],200,'登陆成功');

	}

	// 退出登陆
	public function getLogout(){
		if(!empty($_COOKIE['user_id'])){
			$user_en_id = $_COOKIE['user_id'];
			self::destory_cookie($user_en_id);
		}
		return redirect('webd/home');

	}












}