<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/9/2
 * Time: 下午3:58
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;


class Role
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        header('content-type:text/html;charset=utf-8');
        $role = explode(';',$role);
        $user = $request->user();

        if (!$res =  $user->hasRole($role)) {
            die('运营账号无法登陆');
            // return redirect('/admin');
        }

        return $next($request);
    }

}