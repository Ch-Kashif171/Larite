<?php

namespace Core\Support\Routing;

use App\Providers\RouteServiceProvider;
use Core\Support\Facades\Route;
use function coreView;

class RegisterAllRoutes
{
    /**
     * Since all service providers are loading in Application.php on init
     * so now need to re load here
     * @return void
     */
    public static function loadAll()
    {
        $routeFiles = app('routes'); // now resolves successfully
        foreach ($routeFiles as $file) {
            require_once ROOT_PATH . '/' . $file;
        }
    }
} 