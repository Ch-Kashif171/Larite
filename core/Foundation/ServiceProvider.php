<?php

namespace Core\Foundation;

use Core\Support\Container\App;

abstract class ServiceProvider
{
    /**
     * The application instance.
     *
     * @var App
     */
    protected App $app;

    /**
     * Create a new service provider instance.
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * Register services in the container.
     * This method should be implemented by child classes.
     */
    abstract public function register(): void;

    /**
     * Bootstrap any services or perform additional initialization.
     * Can be optionally overridden by child classes.
     */
    public function boot(): void
    {
        // Optional: override in child classes
    }

    /**
     * Helper to bind a singleton in the container.
     */
    protected function singleton(string $key, $concrete, array $params = []): void
    {
        $this->app->singleton($key, $concrete, $params);
    }

    /**
     * Helper to bind a normal binding in the container.
     */
    protected function bind(string $key, $concrete, array $params = []): void
    {
        $this->app->bind($key, $concrete, $params);
    }

    /**
     * @param callable $callback
     * @return void
     */
    protected function routes(callable $callback): void
    {
        app()->singleton('routes', $callback);
    }

}
