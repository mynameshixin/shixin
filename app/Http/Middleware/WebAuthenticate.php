<?php

namespace App\Http\Middleware;

use Closure;

class WebAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!session('uname') || !session('pwd')) return redirect('webadmin');
        return $next($request);
    }
}
