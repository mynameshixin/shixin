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
     *       method="GET",
     *       summary="获取地理位置",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="uid",
     *           description="用户id",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="token",
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
        $rules = array (
            'uid' =>'required|exists:users,id',
            'token' =>'required|min:5|max:50',
        );
        //请求参数验证
        parent::validator($data, $rules);
        parent::validateAcessToken($data['token']);
        $user = DB::table('users')->select('id','location','location_x','location_y')->where('id',$data['uid'])->first();
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
     *           name="uid",
     *           description="用户id",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="token",
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
        $rules = array (
            'uid' =>'required|exists:users,id',
            'token' =>'required|min:5|max:50',
            'location' =>'required|max:30',
            'location_x' =>'required',
            'location_y' =>'required',
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