<?php

namespace Core\Support\Routing;

use Closure;
use Core\Exception\Handlers\RouteNotFoundException;
use Core\Support\Constants;
use Core\Support\Traits\Csrf\CsrfToken;
use Core\Support\Traits\Middleware;
use Core\Support\Traits\RouteParam;
use Core\Support\Traits\RouteRegistrar;
use Core\Support\Traits\RouteContext;

class Router
{
    use CsrfToken, Middleware, RouteParam, RouteRegistrar;

    public static $prefix;
    public static $namespace;
    public static $middleware;
    public static $param = null;
    public static array $routes = [
        'GET' => [],
        'POST' => [],
    ];
    public static array $routeMiddleware = [];
    private static array $routeHandlers = [];
    private static array $namedRoutes = [];
    private static array $dynamicRoutes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * @param $uri
     * @param $action
     * @return RouteBuilder
     */
    public static function get($uri, $action): RouteBuilder
    {
        if ($action instanceof Closure) {
            $action = ['closure' => $action];
        }

        $context = new RouteContext(
            Constants::METHODS['GET'],
            $uri,
            $action,
            static::$prefix,
            static::$namespace,
            static::$middleware
        );

        return static::registerRoute(
            $context,
            self::$routes,
            self::$dynamicRoutes,
            self::$routeHandlers
        );
    }

    /**
     * @param $uri
     * @param $action
     * @return RouteBuilder
     */
    public static function post($uri, $action): RouteBuilder
    {
        if ($action instanceof Closure) {
            $action = ['closure' => $action];
        }

        $context = new RouteContext(
            Constants::METHODS['POST'],
            $uri,
            $action,
            static::$prefix,
            static::$namespace,
            static::$middleware
        );

        return static::registerRoute(
            $context,
            self::$routes,
            self::$dynamicRoutes,
            self::$routeHandlers
        );
    }

    /**
     * @param $uri
     * @param $action
     * @return RouteBuilder
     */
    public static function put($uri, $action): RouteBuilder
    {
        if ($action instanceof Closure) {
            $action = ['closure' => $action];
        }

        $context = new RouteContext(
            Constants::METHODS['PUT'],
            $uri,
            $action,
            static::$prefix,
            static::$namespace,
            static::$middleware
        );

        return static::registerRoute(
            $context,
            self::$routes,
            self::$dynamicRoutes,
            self::$routeHandlers
        );
    }

    /**
     * @param $uri
     * @param $action
     * @return RouteBuilder
     */
    public static function delete($uri, $action): RouteBuilder
    {
        if ($action instanceof Closure) {
            $action = ['closure' => $action];
        }

        $context = new RouteContext(
            Constants::METHODS['DELETE'],
            $uri,
            $action,
            static::$prefix,
            static::$namespace,
            static::$middleware
        );

        return static::registerRoute(
            $context,
            self::$routes,
            self::$dynamicRoutes,
            self::$routeHandlers
        );
    }

    /**
     * @param $uri
     * @param $action
     * @return RouteBuilder
     */
    public static function patch($uri, $action): RouteBuilder
    {
        if ($action instanceof Closure) {
            $action = ['closure' => $action];
        }

        $context = new RouteContext(
            Constants::METHODS['PATCH'],
            $uri,
            $action,
            static::$prefix,
            static::$namespace,
            static::$middleware
        );

        return static::registerRoute(
            $context,
            self::$routes,
            self::$dynamicRoutes,
            self::$routeHandlers
        );
    }

    /**
     * @return bool
     * @throws RouteNotFoundException
     * @throws \Exception
     */
    public static function executeRoutes(): bool
    {
        return RouteExecutor::execute(
            $_SERVER['REQUEST_METHOD'] ?? 'GET',
            RouteAction::current(),
            self::$routeHandlers,
            self::$dynamicRoutes,
            self::$routeMiddleware
        );
    }

    /**
     * @param $options
     * @param Closure $callback
     * @return mixed
     */
    public static function group($options, Closure $callback): mixed
    {
        return RouteGroup::apply($options, $callback);
    }

    /**
     * @param array|null $disable
     * @return void
     */
    public static function authenticate(array $disable = null)
    {
        RouteAuth::load($disable);
    }

    /**
     * To check single route base middleware
     * @param string $routeKey
     * @param array $middlewares
     * @return void
     */
    public static function addRouteMiddleware(string $routeKey, array $middlewares): void
    {
        self::$routeMiddleware[$routeKey] = $middlewares;
    }

    /**
     * @return array
     */
    public static function getRouteMiddleware(): array
    {
        return self::$routeMiddleware;
    }

    /**
     * Get a named route URL
     * @param string $name
     * @param array $parameters
     * @return string
     * @throws RouteNotFoundException
     */
    public static function getNamedRoute(string $name, array $parameters = []): string
    {
        if (!isset(self::$namedRoutes[$name])) {
            throw new RouteNotFoundException("Route '{$name}' not found.");
        }

        $route = self::$namedRoutes[$name];
        $uri = $route['uri'];

        // Replace parameters in the URI
        foreach ($parameters as $key => $value) {
            $uri = str_replace('{' . $key . '}', $value, $uri);
        }

        return url($uri);
    }

    /**
     * Get all named routes
     * @return array
     */
    public static function getNamedRoutes(): array
    {
        return self::$namedRoutes;
    }

    /**
     * Register a named route
     * @param string $name
     * @param string $uri
     * @param string $method
     * @param array $handler
     * @return void
     */
    public static function registerNamedRoute(string $name, string $uri, string $method, array $handler): void
    {
        self::$namedRoutes[$name] = [
            'uri' => $uri,
            'method' => $method,
            'handler' => $handler
        ];
    }

    /**
     * Create resource routes for a controller
     * @param string $name
     * @param string $controller
     * @param array $options
     * @return void
     */
    public static function resource(string $name, string $controller, array $options = []): void
    {
        $singular = $name;
        $plural = $name;
        
        // Index - GET /{resource}
        self::get("/{$plural}", [$controller, 'index'])->name("{$name}.index");
        
        // Create - GET /{resource}/create
        self::get("/{$plural}/create", [$controller, 'create'])->name("{$name}.create");
        
        // Store - POST /{resource}
        self::post("/{$plural}", [$controller, 'store'])->name("{$name}.store");
        
        // Show - GET /{resource}/{id}
        self::get("/{$plural}/{{$singular}}", [$controller, 'show'])->name("{$name}.show");
        
        // Edit - GET /{resource}/{id}/edit
        self::get("/{$plural}/{{$singular}}/edit", [$controller, 'edit'])->name("{$name}.edit");
        
        // Update - PUT/PATCH /{resource}/{id}
        self::put("/{$plural}/{{$singular}}", [$controller, 'update'])->name("{$name}.update");
        self::patch("/{$plural}/{{$singular}}", [$controller, 'update'])->name("{$name}.update");
        
        // Destroy - DELETE /{resource}/{id}
        self::delete("/{$plural}/{{$singular}}", [$controller, 'destroy'])->name("{$name}.destroy");
    }
}
