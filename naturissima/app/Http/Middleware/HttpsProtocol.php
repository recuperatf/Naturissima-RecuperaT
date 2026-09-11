<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
class HttpsProtocol
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
            // dd(request());
            if($request->path=="/" || !$request->path){
                // \URL::forceRootUrl('https://www.naturissimafarmacia.com');
                // header("Location:https://www.naturissimafarmacia.com/home");
                // exit;
            }
            
            return $next($request); 
        }
}