<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(request()->hasHeader('X-Mobile-Request')){
            abort(response()->json(["message" => "Unauthorized"],401));
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
