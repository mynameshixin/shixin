<?php 
/**
 * Created by shixin.
 * User: shixin
 * Date: 16/5/6
 * Time: 下午15:49
 */
namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Lib\UserReg as Registrar ;
use DB;

class LocationController extends BaseController{

	
   	//传入token uid 获取location location_x location_y
    public function postIndex(){
    	$data = Input::all();
    	$data = fparam($data);
        $rules = array (
            'uid' =>'required|integer',
            'token' =>'required|min:5|max:50',
        );
        //请求参数验证
        parent::validator($data, $rules);
        parent::validateAcessToken($data['token']);
        $user = DB::table('users')->select('id','location','location_x','location_y')->where('id',$data['uid'])->first();
        if(!empty($user)) return response(['data'=>$user,'code'=>200,'message'=>'请求成功']);
        return response(['code'=>1001,'message'=>'请求失败']);
        
    }

    //token uid location location_x location_y插入用户定位信息
    public function postAfferent(){
    	$data = Input::all();
    	$data = fparam($data);
        $rules = array (
            'uid' =>'required|integer',
            'token' =>'required|min:5|max:50',
            'location' =>'required|max:30',
            'location_x' =>'required|numeric',
            'location_y' =>'required|numeric',
        );
        //请求参数验证
        parent::validator($data, $rules);
        parent::validateAcessToken($data['token']);
        $updateData  = [
        	'location'=>$data['location'],
        	'location_x'=>$data['location_x'],
        	'location_y'=>$data['location_y']
        ];
        $user = DB::table('users')->where('id',$data['uid'])->update($updateData);
        if($user) return response(['data'=>$user,'code'=>200,'message'=>'更新定位成功']);
        return response(['code'=>1001,'message'=>'更新定位失败']);
    }

}