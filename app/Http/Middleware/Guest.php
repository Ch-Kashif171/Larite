<?php

namespace App\Http\Middleware;

use Closure;
use Lumite\Support\Auth;

class Guest
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Lumite\Support\Redirect|mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return $next($request);
    }
}