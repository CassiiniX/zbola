<?php

namespace App\Http\Middleware;

use Closure;

class isNotAuth
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
        if(auth()->user()){        
            return redirect()->to(
                auth()->user()->role == "admin"  
                    ? "admin" 
                    : "user"
                );            
        }        
        
        return $next($request);
    }
}
