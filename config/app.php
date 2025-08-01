<?php

$go_back = url('/');

return [
    'name' => env('APP_NAME', 'Larite'),
    'app_env' => env('APP_ENV', 'development'),
    'table' => env('AUTH_TABLE', 'users'),
    'log_channel' => env('LOG_CHANNEL') ?: 'single',
];