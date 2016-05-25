<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use DB;


class PicsController extends CmController{


	public function getIndex(){
		
		$user_id = $this->user_id; 

		$goods = $this->postGoods();
		$data = [
			'user_id'=>$user_id,
			'goods'=>$goods['data']['list'],
		];
		// dd($data);
		return view('web.pics.index',$data);

	}

	//获取瀑布流数据
	public function postGoods(){
		
		$data = Input::all();
		$data = fparam($data);
        $data['kind'] = 2 ;
        
        $num = isset($data['num']) ? $data['num'] : 10;
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
        //$rs = ProductService::getInstance()->getProductsByFids ($folder_ids,$user_ids,$data,$num,$user_id);
        return response()->forApi($rs);


	}

	public function getSet(){
		self::crypt_cookie('user_id',486);
	}






}