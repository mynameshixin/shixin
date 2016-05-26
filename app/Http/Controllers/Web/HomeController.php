<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use DB;

class HomeController extends CmController{

	// 首页展示
	public function getIndex(){
		$user_id = $this->user_id;
		if(!empty($user_id)) $user_info = UserWebsupply::user_info($user_id);

		if(isset($user_info) && !empty($user_info)){
			$user_info['count'] = UserWebsupply::get_count(['collection_count','folder_count','follow_count'],$user_id);
		}

		$recommend = FolderWebsupply::get_recommend();
		foreach ($recommend as $key => $value) {
			$recommend[$key]['user'] = UserWebsupply::user_info($value['user_id']);
			$collection_folder = DB::table('collection_folder')->where(['user_id'=>$user_id,'folder_id'=>$value['id']])->first();
			$recommend[$key]['is_collection'] = $collection_folder;
		}
		$goods = $this->postGoods();
		$data = [
			'user_id'=>$user_id,
			'goods'=>$goods['data']['list'],
			'user_info'=>!empty($user_info)?$user_info:[],
			'recommend'=>!empty($recommend)?$recommend:[]
		];
		dd($data);
		return view('web.home.index',$data);
	}




	//获取瀑布流数据
	public function postGoods(){
		
		$data = Input::all();
		$data = fparam($data);
        $data['kind'] = 1;
        
        $num = isset($data['num']) ? $data['num'] : 9;
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

















}