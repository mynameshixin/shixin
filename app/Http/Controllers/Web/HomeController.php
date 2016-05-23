<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Services\ProductService;
use App\Services\UserService;
use App\Services\FolderService;
use App\Models\Folder;
use App\Models\Follow;
use Cache;
use DB;

class HomeController extends CmController{
	// Cache::store('redis')->put('bar', json_encode($cachedata), 1);
	public function getIndex(){

		$user_id = !empty(session('user_id'))?session('user_id'):0;
		$data = [
			'user_id'=>$user_id
		];
		return view('web.home.index',$data);
	}

	public function postGoods(){
		
		$data = Input::all();
		$data = fparam($data);
        $rules = array(
            'kind' => 'in:1,2',
        );
        $data['kind'] = isset($data['kind']) ? $data['kind'] : 1 ;
        //请求参数验证
        parent::validator($data, $rules);
        
        $num = isset($data['num']) ? $data['num'] : 10;
        $user_ids = $folder_ids = [];
        $user_id = isset($data['user_id']) && !empty($data['user_id'])?$data['user_id']:0;
        if (isset($user_id) && !empty($user_id)){
            $user_follow =  Follow::where('user_id',$user_id)->lists('userid_follow')->toArray();
            $folder_ids1 = CollectionFolder::where('user_id',$user_id)->lists('folder_id')->toArray();
            $user_ids = $user_follow;
        }
        $adminIds = UserService::getInstance()->getAdminIds();
        $user_ids = array_merge($user_ids,$adminIds);

        if (isset($user_id) && !empty($user_id))    $user_ids[] = $user_id;

        $user_ids = array_unique($user_ids);
        $folder_ids = Folder::whereIn('user_id',$user_ids)->lists('id')->toArray();
        if(isset($folder_ids1) && !empty($folder_ids1)) $folder_ids = array_merge($folder_ids,$folder_ids1);
        $folder_ids = array_unique($folder_ids);
        $rs = ProductService::getInstance()->getProductsByFids ($folder_ids,$user_ids,$data,$num,$user_id);
        return response()->forApi($rs);


	}

















}