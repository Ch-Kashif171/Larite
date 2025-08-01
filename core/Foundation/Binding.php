<?php

namespace Core\Foundation;

use Core\Support\DBQuery;
use Core\Support\Routing\Router;

class Binding
{
    /**
     * @return void
     */
    public static function facades()
    {
        // Bind route facade
        app('router', new Router());

        // Bind DB facade
        app('db', new DBQuery());
    }
}