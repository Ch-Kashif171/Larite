<?php

namespace Core\Foundation;

use Core\Support\DBQuery;
use Core\Support\Mailer;
use Core\Support\Routing\Router;
use Core\Support\Validation\Validation;

class Binding
{
    /**
     * @return void
     */
    public static function facades()
    {
        // Bind route facade
        app()->singleton('router', new Router());

        // Bind DB facade
        app()->singleton('db', new DBQuery());

        // Bind mail facade
        app()->singleton('mailer', new Mailer());

        // Bind validation facade
        app()->singleton('validator', new Validation());

    }
}