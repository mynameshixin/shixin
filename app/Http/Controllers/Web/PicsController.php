<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use App\Lib\LibUtil;
use App\Services\CollectionService;
use App\Services\ProductService;
use App\Services\Admin\ImageService as ImageService;
use App\Models\CollectionGood;
use DB;


class PicsController extends CmController{


	
	public function __construct(){
		parent::__construct();
		$getdata = Input::all();
		if(isset($getdata['oid']) && !empty($getdata['oid'])){
			$this->other_id = $getdata['oid'];
		}else{
			$this->other_id = $this->user_id;
		}
	}

	public function getIndex(){
		
		$user_id = $this->user_id; 
		$goods = $this->postGoods();
		$data = [
			'self_id'=>$user_id,
			'self_info'=>$this->self_info,
			'goods'=>$goods['data']['list'],
		];
		return view('web.pics.index',$data);

	}

	//获取瀑布流数据
	public function postGoods(){
		
		$data = Input::all();
		$data = fparam($data);
        $data['kind'] = 2 ;
        $data['page'] = isset($data['page'])?$data['page']:1;
        $num = isset($data['num']) ? $data['num'] : 15;
        $user_ids = $folder_ids = [];
        $user_id = $this->user_id;
        $user_ids[] = $user_id;
        $folder_ids = [];
       /* if (isset($user_id) && !empty($user_id)){
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
        $folder_ids = array_unique($folder_ids);*/
        $rs = ProductWebsupply::getProductsByFids($folder_ids,$user_ids,$data,$num,$user_id);
        //$rs = ProductService::getInstance()->getProductsByFids ($folder_ids,$user_ids,$data,$num,$user_id);
        return response()->forApi($rs);


	}

	

	public function show($id){
        $data['img_id'] = $id;
		$self_id = $this->user_id;
		$folder = DB::table('goods')->where('id',$id)->select('folder_id')->first();
		if(!$folder) die('no such pic!');
		$private = DB::table('folders')->where('id',$folder['folder_id'])->select('private','user_id')->first();
		$cg = DB::table('collection_good')->where(['user_id'=>$self_id,'good_id'=>$id])->first();
		if($private['private']==1 && $self_id!=$private['user_id'] && !$cg) die('such pic is in a private folder!');


		$goods = ProductWebsupply::get_pic_detail($self_id,$data);
		$action = DB::table('good_action')->where(['good_id'=>$id,'kind'=>1,'user_id'=>$self_id])->first();
		$goods['action'] = !empty($action)?1:0;
        $title = !empty(trim($goods['description']))?$goods['description']:$goods['title'];
		// dd($goods);
        // dd($goods['comments']);   
		$data = [
			'user_id'=>$goods['user_id'],
			'self_id'=>$self_id,
			'self_info'=>$this->self_info,
			'goods'=>$goods,
            'title'=>'堆图家.'.$title,
            'keywords'=>','.$goods['folder']['name']
		];
		return view('web.pics.show',$data);
	}
    public function getMain(){
        $data = Input::all();
        $id = isset($data['img_id'])?$data['img_id']:636;
        $self_id = isset($data['user_id'])?$data['user_id']:6;
        $data['img_id'] = $id;
        $folder = DB::table('goods')->where('id',$id)->select('folder_id')->first();
        if(!$folder) die('no such pic!');
        $private = DB::table('folders')->where('id',$folder['folder_id'])->select('private','user_id')->first();
        $cg = DB::table('collection_good')->where(['user_id'=>$self_id,'good_id'=>$id])->first();
        if($private['private']==1 && $self_id!=$private['user_id'] && !$cg) die('such pic is in a private folder!');


        $goods = ProductWebsupply::get_pic_detail($self_id,$data);
        $action = DB::table('good_action')->where(['good_id'=>$id,'kind'=>1,'user_id'=>$self_id])->first();
        $goods['action'] = !empty($action)?1:0;
        $title = !empty(trim($goods['description']))?$goods['description']:$goods['title'];
        // dd($goods);
        // dd($goods['comments']);   
        $list = [
            'list'=>$goods,
        ];
        return response()->forApi($list);
    }

