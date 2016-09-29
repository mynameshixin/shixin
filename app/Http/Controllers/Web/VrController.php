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
use App\Lib\LibUtil;
use DB;

class VrController extends CmController{

	public function index($id){
		$id = (int)($id);
		if($id == 1) return $this->dream();
		if($id == 2) return $this->design();
		if($id == 3) return $this->vrindex();
		if($id == 4) return $this->searchdream();
	}

	public function needData($data,$folder_id,$typeid=0,$btypeid=0){
        $num = isset($data['num'])?$data['num']:4;
        $page = isset($data['page'])?$data['page']:1;

        $rows = DB::table('folder_goods as fg')->select('g.id','g.folder_id','g.created_at','g.kind','g.user_id','g.title','g.description','g.detail_url','g.source_url','g.image_ids','g.praise_count','g.cityid')->where('fg.folder_id',$folder_id);
        if(!empty($typeid)){
            $rows = $rows->where('g.typeid',$typeid);
        }
        if(!empty($btypeid)){
            $rows = $rows->where('g.btypeid',$btypeid);
        }
        $rows = $rows->leftJoin('goods as g','fg.good_id','=','g.id')->orderBy('fg.created_at','desc');
        $skip = ($page-1)*$num;
        $rows = $rows->skip($skip)->take($num)->get();
        foreach ($rows as $k=>$row) {
            //images
            if (!empty($row['image_ids'])) {
                    $image_ids = explode(',', $row['image_ids']);
                    foreach ($image_ids as $imageId) {
                        $image_o = LibUtil::getPicUrl($imageId, 3);
                        if (!empty($image_o)) {
                            $rows[$k]['images'][] = [
                                'image_id'=>$imageId,   
                                'img_m' => LibUtil::getPicUrl($imageId, 1),
                                'img_o' => $image_o
                            ];
                        }
                    }
             }
             // 地区
             $rows[$k]['countryname'] = '未知地区';
             $rows[$k]['cityname'] = '';
             if(!empty($row['cityid'])){
                $cinfo = DB::table('citys')->select('id','name','pid')->where('id',$row['cityid'])->first();
                $rows[$k]['countryname'] = $cinfo['name'];
                $cpinfo = DB::table('citys')->select('id','name','pid')->where('id',$cinfo['pid'])->first();
                $rows[$k]['cityname'] = $cpinfo['name'];
             }

             $rows[$k]['viewcount'] = 0;
             if($viewcount = DB::table('vrview')->where('gid',$row['id'])->first()){
                $rows[$k]['viewcount'] = $viewcount['num'];
             }

             $userArr = UserService::getInstance()->getUserArr([$row['user_id']]);
            // $rows[$k]['user'] = isset($userArr[$row['user_id']]) ? $userArr[$row['user_id']] : [];

        }
        return $rows;
    }

