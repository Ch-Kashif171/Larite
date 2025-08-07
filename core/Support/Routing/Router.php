<?php

namespace Core\Support\Routing;

use Closure;
use Core\Exception\Handlers\RouteNotFoundException;
use Core\Support\Constants;
use Core\Support\Str;
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
        'PUT' => [],
        'PATCH' => [],
        'DELETE' => [],
    ];
    public static array $routeMiddleware = [];
    private static array $routeHandlers = [];
    private static array $namedRoutes = [];
    private static array $dynamicRoutes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'PATCH' => [],
        'DELETE' => [],
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

        [$uri, $usedParams] = self::replaceUriPlaceholders($uri, $parameters);

        $uri = self::cleanUri($uri);

        $remainingParams = array_diff_key($parameters, array_flip($usedParams));
        if (!empty($remainingParams)) {
            $uri .= '?' . http_build_query($remainingParams);
        }

        return url($uri);
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @return array
     * @throws RouteNotFoundException
     */
    private static function replaceUriPlaceholders(string $uri, array $parameters): array
    {
        $usedParams = [];

        $uri = preg_replace_callback('/\{(\w+)(\?)?\}/', function ($matches) use ($parameters, &$usedParams) {
            $key = $matches[1];
            $optional = isset($matches[2]);

            if (array_key_exists($key, $parameters)) {
                $usedParams[] = $key;
                return rawurlencode($parameters[$key]);
            }

            if ($optional) {
                return '';
            }

            throw new RouteNotFoundException("Missing required parameter '{$key}' for route.");
        }, $uri);

        return [$uri, $usedParams];
    }

    /**
     * @param string $uri
     * @return string
     */
    private static function cleanUri(string $uri): string
    {
        $uri = preg_replace('#/{2,}#', '/', $uri);
        return rtrim($uri, '/');
    }

    /**
     * Get all named routes
     * @return array
     */
    public static function getNamedRoutes(): array
    {
        return self::$namedRoutes;
    }

}
