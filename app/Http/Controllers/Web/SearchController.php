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
		$type = trim(Input::get('type'));
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user_info'=>!empty($user_info)?$user_info:[],
			'keyword'=>$keyword,
			'type'=>$type
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

	//获取商品或图集
	public function postGoods(){

		$data = Input::all();
		$data = fparam($data);
		$rules = array(
            'kind' => 'in:1,2',
            'keyword'=>'required'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $num = isset($data['num']) ? $data['num'] : 15;
        $rows = $rows->select('id', 'user_id', 'folder_id', 'kind', 'price', 'reserve_price', 'image_ids', 'title', 'tags', 'category_id', 'description', 'source', 'is_recommend', 'collection_count', 'praise_count', 'boo_count', 'detail_url', 'created_at');
        if (isset($data['keyword']) && !empty($data['keyword'])) {
            $keyword = urldecode($data['keyword']);
            $rows = $rows->where(function ($rows) use ($keyword) {
                $rows = $rows->where('goods.title', "like", "%{$keyword}%")
                    ->orWhere('goods.tags', "like", "%{$keyword}%");
            });
        }
        $rows = $rows->get();
        $list = [];
        if (!empty($rows)) {
            if ($user_info) {
                $user_ids = array_column($rows, 'user_id');
                $userArr = UserWebsupply::user_info($user_ids);
            }

            $folder_ids = array_column($rows, 'folder_id');
            $folderArr = DB::table('folders')->whereIn('id', $folder_ids)->lists('name', 'id');
            $commentArr = CommentWebsupply::getCommentFirst($product_ids);
            
            foreach ($rows as $row) {
                //$row['folder_name'] = isset($folderArr[$row['folder_id']]) ? $folderArr[$row['folder_id']] : '';
                $row['source'] = isset(self::$sources[$row['source']]) ? self::$sources[$row['source']] : '';
                if (isset($commentArr[$row['id']])) $row['comment'] = $commentArr[$row['id']];
                if (!empty($row['image_ids'])) {
                    $image_ids = explode(',', $row['image_ids']);
                    foreach ($image_ids as $imageId) {
                        $image_o = LibUtil::getPicUrl($imageId, 3);
                        if (!empty($image_o)) {
                            $row['images'][] = [
                                'image_id'=>$imageId,
                                'name' => isset($fileNames[$imageId]) ? $fileNames[$imageId] : '',
                                'img_m' => LibUtil::getPicUrl($imageId, 1),
                                'img_o' => $image_o
                            ];
                        }
                    }
                }
                $row['user'] = isset($userArr[$row['user_id']]) ? $userArr[$row['user_id']] : [];
                $list[$row['id']] = $row;

            }
        }
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







}