    public function getFolder(){
        $data = Input::all();
        $self_id = isset($data['user_id'])?$data['user_id']:6;
        $data['img_id'] = isset($data['img_id'])?$data['img_id']:636;
        $data['page'] = isset($data['page'])?$data['page']:1;
        $data['num'] = isset($data['num'])?$data['num']:4;
        $rs = ProductWebsupply::get_folder_detail($self_id,$this->other_id,$data,$data['img_id']);
        $list['list'] = $rs;
        return response()->forApi($list);
    }

    public function getImg(){
        $data = Input::all();
        $data['img_id'] = isset($data['img_id'])?$data['img_id']:636;
        $data['fid'] = isset($data['fid'])?$data['fid']:2589;
        $self_id = isset($data['user_id'])?$data['user_id']:6;
        $data['page'] = isset($data['page'])?$data['page']:1;
        $data['num'] = isset($data['num'])?$data['num']:15;
        $rs = ProductWebsupply::get_folder_file($data['fid'],$this->other_id,$self_id,$data);
        $list['list'] = $rs;
        return response()->forApi($list);
    }
	public function postFolder(){
		$data = Input::all();
		$data = fparam($data);
        $data['img_id'] = isset($data['img_id'])?$data['img_id']:0;
		$self_id = $this->user_id;
		$rs = ProductWebsupply::get_folder_detail($self_id,$this->other_id,$data,$data['img_id']);
		$list['list'] = $rs;
        return response()->forApi($list);
	}

	public function postImg(){
		$data = Input::all();
		$data = fparam($data);
        $data['img_id'] = isset($data['img_id'])?$data['img_id']:0;
        $data['fid'] = isset($data['fid'])?$data['fid']:0;
        if($data['fid'] == 0) return response()->forApi(['invalid param']);
		$self_id = $this->user_id;
		$rs = ProductWebsupply::get_folder_file($data['fid'],$this->other_id,$self_id,$data);
		$list['list'] = $rs;
        return response()->forApi($list);
	}

