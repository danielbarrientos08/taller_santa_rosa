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
        $subString = explode('/',$request->path());

        if (! $request->expectsJson()) {
            if($subString[0] == 'admin' ){
                return route('admin.login');
            }

            return route('login');
        }
    }
}
