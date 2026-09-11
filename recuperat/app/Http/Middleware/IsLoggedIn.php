<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsLoggedIn
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
        if(Auth::user()){
            return $next($request);
        }
        return redirect('/')->with("failMessage","No tienes los permisos adecuados para realizar esa acción");
    }
}
