<?php

namespace App\Providers;

use Lumite\Foundation\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    /**
     * @return void
     */
    public function register(): void
    {
        $this->routes(function () {
            return [
                'routes/web.php',
                'routes/api.php',
                // Add more route files here...
            ];
        });
    }
} 