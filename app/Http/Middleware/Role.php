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
        $role = explode(';',$role);
        $user = $request->user();
        if (! $user->hasRole($role)) {
            return redirect('/');
        }

        return $next($request);
    }

}