<?php

namespace Core\Support\Traits;

use Core\Support\Routing\RouteBuilder;
use Core\Support\Str;

trait RouteRegistrar
{
    /**
     * Register a route for a given HTTP method (GET, POST, etc.)
     * @param RouteContext $context
     * @param array $routes
     * @param array $dynamicRoutes
     * @param array $routeHandlers
     * @return RouteBuilder
     */
    protected static function registerRoute(
        RouteContext $context,
        array &$routes,
        array &$dynamicRoutes,
        array &$routeHandlers
    ): RouteBuilder
    {
        $action = self::buildAction($context);

        if (self::isDynamicRoute($action)) {
            self::registerDynamicRoute($context, $action, $dynamicRoutes);
        } else {
            self::registerStaticRoute($context, $action, $routes, $routeHandlers);
        }

        return new RouteBuilder($action, $context->httpMethod, $context->controllerMethod);
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
        $plural = $name;
        $singular = Str::singular($name); // crude singularization

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

    /**
     * @param RouteContext $context
     * @param string $action
     * @param array $dynamicRoutes
     * @return void
     */
    protected static function registerDynamicRoute(
        RouteContext $context,
        string $action,
        array &$dynamicRoutes
    ): void
    {
        $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $action);
        $regex = '#^' . $pattern . '$#';

        $dynamicRoutes[$context->httpMethod][] = [
            'regex' => $regex,
            'route' => $action,
            'controller' => $context->controllerMethod,
            'middleware' => $context->middleware,
            'namespace' => $context->namespace,
        ];
    }

    /**
     * @param RouteContext $context
     * @param string $action
     * @param array $routes
     * @param array $routeHandlers
     * @return void
     */
    protected static function registerStaticRoute(
        RouteContext $context,
        string $action,
        array &$routes,
        array &$routeHandlers
    ): void
    {
        $routes[$context->httpMethod][] = $action;

        $routeKey = $context->httpMethod . ':' . $action;
        $routeHandlers[$routeKey] = [
            'controller' => $context->controllerMethod,
            'middleware' => $context->middleware,
            'namespace' => $context->namespace,
        ];
    }

    /**
     * @param RouteContext $context
     * @return string
     */
    protected static function buildAction(RouteContext $context): string
    {
        $action = ltrim($context->action, '/');
        $route = '/' . $action;
        return $context->prefix ? '/' . $context->prefix . $route : $route;
    }

    /**
     * @param string $action
     * @return bool
     */
    protected static function isDynamicRoute(string $action): bool
    {
        return str_contains($action, '{');
    }

}
