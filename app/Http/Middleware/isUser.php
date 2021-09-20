<?php

namespace App\Http\Middleware;

use Closure;

class isUser
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

        try{
            if(auth()->user()){
                \Config::set('app.notification',
                    auth()->user()->notifications()
                        ->orderBy('id','desc')
                        ->take(3)
                        ->get()
                );

                \Config::set('app.notification_unread',
                    auth()->user()->notifications()
                        ->where('read',false) 
                        ->count()
                );
            }
        }catch(\Exception $e){
            \Config::set('app.notification',[]);
            \Config::set('app.notification_unread',false);
        }

        return $next($request);
    }
}
