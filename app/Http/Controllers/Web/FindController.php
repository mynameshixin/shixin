<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use App\Websupply\CommentWebsupply;
use App\Websupply\CateWebsupply;
use App\Lib\LibUtil;
use DB;

class FindController extends CmController{

	public function getIndex(){
		$user_id = $this->user_id;
		// 堆图达人
		$user = DB::table('users')->select('id','username','nick','auth_avatar','role')->whereIn('id',[6,5,12,11,7])->orderByRaw(DB::raw("FIELD(id, 6,5,12,11,7)"))->get();
		foreach ($user as $key => $value) {
			$id  = $value['id'];
			$user[$key]['pic_m'] = LibUtil::getUserAvatar($value['id'], 1);
			if(empty($user[$key]['pic_m']) && empty($user[$key]['auth_avatar'])){
	            $user[$key]['pic_m'] = url('uploads/sundry/blogo.jpg');
	        }
	        $user[$key]['fans_count'] =  DB::table('user_follow')->where('userid_follow',$value['id'])->count();
	        $user[$key]['follow_count'] =  DB::table('user_follow')->where('user_id',$value['id'])->count();

	        $follow = DB::table('user_follow')->where(['userid_follow'=>$id,'user_id'=>$user_id])->first();
    		$fans = DB::table('user_follow')->where(['user_id'=>$id,'userid_follow'=>$user_id])->first();
    		//$relation 1 相互关注 2 已关注 3被关注 4未关注
    		$relation = 4;
    		if($follow && $fans){
    			$relation = 1;
    		}elseif($follow && !$fans){
    			$relation = 2;
    		}elseif(!$follow && $fans){
    			$relation = 3;
    		}else{
    			$relation = 4;
    		}
    		$user[$key]['relation'] = $relation;
    		$user[$key]['folders'] = FolderWebsupply::get_user_folder($value['id'],4,0);
		}
		// dd($user);
		//精品文件夹
		$recommend = FolderWebsupply::get_recommend(5,0,['group'=>'user_id'],1,1);
		foreach ($recommend as $key => $value) {
			$collection_folder = DB::table('collection_folder')->where(['user_id'=>$user_id,'folder_id'=>$value['id']])->first();
			$recommend[$key]['is_collection'] = !empty($collection_folder)?1:0;
		}
		// dd($recommend);
		//人气商品
		$goods = $this->postGoods();

		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user'=>$user,
			'recommend'=>$recommend,
			'goods'=>$goods['data']['list']
		];

		return view('web.find.index',$data);
	}

	//获取商品或图集或自己的文件
	public function postGoods(){
		$data = Input::all();
		$data = fparam($data);
        $num = isset($data['num']) ? $data['num'] : 15;
        $page = isset($data['page'])?$data['page']:1;
    	$goods = [];
        $goods = array_merge($goods,$this->pregoods(6,$page));
        $goods = array_merge($goods,$this->pregoods(5,$page));
        $goods = array_merge($goods,$this->pregoods(12,$page));
        $goods = array_merge($goods,$this->pregoods(11,$page));
        $goods = array_merge($goods,$this->pregoods(7,$page));
        
        foreach ($goods as $key => $value) {
        	$cuser = DB::table('collection_good')->where('good_id',$value['id'])->select('user_id','folder_id')->orderBy('created_at','desc')->first();
            if(empty($cuser)){
                $cuser = DB::table('goods')->where('id',$value['id'])->select('user_id','folder_id')->first();
            }
        	$cfolder = DB::table('folders')->where('id',$cuser['folder_id'])->select('name','id')->first();
        	$goods[$key]['cfolder'] = !empty($cfolder)?$cfolder:[];
        	$goods[$key]['cuser'] = UserWebsupply::user_info($cuser['user_id']);
        	$goods[$key]['comment'] = CommentWebsupply::getCommentFirst($value['id']);
        	if(strpos($value['image_ids'],',') == 0){
                $goods[$key]['image_url'] = !empty(LibUtil::getPicUrl($value['image_ids'], 1))?LibUtil::getPicUrl($value['image_ids'], 1):url('uploads/sundry/blogo.jpg');
            }else{
                $goods[$key]['image_url'] = url('uploads/sundry/blogo.jpg');
            }
        }
        // dd($goods);
        $list = [];
        $list['list'] = $goods;
        return response()->forApi($list);
	}

	public function pregoods($user_id,$page){
		$skip = ($page-1)*3;
		$goods = DB::table('folder_goods as fg')->join('goods as g','g.id','=','fg.good_id')->select('g.id', 'g.user_id', 'g.folder_id', 'g.kind', 'g.price', 'g.reserve_price', 'g.image_ids', 'g.title', 'g.tags',  'g.description', 'g.collection_count', 'g.praise_count', 'g.boo_count', 'g.detail_url', 'g.created_at')->orderBy('g.created_at','desc')->where(['fg.user_id'=>$user_id,'g.kind'=>1]);
		$goods = $goods->skip($skip)->take(3)->get();
		return $goods;
	}

}