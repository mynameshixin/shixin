<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use App\Services\Admin\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use stdClass;

class ApiController extends Controller
{
    use Helpers;



    /**
     * @param $payload
     * @return mixed
     */
    protected function respond($payload)
    {
        return response()->json($payload);
    }

    /**
     * 验证手机号码
     * @param string $mobile
     * @return boolean|array 验证通过返回 false 不通过 抛出参数错误异常array('code'=>1001,'message'=>'Acess_Token 失效')
     */
    public function validateMobile($mobile)
    {
        if (preg_match("/^1[034578]{1}\d{9}$/",$mobile)){
            return true;
        }
        $message = Lang::get('messages.mobile_error');

        return response()->forApi(array(), 105, $message);
    }

    /**
     * 验证封装类
     *
     * @param array $data 验证数据
     * @param array $rules 验证规则
     * @return boolean|array 验证通过返回 false 不通过 抛出参数错误异常array('code'=>105,'message'=>'参数错误描述')
     */
    public function validator($data, $rules, $messages = array(),$ajax=0)
    {
        $validator = Validator::make($data, $rules,$messages);

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                if ($ajax) {
                    $return = json_encode(['code'=>105,'message'=>$message]);
                    header ( 'Content-type: application/json' );
                    echo $return;
                    exit ();
                }else{
                   return self::error($message);
                }

            }
        }
        return true;
    }

    /**
     * 判断用户当前页面操作权限
     * @param $request
     * @param string $action
     * @return \Illuminate\View\View
     */
    public function checkUrlPermission ($request ,$action='') {
        $user_id = Auth::user()->id;
        $url = $request->path();
        if (empty($action)){
            if ($request->has('modify')) {
               $action = 2 ;
            }else{
                $action = 1;
            }
        }
        $rs = UserService::getInstance()->getUserPermissionByUrl($user_id,$url);
        if ($rs<$action) {
            $message = Lang::get('admin.no_permission');
            return self::error($message);
        }
        return $rs;
    }
    /**
     * 后台错误输出页
     * @param $message
     * @return \Illuminate\View\View
     */
    static public function error($message = '')
    {
        $message = $message ? $message : Lang::get('admin.unknow_error');
        echo  view('admin.error', compact('message'));
        exit();
    }
    
    protected function jsonError($msg = '')
    {
        header('Content-Type: application/json');
        $err = new stdClass();
        $err->status = 'error';
        $err->message = trim($msg);
        $retval = json_encode($err);
        echo $retval;
        exit;
    }

    protected function jsonSuccess($result)
    {
        header('Content-Type: application/json');
        $success = new stdClass();
        $success->status = 'success';
        $success->result = $result;
        $retval = json_encode($success);
        echo $retval;
        exit;
    }

}