	//采集ajax 返回文件
	public function postCgoods(){

		$data = Input::all();
        $rules = array(
            'user_id' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userId = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$userId)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');
        $uid = $user['id'];
		// $cg = DB::table('collection_good as cg')->join('folders as f','cg.folder_id','=','f.id')->where('cg.user_id',$userId)->orderBy('cg.created_at','desc')->groupBy('cg.folder_id')->select('f.name','f.id','f.image_id','f.private')->take(3)->get();
        $cg = DB::select("select * from (select * from(select f.name,f.id,f.image_id,f.private,cg.created_at from collection_good as cg  LEFT JOIN folders as f on cg.folder_id=f.id where cg.user_id={$uid} ORDER BY cg.created_at desc ) as a GROUP BY a.id) as b ORDER BY b.created_at desc limit 3");
		if(!empty($cg)){
			foreach ($cg as $k => $v) {
				$cg[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_id'], 1))?LibUtil::getPicUrl($v['image_id'], 1):url('uploads/sundry/blogo.jpg');
			}
		}
		$folder = DB::table('folders')->where('user_id',$uid)->select('name','id','image_id','private')->orderBy('created_at','desc')->get();
		$folder = array_merge($cg,$folder);
		//去重算法
		$rAr=array(); 
		for($i=0;$i<count($folder);$i++) { 
			if(!isset($rAr[$folder[$i]['id']])) { 
				$rAr[$folder[$i]['id']]=$folder[$i]; 
			} 
		} 
		$folder = array_values($rAr); 

		if(!empty($folder)){
			foreach ($folder as $k => $v) {
				$folder[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_id'], 1))?LibUtil::getPicUrl($v['image_id'], 1):url('uploads/sundry/blogo.jpg');
			}
		}
        $rarr = ['cg'=>$cg,'folder'=>$folder];
        return response()->forApi($rarr);
	}

    //采集ajax 返回文件 get
    public function getCgoods(){
        $callback = isset($_GET['callback'])?$_GET['callback'].'(':'';
        $right = isset($_GET['callback'])?')':'';
        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userId = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$userId)->first();
        if(empty($user)) return response()->forApi([],1001,'不存在的用户');
        $uid = $user['id'];
        //$cg = DB::table('collection_good as cg')->join('folders as f','cg.folder_id','=','f.id')->where('cg.user_id',$userId)->orderBy('cg.created_at','desc')->groupBy('cg.folder_id')->select('f.name','f.id','f.image_id','f.private','cg.created_at')->take(3)->get();
        $cg = DB::select("select * from (select * from(select f.name,f.id,f.image_id,f.private,cg.created_at from collection_good as cg  LEFT JOIN folders as f on cg.folder_id=f.id where cg.user_id={$uid} ORDER BY cg.created_at desc ) as a GROUP BY a.id) as b ORDER BY b.created_at desc limit 3");
        if(!empty($cg)){
            foreach ($cg as $k => $v) {
                $cg[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_id'], 1))?LibUtil::getPicUrl($v['image_id'], 1):url('uploads/sundry/blogo.jpg');
            }
        }
        $folder = DB::table('folders')->where('user_id',$uid)->select('name','id','image_id','private')->orderBy('created_at','desc')->get();
        $folder = array_merge($cg,$folder);
        //去重算法
        $rAr=array(); 
        for($i=0;$i<count($folder);$i++) { 
            if(!isset($rAr[$folder[$i]['id']])) { 
                $rAr[$folder[$i]['id']]=$folder[$i]; 
            } 
        } 
        $folder = array_values($rAr); 

        if(!empty($folder)){
            foreach ($folder as $k => $v) {
                $folder[$k]['image_url'] = !empty(LibUtil::getPicUrl($v['image_id'], 1))?LibUtil::getPicUrl($v['image_id'], 1):url('uploads/sundry/blogo.jpg');
            }
        }
        $rarr = ['cg'=>$cg,'folder'=>$folder];
        die($callback.json_encode($rarr).$right);
    }

	//采集动作ajax
	public function postCpic(){
		$params = fparam(Input::all());
		// dd($params);
        $rules = array(
            'good_id' => 'required|exists:goods,id',
            'folder_id' => 'exists:folders,id',
            'user_id' => 'required',
            'action'=>'required'
        );
        //请求参数验证
        parent::validator($params, $rules);
        $user_id = self::get_user_cache($params['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');

        $action = isset($params['action']) ? $params['action'] : 1;
        if ($action==2) {
            $folder_id = isset($params['folder_id']) ? $params['folder_id'] : 0;
            $rs = CollectionService::getInstance()->delCollection ($user_id,$params['good_id'],$folder_id);
        }else{
            $folder_id = isset($params['folder_id']) ? $params['folder_id'] : 0;
            $row = CollectionGood::where(['user_id'=>$user_id,'good_id'=>$params['good_id'],'folder_id'=>$folder_id])->first();
            if (!empty($row)) {
                return response()->forApi(array(), 1001, '你已采集过该商品');
            }
            $rs = CollectionService::getInstance()->addCollection ($user_id,$params['good_id'],$folder_id);

        }

        if ($rs) {
            return response()->forApi(['status' => 1], 200, '操作成功');
        } else {
            return response()->forApi(array(), 1001, '操作失败');
        }
	}

	//上传多张图片
    public function postUimg(){
        
        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
            'kind' => 'required|in:1,2',
            'fid' => 'required|exists:folders,id',
            'category_id' => 'exists:categories,id',
            // 'image' => 'required',
            'source' => 'in:0,1',
        );
        //请求参数验证
        parent::validator($data, $rules);

        if(empty($_FILES['image'])) return response()->forApi(array(), 1001, '没有选择图片');

        //8M大小验证
        foreach ($_FILES['image']['size'] as $key => $value) {
            if($value>8388608) return response()->forApi(array(), 1001, '图片大小大于8M');
        }

        // dd($data);
        $userId = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$userId)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');

        $rulesImage = $file = array();
        if (is_array($data['image']) && !empty($data['image'])) {
            foreach ($data['image'] as $k => $v) {
                $rulesImage[$k] = 'image';
            }
            parent::validator($data['image'], $rulesImage);
        }
        if (isset($data['fid'])) {
            $row = DB::table('folders')->where('id',$data['fid'])->select('name')->first();
            $data['folder_name'] = $row['name'];
            
            if (empty($row)){
                return response()->forApi(array(), 1001, '请选择正确文件夹！');
            }
        }
        //删除没有的
        foreach ($_FILES['image']['name'] as $key => $value) {
            if(!isset($data['pop_addfont_wrap'][$key])){
                unset($_FILES['image']['name'][$key]);
                unset($_FILES['image']['type'][$key]);
                unset($_FILES['image']['tmp_name'][$key]);
                unset($_FILES['image']['error'][$key]);
                unset($_FILES['image']['size'][$key]);
            }
        }
        // 设置名称
        foreach ($data['pop_addfont_wrap'] as $key => $value) {
        	if(isset($value)){
        		$_FILES['image']['name'][$key] = $value;
        	}
        }

        //用户发布，先发后审
        $data['status'] = 1;
        $data['folder_id'] = $data['fid'];

        $id = ProductService::getInstance()->addProduct ($userId,$data,$_FILES);
        if ($id) {
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '发布失败！');
        }
    }

