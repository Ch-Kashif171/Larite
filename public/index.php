<?php

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    define('ROOT_PATH', realpath(__DIR__ . '/../'));
}
// Attempt 2: else if `vendor/autoload.php` exists in current dir (index.php in root)
elseif (file_exists(__DIR__ . '/vendor/autoload.php')) {
    define('ROOT_PATH', realpath(__DIR__));
}
else {
    // fallback: just use current dir (or throw error)
    define('ROOT_PATH', realpath(__DIR__));
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require_once ROOT_PATH . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once ROOT_PATH . '/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The HTTP Kernel
|--------------------------------------------------------------------------
|
| Here we create the HTTP kernel instance for the framework. The kernel is
| responsible for booting and handling the application lifecycle for web
| requests. First we call "handle()" which boots the application and runs
| the router to produce output.
|
*/
$kernel = new Lumite\Http\HttpKernel($app);

$kernel->handle();

/*
|--------------------------------------------------------------------------
| Terminate The Request
|--------------------------------------------------------------------------
|
| After the response has been sent to the browser, we call "terminate()"
| to finish the request lifecycle. This ensures that sessions are written,
| resources are released, and any termination middleware/events are run.
| Even though the client already received the response, this cleanup step
| is essential for a graceful shutdown.
|
*/
$kernel->terminate();
