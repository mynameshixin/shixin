<?php 
namespace App\Http\Controllers\Api;
use App\Lib\LibUtil;
use Illuminate\Support\Facades\Input;
use DB;
use App\Services\UserService;

class VrController extends BaseController{
    private static $user_id;

    public function __construct(){

    }
    //获取全国的区域 省市县
    public function getZone(){
    	$zones = DB::table('citys')->select('id','name','pid','level')->where('pid','>',0)->get();
    	$arr = [];
    	$nolimit = [
    		'id'=>0,
    		'name'=>'不限',
    		'pid'=>0,
    		'level'=>0
    	];
    	foreach ($zones as $key => $value) {
    		if($value['level'] == 1){
    			$arr[$key] = $value;
    			unset($zones[$key]);
    			foreach ($zones as $k => $v) {
    				if($v['pid'] == $value['id']){
    					$arr[$key]['citys'][999] = $nolimit;
    					$arr[$key]['citys'][$k] = $v;
    					unset($zones[$k]);
    					foreach ($zones as $i => $o) {
    						if($o['pid'] == $v['id']){
    							$arr[$key]['citys'][$k]['countrys'][999] = $nolimit;
    							$arr[$key]['citys'][$k]['countrys'][$i] = $o;
    						}
    					}
    				}
    			}
    		}
    	}

    	sort($arr);
    	foreach ($arr as $key => $value) {
    		if(isset($value['citys'])){
    			
    			foreach ($value['citys'] as $k => $v) {
    				if(isset($v['countrys'])){
    					sort($arr[$key]['citys'][$k]['countrys']);
    				}
    			}
    			sort($arr[$key]['citys']);
    		}
    	}
    
    	return response()->forApi(['list' => $arr]);

    }

    //获取开发商
    public function getDev(){
    	$deves = [['id'=>0,'name'=>'不限'],['id'=>1,'name'=>'世茂'],['id'=>2,'name'=>'万科'],['id'=>3,'name'=>'恒大'],['id'=>4,'name'=>'绿地'],['id'=>5,'name'=>'保利'],['id'=>6,'name'=>'中国海外发展'],['id'=>7,'name'=>'碧桂园'],['id'=>8,'name'=>'融创中国'],['id'=>9,'name'=>'龙湖'],['id'=>10,'name'=>'富力'],['id'=>11,'name'=>'华润'],['id'=>12,'name'=>'华夏幸福基业'],['id'=>13,'name'=>'招商'],['id'=>14,'name'=>'金地'],['id'=>15,'name'=>'远洋'],['id'=>16,'name'=>'绿城'],['id'=>17,'name'=>'荣盛'],['id'=>18,'name'=>'北京首都'],['id'=>19,'name'=>'复地'],['id'=>20,'name'=>'金科'],['id'=>21,'name'=>'其他']];
    	return response()->forApi(['list' => $deves]);

    }

    //获取户型
    public function getHuxing(){
    	$deves = [['id'=>0,'name'=>'不限'],['id'=>1,'name'=>'1居'],['id'=>2,'name'=>'2居'],['id'=>3,'name'=>'3居'],['id'=>4,'name'=>'4居'],['id'=>5,'name'=>'5居'],['id'=>6,'name'=>'5居以上']];
    	return response()->forApi(['list' => $deves]);

    }

    //获取类型
    public function getType(){
        $data = Input::all();
        $rules = array(
            'alias'=>'in:1'
        );
        //请求参数验证
        parent::validator($data, $rules);

        if(isset($data['alias']) && $data['alias']==1){
            $deves = [['id'=>0,'name'=>'不限'],['id'=>2,'name'=>'新房'],['id'=>3,'name'=>'二手房改造']];
        }else{
            $deves = [['id'=>0,'name'=>'不限'],['id'=>1,'name'=>'样板房'],['id'=>2,'name'=>'新房'],['id'=>3,'name'=>'二手房改造'],['id'=>4,'name'=>'实体店']];
        }
    	
    	return response()->forApi(['list' => $deves]);

    }

    //获取门店类型
    public function getBrandtype(){
    	$deves = [['id'=>0,'name'=>'不限'],['id'=>1,'name'=>'家具店'],['id'=>2,'name'=>'饰品店'],['id'=>3,'name'=>'卫浴店'],['id'=>4,'name'=>'其他']];
    	return response()->forApi(['list' => $deves]);

    }

