<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Config as ConfigModel;

class isMaintaince
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

        if(auth()->check() && auth()->user()->role == 'admin'){
            return $next($request);
        }

        if(intval(ConfigModel::where('name','maintaince')->first()->value) == 1){
            abort(503);
        }
        
        return $next($request);
    }
}
