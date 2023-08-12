<?php

namespace App\Http\Middleware;

use Closure;

class authAdmin
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
        if($request->session()->has('authAdmin') && $request->session()->get('authAdmin') === true){
            return $next($request);
        }
        return redirect(route('login'));
    }
}
