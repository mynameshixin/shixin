<?php namespace App\Http\Middleware;

use App\Services\Admin\UserService;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class AuthForPermission
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        $user_id =$this->auth->user()->id;
        $url = $request->path();
        if (empty($action)){
            if ($request->has('modify') || $request->has('update') || $request->has('delete') ) {
                $action = 2 ;
            }elseif('GET'!=$request->method() ){
                $action = 2 ;
            }else{
                $action = 1;
            }
        }
        $rs = UserService::getInstance()->getUserPermissionByUrl($user_id,$url);
        if ($rs<$action) {
            if ($request->ajax()) {
                $message = Lang::get('admin.no_permission');
                return response()->forApi(array(), 1003, $message);
            }else{
                $message = Lang::get('admin.no_permission');
                return view('admin.error',['message'=>$message]);

            }

        }
        return $next($request);
    }

}
