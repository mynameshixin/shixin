<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use App\Services\FolderService;
use App\Services\ProductService;
use DB;

class FolderController extends CmController{

	public function __construct(){

		parent::__construct();
		$getdata = fparam(Input::all());

		$this->folder_id = !empty($getdata['fid'])?intval($getdata['fid']):0;
		if(empty($this->folder_id)) die('no fid no access!');
	}

	//查询文件夹对应的文件
	public function getIndex(){

		$folder = $this->postFolders(1);
		if(empty($folder['data']['list'])) die('private folder or no such folder!');
		// dd($folder);
        $user_id = $folder['data']['list']['user_id']; 
		$data = [
			'folder'=>$folder['data']['list'],
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'user_id'=>$user_id,
			'type'=>1,
			'self_id'=>$this->user_id
		];
		return view('web.folder.index',$data);

	}


	//查询文件夹被谁关注
	public function getFans(){
		$folder = $this->postFolders(2);
        if(empty($folder['data']['list'])) die('private folder or no such folder!');
		$user_fans = $this->postFans();
        $user_id = $folder['data']['list']['user_id'];
		// dd($user_fans);
		$data = [
			'folder'=>$folder['data']['list'],
			'user_fans'=>$user_fans['data']['list'],
			'user_info'=>$this->user_info,
			'self_info'=>$this->self_info,
			'user_id'=>$user_id,
			'type'=>2,
			'self_id'=>$this->user_id
		];
		return view('web.folder.fans',$data);

	}


	public function postFolders($kind = 1){
		$data = Input::all();
		$data = fparam($data);
        $data['o'] = Input::get('o');
		$data['kind'] = isset($data['kind']) ? $data['kind'] : $kind;
        $data['num'] = isset($data['num']) ? $data['num'] : 15;
        $data['page'] = isset($data['page'])?$data['page']:1;
		$rs = FolderWebsupply::get_folder_file($this->folder_id,$this->user_id,$data);
		$list['list'] = $rs;
		return response()->forApi($list);
	}

	public function postFans(){
		$data = Input::all();
		$data = fparam($data);
        $data['num'] = isset($data['num']) ? $data['num'] : 15;
        $data['page'] = isset($data['page'])?$data['page']:1;
		$rs = FolderWebsupply::get_folder_fans($this->folder_id,$this->user_id,$data);
		$list['list'] = $rs;
		return response()->forApi($list);
	}

	//创建文件夹
	public function postCfolder(){
		$data = Input::all();
		$data = fparam($data);
		$user_id = self::get_user_cache($data['user_id']);
		$user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');
		$folder = DB::table('folders')->where(['name'=>$data['name'],'user_id'=>$user['id']])->first();
        if(mb_substr($data['name'], 10)) return response()->forApi([],1001,'文件夹名称不能超过10个字');
		if($folder) return response()->forApi([],1001,'文件夹已经创建过');
		$insertid = DB::table('folders')->insertGetId(['user_id'=>$user_id, 'name'=>$data['name'],'description'=>$data['description'],'private'=>$data['private']]);
		return response()->forApi(['folder_id'=>$insertid]);
	}

	//修改文件夹
	public function postEfolder(){
		$data = Input::all();
        $data = fparam($data);
        $rules = array(
            'user_id' => 'required',
            'fid' => 'required|exists:folders,id',
            // 'description' => 'required|max:200',
            'name'=>'required|max:50',
            'private'=>'required|in:0,1'
        );

        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');
        if(mb_substr($data['name'], 10)) return response()->forApi([],1001,'文件夹名称不能超过10个字');
		/*$folder = DB::table('folders')->where(['name'=>$data['name'],'user_id'=>$user['id']])->first();
		if($folder) return response()->forApi([],1001,'文件夹名称没有修改');*/

        $entry = [];
        if (isset($data['name'])) $entry['name'] = $data['name'];
        if (isset($data['description'])) $entry['description'] = $data['description'];
        if (isset($data['private'])) $entry['private'] = $data['private'];
        if (!empty($entry)) {
            $res = DB::table('folders')->where('id', '=', $data['fid'])->update($entry);
        }
        return response()->forApi(['status' => 1]);

	}

