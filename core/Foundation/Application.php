<?php

namespace Core\Foundation;

use App\Exceptions\Handler;
use Core\Exception\Handlers\MiddlewareException;
use Core\Exception\Handlers\RouteNotFoundException;
use Core\Exception\Log;
use Core\Exception\Whoops;
use Core\Support\AssetsNotFound;
use Core\Support\Facades\Route;
use Core\Support\LoadEnv;
use Core\Support\Routing\RegisterAllRoutes;

class Application
{
    const VERSION = '4.0.0';

    const FRAMEWORK = 'Larite';

    protected array $bindings = [];

    /**
     * @var array|string[]
     */
    protected array $includes = [
        '/core/Utils/helpers.php',
        '/config/app.php',
        '/config/mail.php',
        // Add other files to include before singletons here
    ];

    /**
     * @var array|string[]
     */
    protected array $notFound = [
        'routeExist' => '/core/Utils/routeExist.php',

    ];

    /**
     * @return string
     */
    public static function version(): string
    {
        return static::VERSION;
    }

    /**
     * @return string
     */
    public static function framework(): string
    {
        return static::FRAMEWORK;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->bindings[$key] ?? null;
    }

    /**
     * @param string $key
     * @param mixed $concrete
     * @param array $args
     * @return mixed
     * @throws \ReflectionException
     */
    public function bind(string $key, mixed $concrete, array $args = []): mixed
    {
        if (!isset($this->bindings[$key])) {
            if (is_callable($concrete)) {
                $this->bindings[$key] = $concrete();
            } elseif (is_string($concrete) && class_exists($concrete)) {
                $reflection = new \ReflectionClass($concrete);
                $this->bindings[$key] = $reflection->newInstanceArgs($args);
            } elseif (is_string($concrete) && file_exists($concrete)) {
                $this->bindings[$key] = require_once $concrete;
            } else {
                $this->bindings[$key] = $concrete;
            }
        }
        return $this->bindings[$key];
    }

    /**
     * @param string $key
     * @param mixed $concrete
     * @param array $args
     * @return mixed
     * @throws \ReflectionException
     */
    public function singleton(string $key, mixed $concrete, array $args = []): mixed
    {
        return $this->bind($key, $concrete, $args);
    }

    /**
     * Boot the application: load files and register services in order.
     * @throws \ReflectionException
     */
    public function boot(): void
    {

        foreach ($this->includes as $file) {
            $this->includeFile($file);
        }


        $this->registerSingletons();

        if (config('app.app_env') !== 'production') {
            $this->registerExceptionHandler();
        }

    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function registerSingletons(): void
    {
        /**
         * In case if .env file not exists then bind whoops to throw whoops
         * exception first if env load failed
         */
        if (!file_exists('.env')) {
            $this->singleton('whoops', [Whoops::class, 'handler']);
            $this->singleton('dotenv', LoadEnv::class, [ROOT_PATH]);
        } else { // if .env exists then first bing dotenv
            $this->singleton('dotenv', LoadEnv::class, [ROOT_PATH]);
            $this->singleton('whoops', [Whoops::class, 'handler']);
        }

        $this->singleton('assetsNotFound', [AssetsNotFound::class, 'run']);
        // Add more singletons here as needed
    }

    /**
     * Helper to include a file from ROOT_PATH.
     */
    protected function includeFile(string $path): void
    {
        require_once ROOT_PATH . $path;
    }

    /**
     * @return bool
     * @throws MiddlewareException
     */
    public function init(): bool
    {
        $this->includeFiles();

        // Bind all facades here
        Binding::facades();

        // Initialize all routes
        RegisterAllRoutes::loadAll();

        // Try to execute the matched route
        $routeMatched = false;
        try {
            $routeMatched = Route::executeRoutes();
        } catch (MiddlewareException | RouteNotFoundException $e) {
            Log::error($e, "Not Found Exception");
            throw new MiddlewareException($e->getMessage());
        }

        // If no route matched, handle 404
        if (!$routeMatched) {
            require_once ROOT_PATH . $this->notFound['routeExist'];
        }

        return true;
    }

    /**
     * @return void
     */
    protected function includeFiles()
    {
        foreach ($this->includes as $file) {
            require_once ROOT_PATH . $file;
        }
    }

    protected function registerExceptionHandler(): void
    {
        $handler = new Handler(!(config('app.app_env') === 'production'));

        set_exception_handler([$handler, 'handle']);
    }

}