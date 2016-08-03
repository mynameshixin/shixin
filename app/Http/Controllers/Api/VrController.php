<?php 
namespace App\Http\Controllers\Api;
use App\Lib\LibUtil;
use Illuminate\Support\Facades\Input;
use DB;


class VrController extends BaseController{
    private static $user_id;

    public function __construct(){

    }
    //获取全国的区域 省市县
    public function getZone(){

    	/*$data = Input::all();

        $rules = array(
            'access_token' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userData = parent::validateAcessToken($data['access_token']);
        $userId = $userData['user_id'];
        if (empty($userId)) {
            return response()->forApi(array(), 1001, '无权限调用接口');
        }*/
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
    	$deves = DB::table('develops')->get();
    	return response()->forApi(['list' => $deves]);

    }

    //获取户型
    public function getHuxing(){
    	$huxing = DB::table('huxing')->get();
    	return response()->forApi(['list' => $huxing]);

    }

    //获取梦幻家首页数据
    public function getDream(){
    	$data = Input::all();
    	$num = isset($data['num'])?$data['num']:8;
    	$page = isset($data['page'])?$data['page']:1;
    	$rows = DB::table('folder_goods as fg')->where('fg.folder_id',3510)->select('g.id','g.user_id','g.kind','g.title','g.description','g.detail_url','g.source_url','g.praise_count','g.collection_count','g.image_ids');
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

        }
        return response()->forApi(['list' => $rows]);
    }
    //获取搜索和筛选结果
    public function getDreamsearch(){
    	$data = Input::all();
    	$rules = array(
            'access_token' => 'required',
            'keyword'=>'required'
        );
    	$keyword =trim($data['keyword']);
    	$num = isset($data['num'])?$data['num']:8;
    	$page = isset($data['page'])?$data['page']:1;
    	$rows = DB::table('folder_goods as fg')->where('fg.folder_id',3510)->select('g.id','g.user_id','g.kind','g.title','g.description','g.detail_url','g.source_url','g.praise_count','g.collection_count','g.image_ids');
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
        $skip = ($page-1)*$num;
        $rows = $rows->skip($skip)->take($num)->get();
    	return response()->forApi(['list' => $rows]);
    }

}










 ?>