    //获取卖场
    public function getSales(){
    	$deves = [['id'=>0,'name'=>'不限'],['id'=>1,'name'=>'百案居'],['id'=>2,'name'=>'红星美凯龙'],['id'=>3,'name'=>'居然之家'],['id'=>4,'name'=>'集美家居'],['id'=>5,'name'=>'吉盛伟邦'],['id'=>6,'name'=>'艺展中心'],['id'=>7,'name'=>'曹家渡花鸟市场'],['id'=>8,'name'=>'文定生活馆'],['id'=>9,'name'=>'其他']];
    	return response()->forApi(['list' => $deves]);

    }

    //获取梦幻家首页数据
    public function getDream(){

        /*$rs = parent::validateAcessToken($data['access_token']);
        if(!$res = DB::table('users')->where('id',$rs['user_id'])->first()){
            return response()->forApi([],1001,'不存在的用户');
        }*/ 
        $data = Input::all();
    	$num = isset($data['num'])?$data['num']:8;
    	$page = isset($data['page'])?$data['page']:1;
    	$rows = DB::table('folder_goods as fg')->where('fg.folder_id',3510)->select('*');
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
             $rows[$k]['viewcount'] = 0;
             if($viewcount = DB::table('vrview')->where('gid',$row['id'])->first()){
             	$rows[$k]['viewcount'] = $viewcount['num'];
             }
             $userArr = UserService::getInstance()->getUserArr([$row['user_id']]);
             $rows[$k]['user'] = isset($userArr[$row['user_id']]) ? $userArr[$row['user_id']] : [];

        }
        return response()->forApi(['list' => $rows]);
    }

    public function needData($data,$folder_id,$typeid=0,$btypeid=0){
        $num = isset($data['num'])?$data['num']:4;
        $page = isset($data['page'])?$data['page']:1;
        $rows = DB::table('folder_goods as fg')->select('*');
        if(!empty($typeid)){
            $rows = $rows->where(['fg.folder_id'=>$folder_id,'g.typeid'=>$typeid]);
        }
        if(!empty($btypeid)){
            $rows = $rows->where(['fg.folder_id'=>$folder_id,'g.btypeid'=>$btypeid]);
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
             $rows[$k]['viewcount'] = 0;
             if($viewcount = DB::table('vrview')->where('gid',$row['id'])->first()){
                $rows[$k]['viewcount'] = $viewcount['num'];
             }

             $userArr = UserService::getInstance()->getUserArr([$row['user_id']]);
             $rows[$k]['user'] = isset($userArr[$row['user_id']]) ? $userArr[$row['user_id']] : [];

        }
        return $rows;
    }


    //获取设计家首页数据
    public function getDesign(){
        $data = Input::all();
        $rules = array(
            't'=>'required|in:2,3'
        );
        $p = [
            't.required'=>'参数t必须为2或者3'
        ];
        //请求参数验证
        parent::validator($data, $rules,$p);
        $list = $this->needData($data,3511,$data['t']);
        
        return response()->forApi(['list' => $list]);
    }

    //获取VR首页数据
    public function getVrindex(){
        $data = Input::all();
        $rules = array(
            't'=>'required|in:1,2,3'
        );
        $p = [
            't.required'=>'参数t必须为1或2或3'
        ];
        //请求参数验证
        parent::validator($data, $rules,$p);
        $list = $this->needData($data,3438,0,$data['t']);
        return response()->forApi(['list' => $list]);
    }

    //获取搜索和筛选结果
    public function getSearch(){
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
    	$num = isset($data['num'])?$data['num']:8;
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
    	return response()->forApi(['list' => $rows]);
    }

    //vr展示个数加1
    public function getViewincrease(){
        $data = Input::all();
        $rules = array(
            'gid'=>'required',
        );
        //请求参数验证
        parent::validator($data, $rules);

        $gshow = DB::table('vrview')->where('gid',$data['gid'])->first();
        if($gshow){
            DB::table('vrview')->where('gid',$data['gid'])->increment('num');
        }else{
            DB::table('vrview')->insert(['gid'=>$data['gid'],'num'=>1]);
        }
        return response()->forApi(['status' => 1]);
    }

}










 ?>