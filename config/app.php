<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Larite'),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */
    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application env Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in development mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your application.
    | If disabled, set this as production so a simple generic error page is shown.
    */

    'app_env' => env('APP_ENV', 'development'),


    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */
    'timezone' => 'Asia/Karachi',


    /*
    |--------------------------------------------------------------------------
    | Default Auth Table
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default auth table for your application authentication
    */

    'table' => env('AUTH_TABLE', 'users'),

    /*
    |--------------------------------------------------------------------------
    | Log Channel
    |--------------------------------------------------------------------------
    |
    | Here you may specify the log channels for your application logging
    | e.g daily, single
    */

    'log_channel' => env('LOG_CHANNEL') ?: 'single',
];