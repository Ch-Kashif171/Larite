<?php

/*
|--------------------------------------------------------------------------
| Application Service Providers
|--------------------------------------------------------------------------
|
| This array lists all of the service providers that will be automatically
| loaded on the request to your application. Feel free to add your own
| services to this array to grant expanded functionality to your app.
|
| Each provider should be a fully qualified class name (FQCN) that extends
| Lumite\Foundation\ServiceProvider. The application will automatically:
|   1. Instantiate each provider.
|   2. Call the `register()` method to bind services into the container.
|   3. Call the `boot()` method to initialize services if needed.
|
| Adding a new provider here automatically registers it without modifying
| the core bootstrap or Application class.
|
*/
return [

    /*
    |--------------------------------------------------------------------------
    | App Service Provider
    |--------------------------------------------------------------------------
    |
    | This provider is responsible for registering core services like cache,
    | mail, and other application-level services into the container.
    |
    */
    App\Providers\AppServiceProvider::class,

    /*
    |--------------------------------------------------------------------------
    | Route Service Provider
    |--------------------------------------------------------------------------
    |
    | This provider is responsible for registering all route files in the
    | application, including web.php, api.php, or any custom route files.
    |
    */
    App\Providers\RouteServiceProvider::class,

    /*
    |--------------------------------------------------------------------------
    | Custom Service Providers
    |--------------------------------------------------------------------------
    |
    | Here you can also add newly created service providers and application
    | will load and resolve them automatically.
    |
    */

];


