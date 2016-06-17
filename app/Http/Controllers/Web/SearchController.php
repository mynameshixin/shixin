<?php
namespace App\Http\Controllers\Web;

use App\Lib\LibUtil;
use App\Models\Folder;
use App\Models\FolderGood;
use App\Models\GoodAction;
use App\Models\Product;
use App\Services\TaoBaoService;
use App\Services\FancyService;
use Illuminate\Support\Facades\Input;
use App\Services\ProductService;
use App\Services\FolderService;
use App\Websupply\ProductWebsupply;
use App\Websupply\UserWebsupply;
use App\Websupply\CommentWebsupply;
use App\Websupply\FolderWebsupply;
use App\Models\Shop;
use DB;

class SearchController extends CmController{

	public function __construct(){
		parent::__construct();
		if(empty(Input::get('keyword'))) die('no keyword');
	}

	//首页或者文件夹页
	public function getIndex(){
		$keyword = trim(Input::get('keyword'));

		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user_info'=>!empty($user_info)?$user_info:[],
			'keyword'=>$keyword,
			'type'=>1
		];
		return view('web.search.index',$data);
	}

	//图片页或图集页面
	public function getGoods(){
		$keyword = trim(Input::get('keyword'));
		$type = trim(Input::get('type'));
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user_info'=>!empty($user_info)?$user_info:[],
			'keyword'=>$keyword,
			'type'=>$type
		];
		return view('web.search.goods',$data);
	}

	//用户页面
	public function getUser(){
		$keyword = trim(Input::get('keyword'));
		$type = trim(Input::get('type'));
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user_info'=>!empty($user_info)?$user_info:[],
			'keyword'=>$keyword,
			'type'=>$type
		];
		return view('web.search.user',$data);
	}

	//我的文件夹页面
	public function getMy(){
		$keyword = trim(Input::get('keyword'));
		$type = trim(Input::get('type'));
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user_info'=>!empty($user_info)?$user_info:[],
			'keyword'=>$keyword,
			'type'=>$type
		];
		return view('web.search.my',$data);
	}

	//获取商品或图集或自己的文件
	public function postGoods(){

		$data = Input::all();
		$data = fparam($data);
		$rules = array(
            'kind' => 'in:1,2',
            'keyword'=>'required'
        );
        // dd($data);

        //请求参数验证
        parent::validator($data, $rules);
        $keyword = $data['keyword'];
        $num = isset($data['num']) ? $data['num'] : 15;
        $page = isset($data['page'])?$data['page']:1;
    	$skip = ($page-1)*$num;
        $goods = DB::table('goods')->select('id', 'user_id', 'folder_id', 'kind', 'price', 'reserve_price', 'image_ids', 'title', 'tags',  'description', 'collection_count', 'praise_count', 'boo_count', 'detail_url', 'created_at')->where(
        	function($query) use ($keyword){
        		$query->where('title', "like", "%{$keyword}%")->orWhere('tags', "like", "%{$keyword}%");
        	})->orderBy('created_at','desc');
        if(isset($data['kind'])) $goods = $goods->where('kind','=',$data['kind']);
        if(isset($data['user_id'])){
        	$user_id = self::get_user_cache($data['user_id']);
        	if(!DB::table('users')->where('id',$user_id)->first()) return response()->forApi([],1001,'用户不存在');
        	$goods = $goods->where('user_id',$user_id);
        }
        $goods = $goods->skip($skip)->take($num)->get();
        foreach ($goods as $key => $value) {
        	$cuser = DB::table('collection_good')->where('good_id',$value['id'])->select('user_id','folder_id')->orderBy('created_at','desc')->first();
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

	// 获得文件夹
	public function postFolder(){
        $data = fparam(Input::all());
        //请求参数验证
        $rules = array(
            'keyword'=>'required'
        );
        parent::validator($data, $rules);
        $num = isset($data['num']) ? $data['num'] : 20;
        $data['private'] = 0;
        $page = isset($data['page'])?$data['page']:1;
    	$skip = ($page-1)*$num;
    	$keyword = $data['keyword'];
		$folders = DB::table('folders')->where('name','like',"%".$keyword."%")->orderBy('folders.updated_at','desc')->skip($skip)->take($num)->get();
		
		foreach ($folders as $i => $value) {
			$imageId = $value['image_id'];
			$img_url = LibUtil::getPicUrl($imageId, 1);
			$folders[$i]['img_url'] = !empty($img_url)?$img_url:url('uploads/sundry/blogo.jpg');
			$id = isset($folders[$i]['id'])?$folders[$i]['id']:0;
			$follow = DB::table('collection_folder')->where(['user_id'=>$this->user_id,'folder_id'=>$id])->first();
			$folders[$i]['is_follow'] = !empty($follow)?1:0;
			//$folders[$i]['count'] = DB::table('goods')->where('folder_id',$id)->count();
			$folders[$i]['user'] = UserWebsupply::user_info($value['user_id']);
	 		$goods = DB::table('goods')->where('folder_id',$id)->select('id','image_ids')->take(3)->get();
	 		if(count($goods) < 3){
                $cg = DB::table('collection_good as cg')->join('goods as g','cg.good_id','=','g.id')->where(['cg.folder_id'=>$id,'cg.user_id'=>$value['user_id']])->select('g.id','g.image_ids')->take(3 - count($goods))->get();
                $goods = $cg+$goods;
        	} 
	 		foreach ($goods as $k => $v) {
	 			if(strpos($v['image_ids'],',') == 0){
	 				$goods[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_ids'], 1))?LibUtil::getPicUrl($v['image_ids'], 1):url('uploads/sundry/blogo.jpg');
	 			}else{
	 				$goods[$k]['image_url'] = url('uploads/sundry/blogo.jpg');
	 			}
	 		}
	 		$folders[$i]['goods'] = $goods;		 	

		}
		// dd($folders);
		$list['list'] = $folders;
        return response()->forApi($list);
    }

    //获取搜索的用户
    public function postUser(){
    	$data = fparam(Input::all());
        //请求参数验证
        $rules = array(
            'keyword'=>'required'
        );
        parent::validator($data, $rules);
        $num = isset($data['num']) ? $data['num'] : 20;
        $page = isset($data['page'])?$data['page']:1;
    	$skip = ($page-1)*$num;
    	$keyword = $data['keyword'];
    	if(!empty($data['user_id'])){
        	$self_id = self::get_user_cache($data['user_id']);
        	if(!DB::table('users')->where('id',$self_id)->first()) return response()->forApi([],1001,'用户不存在');
        }else{
        	$self_id = 0;
        }
    	$user_info = DB::table('users')->where('nick','like',"%".$keyword."%")->orWhere('username','like',"%".$keyword."%")->orWhere('mobile','like',"%".$keyword."%")->select('id','nick','username','auth_avatar','mobile')->skip($skip)->take($num)->get();

    	foreach ($user_info as $key => $value) {
    		$id  = $value['id'];
    		$follow = DB::table('user_follow')->where(['userid_follow'=>$id,'user_id'=>$self_id])->first();
    		$fans = DB::table('user_follow')->where(['user_id'=>$id,'userid_follow'=>$self_id])->first();
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
    		$user_info[$key]['pic_m'] = LibUtil::getUserAvatar($value['id'], 1);
            if(empty($user_info[$key]['pic_m']) && empty($user[$key]['auth_avatar'])){
            	$user_info[$key]['pic_m'] = url('uploads/sundry/blogo.jpg');
            }
    		$user_info[$key]['relation'] = $relation;
    		$user_info[$key]['count'] = UserWebsupply::get_count(['fans_count','follow_count'],$value['id']);
    		$user_info[$key]['folders'] = FolderWebsupply::get_user_folder($value['id'],4,0);
    	}
    	sort($user_info);
    	$list['list'] = $user_info;
        return response()->forApi($list);
    }




}