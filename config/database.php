<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'db_connection' => env('DB_CONNECTION','mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify the database name.
    */

    'db_database' => env('DB_DATABASE','larite'),

    /*
    |--------------------------------------------------------------------------
    | Database Username
    |--------------------------------------------------------------------------
    |
    | Here you may specify the database username.
    */

    'db_username' => env("DB_USERNAME",'root'),

    /*
    |--------------------------------------------------------------------------
    | Database Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify the database host name.
    */

    'db_host' => env('DB_HOST','localhost'),

    /*
    |--------------------------------------------------------------------------
    | Database Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify the database password.
    | set the database name.
    */

    'db_password' => env('DB_PASSWORD',''),
];