	// 梦想家首页
	public function dream(){
		$data = Input::all();
		$data['num'] = 9;
		$needData = $this->needData($data,3510);
		// dd($needData);
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user_info'=>!empty($user_info)?$user_info:[],
			'needData'=>$needData,
			'alias'=>1
		];
		return view('web.vr.index',$data);
	}

    // 梦想家更多
    public function postDream(){
        $data = Input::all();
        $data['num'] = 9;
        $needData = $this->needData($data,3510);
        // dd($needData);
        return response()->forApi(['list' => $needData]);
    }

	// 梦想家首页(搜索)
	public function searchdream(){
		$data = Input::all();
		$data['num'] = 9;
		$needData = $this->postSearch();
		$alias = $data['alias'];
		$keyword = trim($data['keyword']);
		// dd($needData);
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user_info'=>!empty($user_info)?$user_info:[],
			'needData'=>$needData,
			'alias'=>$alias,
			'keyword'=>$keyword
		];
		return view('web.vr.search_index',$data);
	}


	 //获取搜索和筛选结果
    public function postSearch(){
    	$data = Input::all();
    	$rules = array(
    		'keyword'=>'required',
            'alias'=>'required|in:1,2,3'
        );
        //请求参数验证
        parent::validator($data, $rules);
        switch ($data['alias']) {
            case 1:
                $alias = 3510;
                break;
            case 2:
                $alias = 3511;
                break;
            case 3:
                $alias = 3438;
                break;
            default:
                break;
        }
    	$keyword =trim($data['keyword']);
    	$num = isset($data['num'])?$data['num']:9;
    	$page = isset($data['page'])?$data['page']:1;
    	$rows = DB::table('folder_goods as fg')->where('fg.folder_id',$alias)->select('*');
    	$rows = $rows->where(function ($rows) use ($keyword) {
                $rows = $rows->where('g.title', "like", "%{$keyword}%")->orWhere('g.description','like',"%{$keyword}%")->orWhere('g.tags', "like", "%{$keyword}%");
            });
    	$rows = $rows->leftJoin('goods as g','fg.good_id','=','g.id')->orderBy('fg.created_at','desc');
    	if(!empty($data['cityid'])){
    		$ids = DB::table('citys')->where('pid',$data['cityid'])->lists('id');
    		if(empty($ids)){
    			$rows = $rows->where('g.cityid',$data['cityid']);
    		}else{
    			$n = [];
    			foreach ($ids as $key => $value) {
    				$next = DB::table('citys')->where('pid',$value)->lists('id');
    				$n = array_merge($n,$next);
    			}
    			$ids[] = $data['cityid'];
    			$n = array_merge($n,$ids);
    			$rows = $rows->whereIn('g.cityid',$n);
    		}
    	}
    	if(!empty($data['devid'])){
    		$rows = $rows->where('g.devid',$data['devid']);
    	}
    	if(!empty($data['huid'])){
    		$rows = $rows->where('g.huid',$data['huid']);
    	}
        if(!empty($data['typeid'])){
            $rows = $rows->where('g.devid',$data['typeid']);
        }
        if(!empty($data['btypeid'])){
            $rows = $rows->where('g.huid',$data['btypeid']);
        }
        if(!empty($data['saleid'])){
            $rows = $rows->where('g.devid',$data['saleid']);
        }
        $skip = ($page-1)*$num;
        $rows = $rows->skip($skip)->take($num)->get();
        foreach ($rows as $k=>$row) {
            //images
            if (!empty($row['image_ids'])) {
                    $image_ids = explode(',', $row['image_ids']);
                    foreach ($image_ids as $imageId) {
                        $image_o = LibUtil::getPicUrl($imageId, 3);
                        if (!empty($image_o)) {
                            $rows[$k]['images'][] = [
                                'image_id'=>$imageId,   
                                'img_m' => LibUtil::getPicUrl($imageId, 1),
                                'img_o' => $image_o
                            ];
                        }
                    }
             }
             // 地区
             $rows[$k]['cityname'] = '未知地区';
             $rows[$k]['countryname'] = '';
             if(!empty($row['cityid'])){
                $cinfo = DB::table('citys')->select('id','name','pid')->where('id',$row['cityid'])->first();
                $rows[$k]['countryname'] = $cinfo['name'];
                $cpinfo = DB::table('citys')->select('id','name','pid')->where('id',$cinfo['pid'])->first();
                $rows[$k]['cityname'] = $cpinfo['name'];
             }
             $rows[$k]['viewcount'] = 0;
             if($viewcount = DB::table('vrview')->where('gid',$row['id'])->first()){
                $rows[$k]['viewcount'] = $viewcount['num'];
             }
             $userArr = UserService::getInstance()->getUserArr([$row['user_id']]);
             $rows[$k]['user'] = isset($userArr[$row['user_id']]) ? $userArr[$row['user_id']] : [];

        }
    	return $rows;
    }

	// 设计家首页
	public function design(){
		$data = Input::all();
		$data['num'] = 9;
		$needData = $this->needData($data,3511,2);
		$needData2 = $this->needData($data,3511,3);
		// dd($needData);
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user_info'=>!empty($user_info)?$user_info:[],
			'needData'=>$needData,
			'needData2'=>$needData2,
			'alias'=>2
		];
		return view('web.vr.design',$data);
	}


	// 设计家更多
	public function postDesign(){
		$data = Input::all();
		$data['num'] = 9;
		$needData = $this->needData($data,3511,$data['type']);
		// dd($needData);
		return response()->forApi(['list' => $needData]);
	}

	// vr门店首页
	public function vrindex(){
		$data = Input::all();
		$data['num'] = 9;
		$needData = $this->needData($data,3438,0,1);
		$needData2 = $this->needData($data,3438,0,2);
		$needData3 = $this->needData($data,3438,0,3);
		// dd($needData);
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user_info'=>!empty($user_info)?$user_info:[],
			'needData'=>$needData,
			'needData2'=>$needData2,
			'needData3'=>$needData3,
			'alias'=>3
		];
		return view('web.vr.vrindex',$data);
	}

	// vr门店首页更多
	public function postVrindex(){
		$data = Input::all();
		$data['num'] = 9;
		$needData = $this->needData($data,3438,0,$data['type']);
		// dd($needData);
		return response()->forApi(['list' => $needData]);
	}

	// vr制作预约
	public function postVrorder(){
		$data = Input::all();
		$data = fparam($data);
		$rules = [
			'type'=>'required|in:1,2',
			'num'=>'required|integer',
			'area'=>'required|numeric',
			'name'=>'required|min:1|max:20',
			'mobile'=>'required|regex:/^1[34578][0-9]{9}$/',
			'other'=>'max:200'
		];
		$pa = [
			'type.required'=>'空间类型不能为空',
			'num.required'=>'空间数不能为空',
			'num.integer'=>'空间数不是一个有效数字',
			'area.required'=>'面积不能为空',
			'area.numeric'=>'面积不是一个有效数字',
			'name.required'=>'联系人不能为空',
			'name.max'=>'联系人不能超过20个字',
			'mobile.required'=>'联系方式不能为空',
			'mobile.regex'=>'联系方式不是一个有效手机号',
			'other.max'=>'补充信息不能超过200个字'
		];
		parent::validator($data,$rules,$pa);
		if(isset($data['/vrp/vrorder'])) unset($data['/vrp/vrorder']);
		$data['create_at'] = date("Y-m-d H:i:s");
		$id = DB::table('vr_order')->insertGetId($data);
		return response()->forApi(['id' => $id]);
	}

}



 ?>