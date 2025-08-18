<?php

namespace Core\Foundation;

use App\Exceptions\Handler;
use App\Providers\AppServiceProvider;
use Core\Exception\Handlers\MiddlewareException;
use Core\Exception\Handlers\RouteNotFoundException;
use Core\Exception\Log;
use Core\Exception\Whoops;
use Core\Support\AssetsNotFound;
use Core\Support\Facades\Route;
use Core\Support\LoadEnv;
use Core\Support\Routing\RegisterAllRoutes;
use Core\Support\Container\App as Container;

class Application
{
    const VERSION = '4.0.0';
    const FRAMEWORK = 'Larite';

    protected Container $container;

    /**
     * Config files to load.
     * We split them into common, http-only, and cli-only sets.
     */
    protected array $configFiles = [
        'common' => [
            '/core/Utils/helpers.php',
            '/config/app.php',
        ],
        'http' => [
            '/config/mail.php',
        ],
        'cli' => [
            // keep empty for now, add cli configs if needed
        ],
    ];

    protected array $notFound = [
        'routeExist' => '/core/Utils/routeExist.php',
    ];

    public function __construct(Container $container = null)
    {
        $this->container = $container ?? new Container();
    }

    public static function version(): string
    {
        return static::VERSION;
    }

    public static function framework(): string
    {
        return static::FRAMEWORK;
    }

    /**
     * Get service from container
     */
    public function get($key)
    {
        return $this->container->make($key);
    }

    /**
     * Boot the application
     */
    public function boot(): void
    {
        foreach ($this->getConfigFiles() as $file) {
            $this->includeFile($file);
        }

        $this->registerSingletons();

        if (config('app.app_env') !== 'production') {
            $this->registerExceptionHandler();
        }
    }

    /**
     * Dynamically pick config files based on SAPI.
     */
    protected function getConfigFiles(): array
    {
        $files = $this->configFiles['common'];

        if ($this->isCli()) {
            $files = array_merge($files, $this->configFiles['cli']);
        } else {
            $files = array_merge($files, $this->configFiles['http']);
        }

        return $files;
    }

    /**
     * Register all singletons for bootstrap
     */
    protected function registerSingletons(): void
    {
        if (!file_exists('.env')) {
            $this->registerBootstrapSingleton('whoops', [Whoops::class, 'handler']);
            $this->registerBootstrapSingleton('dotenv', LoadEnv::class, [ROOT_PATH]);
        } else {
            $this->registerBootstrapSingleton('dotenv', LoadEnv::class, [ROOT_PATH]);
            $this->registerBootstrapSingleton('whoops', [Whoops::class, 'handler']);
        }

        // We'll this only if request is http
        if (!$this->isCli()) {
            $this->registerBootstrapSingleton('assetsNotFound', [AssetsNotFound::class, 'run']);
        }
    }

    protected function isCli(): bool
    {
        return PHP_SAPI === 'cli';
    }

    /**
     * Handle bootstrapping singletons (static callables, constructors, or files)
     */
    protected function registerBootstrapSingleton(string $key, mixed $concrete, array $args = [])
    {
        $instance = null;

        // Static callable
        if (is_array($concrete) && isset($concrete[0], $concrete[1])) {
            $class = $concrete[0];
            $method = $concrete[1];
            $instance = $class::$method(...$args);
        }
        // Class name
        elseif (is_string($concrete) && class_exists($concrete)) {
            $reflection = new \ReflectionClass($concrete);
            $instance = $reflection->newInstanceArgs($args);
        }
        // File path
        elseif (is_string($concrete) && file_exists($concrete)) {
            $instance = require_once $concrete;
        }
        // Raw value
        else {
            $instance = $concrete;
        }

        $this->container->singleton($key, $instance);
    }

    /**
     * @param string $path
     * @return void
     */
    protected function includeFile(string $path): void
    {
        require_once ROOT_PATH . $path;
    }

    /**
     * @param null $commander
     * @return bool
     * @throws MiddlewareException
     */
    public function init($commander = null): bool
    {
        // Bind the default facades
        Binding::facades();

        // Register all service providers dynamically
        $this->registerServiceProviders();

        // Load routes
        RegisterAllRoutes::loadAll();

        // Commander on run if it is cli request
        $commander?->run();

        //Execute routes here
        $routeMatched = false;
        try {
            $routeMatched = Route::executeRoutes();
        } catch (MiddlewareException | RouteNotFoundException $e) {
            Log::error($e, "Not Found Exception");
            throw new MiddlewareException($e->getMessage());
        }

        if (!$routeMatched) {
            require_once ROOT_PATH . $this->notFound['routeExist'];
        }

        return true;
    }

    /**
     * @return void
     */
    protected function registerExceptionHandler(): void
    {
        $handler = new Handler(!(config('app.app_env') === 'production'));
        set_exception_handler([$handler, 'handle']);
    }

    /**
     * Dynamically register and boot all service providers
     */
    protected function registerServiceProviders(): void
    {
        $providers = config('providers'); // load array from config/providers.php

        foreach ($providers as $providerClass) {
            $provider = new $providerClass($this->container);

            // Register bindings
            if (method_exists($provider, 'register')) {
                $provider->register();
            }

            // Boot any services
            if (method_exists($provider, 'boot')) {
                $provider->boot();
            }
        }
    }

}
