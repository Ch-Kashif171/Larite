<?php

namespace Core\Support\Routing;

use App\Providers\RouteServiceProvider;
use Core\Support\Facades\Route;
use function coreView;

class RegisterAllRoutes
{
    /**
     * @return void
     */
    public static function loadAll()
    {
        $routeFiles = RouteServiceProvider::register();
        foreach ($routeFiles as $file) {
            require_once root_path . '/' . $file;
        }
    }
} 