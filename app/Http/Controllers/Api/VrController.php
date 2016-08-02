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

    	$data = Input::all();

        $rules = array(
            'access_token' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userData = parent::validateAcessToken($data['access_token']);
        $userId = $userData['user_id'];
        if (empty($userId)) {
            return response()->forApi(array(), 1001, '无权限调用接口');
        }
    	$zones = DB::table('citys')->select('id','name','pid','level')->where('pid','>',0)->get();
    	// dd(count($zones));
    	$arr = [];
    	foreach ($zones as $key => $value) {
    		if($value['level'] == 1){
    			$arr[$key] = $value;
    			unset($zones[$key]);
    			foreach ($zones as $k => $v) {
    				if($v['pid'] == $value['id']){
    					$arr[$key]['citys'][$k] = $v;
    					unset($zones[$k]);
    					foreach ($zones as $i => $o) {
    						if($o['pid'] == $v['id']){
    							$arr[$key]['citys'][$k]['countys'][$i] = $o;
    						}
    					}
    				}
    			}
    		}
    	}
    	return response()->forApi(['list' => $arr]);

    }






}










 ?>