    //采集插件上传图片
    public function getPluginimg(){
        
        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
            'img_urls'=>'required',
            'titles'=>'required',
            'source_urls'=>'required',
            'fid' => 'required|exists:folders,id',
        );
        $callback = isset($_GET['callback'])?$_GET['callback'].'(':'';
        $right = isset($_GET['callback'])?')':'';
        //请求参数验证
        parent::validator($data, $rules);

        if(!is_array($data['img_urls'])) return response()->forApi(array(), 1001, '没有选择图片');
       
        $userId = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$userId)->first();
        if(empty($user)) return response()->forApi([],1001,'不存在的用户');

        $entry = [];
        if (isset($data['fid'])) {
            $row = DB::table('folders')->where('id',$data['fid'])->select('name')->first();
            $entry['folder_name'] = $data['folder_name'] = $row['name'];
            if (empty($row)) return response()->forApi(array(), 1001, '请选择正确文件夹！');
        }
        $ids = [];
        foreach ($data['img_urls'] as $key => $url) {

            $entry['title'] = $data['titles'][$key];
            $entry['source_url'] = $data['source_urls'][$key];
            $entry['status'] = 1;
            $entry['kind'] = 2;
            $entry['folder_id'] = $data['fid'];
            $image_id = ImageService::getInstance()->getImageIds($url);
            // print_r($image_id);die;
            $entry['image_id'] = isset($image_id)?$image_id:null;
            $ids[] = ProductService::getInstance()->addProduct($userId,$entry,[]);

        }
        die($callback.json_encode(['ids'=>$ids]).$right);

    }
    // 删除图片
    public function postDel () {
        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
            'good_id' => 'required',
            'folder_id' => 'required|exists:folders,id',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userId = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$userId)->first();
        if(empty($user)) return response()->forApi([],1001,'不存在的用户');

        
        CollectionService::getInstance()->delCollection($user['id'],$data['good_id'],$data['folder_id']);
        ProductService::getInstance()->delFolderProduct($data['good_id'],$data['folder_id']);
        return response()->forApi(['status'=>1]);

    }

    //添加评论
    public function postAddcomment(){
        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
            'good_id' => 'required|exists:goods,id',
            'content'=>'required'
        );
        //请求参数验证
        parent::validator($data, $rules);    
        $userId = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$userId)->first();
        if(empty($user)) return response()->forApi([],1001,'不存在的用户');

        $entry = [
            'good_id'=>$data['good_id'],
            'user_id'=>$userId,
            'content'=>$data['content'],
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ];
        if($id = DB::table('comments')->insertGetId($entry)){
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '发布失败！');
        }

    }
    //评论的赞提高
    public function postCommentcount(){
        $data = Input::all();
        $rules = array(
            'user_id' => 'required|exists:users,id',
            'comment_id' => 'required|exists:comments,id',
            'u_id'=>'required'
        );
        //请求参数验证
        parent::validator($data, $rules);    
        $userId = self::get_user_cache($data['u_id']);
        $user = DB::table('users')->where('id',$userId)->first();
        if(empty($user)) return response()->forApi([],1001,'不存在的用户');
        if(DB::table('comment_action')->where(['user_id'=>$data['user_id'],'comment_id'=>$data['comment_id']])->first()){
            return response()->forApi([],1001,'您已经赞过了');
        }
        DB::table('comments')->where('id',$data['comment_id'])->increment('praise_count');
        $entry = [
            'user_id'=>$data['user_id'],
            'comment_id'=>$data['comment_id'],
            'action'=>1,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        $id = DB::table('comment_action')->insertGetId($entry);
        if($id){
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '发布失败！');
        }

    }

}