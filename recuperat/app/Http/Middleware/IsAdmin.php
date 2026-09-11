<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class IsAdmin
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
                // return $next($request);
        if(Auth::user()){
            if(Auth::user()->rol->id==1){
                return $next($request);
            }
        }
        return redirect()->back()->with("failMessage","No tienes los permisos adecuados para realizar esa acción");
    }
}
