<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
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
        if(!auth()->user()){
            return redirect()->to("signin");
        }

        if(auth()->user()->role != "admin"){
            return redirect()->to("user");
        }

        return $next($request);
    }
}
