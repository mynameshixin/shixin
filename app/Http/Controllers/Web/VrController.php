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
		if($id == 2) $this->design();
		if($id == 3) $this->vrindex();
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
             if(!empty($row['cityid'])){
                $cinfo = DB::table('citys')->select('id','name','pid')->where('id',$row['cityid'])->first();
                $rows[$k]['countryname'] = $cinfo['name'];
                $cpinfo = DB::table('citys')->select('id','name','pid')->where('id',$cinfo['pid'])->first();
                $rows[$k]['cityname'] = $cpinfo['name'];
             }

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
			'needData'=>$needData
		];
		return view('web.vr.index',$data);
	}

	// 设计家首页
	public function design(){

	}

	// vr门店首页
	public function vrindex(){

	}


}



 ?>