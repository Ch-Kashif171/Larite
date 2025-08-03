<?php

namespace App\Http\Middleware;

use Closure;
use Core\Support\Request;

class MiddlewareTemplate
{
    public function handle(Request $request, Closure $next)
    {
        // Middleware logic here...

        return $next($request);
    }
}