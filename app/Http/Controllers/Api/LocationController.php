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


	/**
     * 获取地理位置
     * @SWG\Api(
     *   path="/location",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="获取地理位置",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="user_id",
     *           description="用户id",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="access_token",
     *           description="token",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         ),
     *       )
     *     )
     *   )
     * )
     * @return Response
     */
    public function postIndex(){
    	$data = Input::all();
    	$data = fparam($data);
        $rules = [
            'user_id' =>'required|exists:users,id',
            'access_token' =>'required|min:5|max:50',
        ];
        $message = [
        	'user_id.required'=>'用户uid不存在',
        	'access_token.required'=>'令牌token 5-50位',
        ];
        //请求参数验证
        parent::validator($data, $rules,$message);
        parent::validateAcessToken($data['access_token']);
        $user = DB::table('users')->select('id','location','location_x','location_y')->where('id',$data['user_id'])->first();
        if(!empty($user)) return response(['data'=>$user,'code'=>200,'message'=>'请求成功']);
        return response(['code'=>1001,'message'=>'请求失败']);
        
    }

    /**
     * 地理位置入库
     * @SWG\Api(
     *   path="/location/afferent",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="获取地理位置",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="user_id",
     *           description="用户id",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="access_token",
     *           description="token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="location",
     *           description="位置描述",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="location_x",
     *           description="位置x坐标",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="location_y",
     *           description="位置y坐标",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *       )
     *     )
     *   )
     * )
     * @return Response
     */
    public function postAfferent(){
    	$data = Input::all();
    	$data = fparam($data);
        $rules = [
            'user_id' =>'required|exists:users,id',
            'access_token' =>'required|min:5|max:50',
            'location' =>'required|max:30',
            'location_x' =>'required',
            'location_y' =>'required',
        ];
        $message = [
        	'user_id.required'=>'用户uid不存在',
        	'access_token.required'=>'令牌token 5-50位',
        	'location.required'=>'位置不能为空',
        	'location_x.required'=>'位置经度不能为空',
        	'location_y.required'=>'位置纬度不能为空',
        ];
        //请求参数验证
        parent::validator($data, $rules,$message);
        parent::validateAcessToken($data['access_token']);
        $updateData  = [
        	'location'=>$data['location'],
        	'location_x'=>$data['location_x'],
        	'location_y'=>$data['location_y']
        ];
        $user = DB::table('users')->where('id',$data['user_id'])->update($updateData);
        if($user) return response(['data'=>$user,'code'=>200,'message'=>'更新定位成功']);
        return response(['code'=>1001,'message'=>'更新定位失败']);
    }

}