<?php

namespace App\Http\Middleware;

use Lumite\Support\Auth;
use function redirect;

class Guest
{
    public function handle()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return true;
    }
}