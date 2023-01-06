<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()){
            return $next($request);
            // if (Auth::user()->level==2){
            //     return $next($request);
            // } else if (Auth::user()->level==1){
            //     return  $next($request);
            // } else {
            //     return redirect ('/')->with('alert', 'role error');
            // }
        }else {
            return redirect ('/')->with('alert', 'login error');
        }
    }
}