	// 根据文件夹id获取图片
	public function postFpic(){
		$data = Input::all();
        $data = fparam($data);
        $rules = array(
            'user_id' => 'required|max:400',
            'fid' => 'required|exists:folders,id',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');
	}

	// 修改文件夹封面
	public function postAvatar(){

        $data = Input::all();
        $data = fparam($data);
        $rules = array(
            'user_id' => 'required|max:400',
            'fid' => 'required|exists:folders,id',
            'image_id' => 'exists:images,id'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');
		if (isset($data['image_id'])) $entry['image_id'] = $data['image_id'];
        $res = DB::table('folders')->where('id', '=', $data['fid'])->update($entry);
        return response()->forApi(['status' => 1]);
    }

    //删除文件夹
    public function postDfolder(){
    	$data = Input::all();
    	$data = fparam($data);
    	$rules = [
    		'user_id' => 'required|max:400',
    		'fid'=>'required|exists:folders,id'
    	];
    	parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');
    	$id = $data['fid'];
    	DB::table('goods')->where(['folder_id'=>$id,'user_id'=>$user_id])->delete();
        DB::table('collection_good')->where(['folder_id'=>$id,'user_id'=>$user_id])->delete();
        DB::table('folder_goods')->where(['folder_id'=>$id,'user_id'=>$user_id])->delete();
        DB::table('folders')->where('id',$id)->delete();
        return response()->forApi(['status'=>1]);
    }
    //上传图片
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
        /*echo '<pre>';
        print_r($data);
        print_r($_FILES);
        die;*/
        if(empty($_FILES['image'])) return response()->forApi(array(), 1001, '没有选择图片');
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
        if (isset($data['folder_id'])) {
            $row = Folder::find($data['folder_id']);
            if (empty($row) || $userId !=$row->user_id){
                return response()->forApi(array(), 1001, '请选择正确文件夹！');
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
    //上传商品
    public function postUgoods(){

        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
            'kind' => 'required|in:1,2',
            'fid' => 'required|exists:folders,id',
            'category_id' => 'exists:categories,id',
            'image_ids' => 'required',
            'source' => 'in:0,1',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userId = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$userId)->first();
		if(empty($user)) return response()->forApi([],1001,'不存在的用户');

        //用户发布，先发后审
        $data['status'] = 1;
        $data['folder_id'] = $data['fid'];
        $id = ProductService::getInstance()->addProduct ($userId,$data);
        if ($id) {
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '发布失败！');
        }
    }

     //编辑商品
    public function postEgood(){

        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
            'kind' => 'required|in:1,2',
            'fid' => 'required|exists:folders,id',
            'good_id' => 'required|exists:goods,id',
            'title'=>'required'
        );

        //请求参数验证
        parent::validator($data, $rules);
        $userId = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$userId)->first();
        if(empty($user)) return response()->forApi([],1001,'不存在的用户');

        //用户发布，先发后审
        $data['status'] = 1;
        $data['folder_id'] = $data['fid'];
        $good = DB::table('goods')->where(['id'=>$data['good_id'],'folder_id'=>$data['folder_id'],'kind'=>2])->select('tags','id')->first();
        $folder = DB::table('folders')->where('id',$data['fid'])->select('name')->first();

        $ptags = $data['ptags'];
        if(!empty($good)){
            $tags = $good['tags'].';'.$ptags.';'.$folder['name'];
            $entry = [
                'title'=>$data['title'],
                'description'=>$data['title'],
                'source_url'=>$data['source_url'],
                'tags'=>$tags,
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            DB::table('goods')->where(['id'=>$data['good_id'],'folder_id'=>$data['folder_id'],'kind'=>2])->update($entry);
            return response()->forApi(['status' => 1]);
        }
        return response()->forApi([],1001,'编辑失败');
        
    }

    //上传或编辑vr
    public function postUvr(){
        $data = Input::all();
        // dd($data);
        $rules = array(
            'user_id' => 'required',
            'kind' => 'required|in:1,2',
            'fid' => 'required|exists:folders,id',
            'category_id' => 'exists:categories,id',
            // 'image' => 'required',
            'source' => 'in:0,1',
            'title'=>'required',
            "detail_url"=>'required',
            'typeid'=>'required',
            'cityid'=>'required'
        );
        $messages = [
            'title.required'=>'标题没有填写',
            'detail_url.required'=>'地址没有填写',
            'typeid.required'=>'类型没有选择',
            'cityid.required'=>'位置没有选择'
        ];

        //请求参数验证
        parent::validator($data, $rules,$messages);

        if(empty($_FILES['image']) && !isset($data['good_id'])) return response()->forApi(array(), 1001, '没有选择图片');
        /*//8M大小验证
        foreach ($_FILES['image']['size'] as $key => $value) {
            if($value>8388608) return response()->forApi(array(), 1001, '图片大小大于8M');
        }*/
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
        if (isset($data['folder_id'])) {
            $row = Folder::find($data['folder_id']);
            if (empty($row) || $userId !=$row->user_id){
                return response()->forApi(array(), 1001, '请选择正确文件夹！');
            }
        }
        //用户发布，先发后审
        $data['status'] = 1;
        $data['folder_id'] = $data['fid'];
        $data['description'] = $data['title'];
        if(isset($data['good_id'])){
            $id = ProductService::getInstance()->updateProduct ($data['good_id'],$data,$_FILES);
        }else{
            $id = ProductService::getInstance()->addProduct ($userId,$data,$_FILES);
        }
        
        if ($id) {
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '发布失败！');
        }
    }

    //删除文件夹的文件
    public function postDelpfolder(){
        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
            'garr' => 'required',
            'fid'=>'required|exists:folders,id'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userId = self::get_user_cache($data['user_id']);
        if(!empty($data['garr'])){
            $gidarr = explode("|",$data['garr']);
            $i = 0;
            foreach($gidarr as $k=>$v){
                if(empty($v)) continue;
                $s = DB::table('goods')->where(['id'=>$v,'user_id'=>$userId])->first();
                if($s){
                    DB::table('goods')->where(['id'=>$v,'user_id'=>$userId])->delete();
                    // $i++;
                }
                $c = DB::table('collection_good')->where(['good_id'=>$v,'user_id'=>$userId,'folder_id'=>$data['fid']])->first();
                if($c){
                    DB::table('collection_good')->where(['good_id'=>$v,'user_id'=>$userId,'folder_id'=>$data['fid']])->delete();
                    // $i++;
                }
                $fg = DB::table('folder_goods')->where(['good_id'=>$v,'user_id'=>$userId,'folder_id'=>$data['fid']])->first();
                if($fg){
                    DB::table('folder_goods')->where(['good_id'=>$v,'user_id'=>$userId,'folder_id'=>$data['fid']])->delete();
                    $i++;
                }
            }
            $folder = DB::table('folders')->where('id',$data['fid'])->select('count')->first();
            $count = $folder['count']-$i;
            $count = $count<0?0:$count;
            DB::table('folders')->where('id',$data['fid'])->update(['count'=>$count]);
        }
        return response()->forApi(['status' => 1]);
    }
}