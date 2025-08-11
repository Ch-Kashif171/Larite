<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Mail Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the mail driver is used to send any email
    | messages sent by your application.
    */

    'driver' => env('MAIL_DRIVER','smtp'),


    /*
    |--------------------------------------------------------------------------
    | Mail Host
    |--------------------------------------------------------------------------
    |
    | This option controls the mail host is used to send any email
    | messages sent by your application.
    */

    'host' => env('MAIL_HOST','smtp.gmail.com'),


    /*
    |--------------------------------------------------------------------------
    | Mail Username
    |--------------------------------------------------------------------------
    |
    | These option to control the mail username is used to send any email
    | messages sent by your application.
    */

    'username' => env('MAIL_USERNAME'),


    /*
    |--------------------------------------------------------------------------
    | Mail Password
    |--------------------------------------------------------------------------
    |
    | These option to control the mail password is used to send any email
    | messages sent by your application.
    */

    'password' => env('MAIL_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Mail Port
    |--------------------------------------------------------------------------
    |
    | This option controls the mail port is used to send any email
    | messages sent by your application.
    */

    'port' => env('MAIL_PORT','587'),

    /*
    |--------------------------------------------------------------------------
    | Mail From
    |--------------------------------------------------------------------------
    |
    | These options to controls the mail from (address, name) is used to send any email
    | messages sent by your application.
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS','example@gmail.com'),
        'name' => env('MAIL_FROM_NAME','Larite'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Mail Encryption
    |--------------------------------------------------------------------------
    |
    | These option to control the mail encryption is used to send any email
    | messages sent by your application.
    */

    'encryption' => env('MAIL_ENCRYPTION','tls'),

];
