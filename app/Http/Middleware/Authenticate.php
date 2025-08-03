<?php

namespace App\Http\Middleware;

use Closure;
use Core\Support\Auth;

class Authenticate
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Core\Support\Redirect|mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        return $next($request);
    }
}