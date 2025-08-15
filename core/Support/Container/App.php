<?php

namespace Core\Support\Container;

class App
{
    protected array $bindings = [];
    protected array $instances = [];

    /**
     * Bind a class or closure
     */
    public function bind(string $key, mixed $concrete, array $args = [])
    {
        $this->bindings[$key] = [
            'concrete' => $concrete,
            'args' => $args,
            'singleton' => false
        ];
    }

    /**
     * Bind a singleton (supports class name, closure, or raw object)
     */
    public function singleton(string $key, mixed $concrete, array $args = [])
    {
        if (is_object($concrete) && !($concrete instanceof \Closure)) {
            // Raw object → store immediately
            $this->instances[$key] = $concrete;
        } else {
            // Lazy singleton
            $this->bindings[$key] = [
                'concrete' => $concrete,
                'args' => $args,
                'singleton' => true
            ];
        }
    }

    /**
     * Resolve a key
     */
    public function make(string $key): mixed
    {
        // Already instantiated singleton
        if (isset($this->instances[$key])) {
            return $this->instances[$key];
        }

        // Check binding exists
        if (!isset($this->bindings[$key])) {
            throw new \RuntimeException("Nothing bound in the container for key [$key]");
        }

        $binding = $this->bindings[$key];
        $object = $this->resolve($binding['concrete'], $binding['args']);

        // If singleton, store instance
        if ($binding['singleton']) {
            $this->instances[$key] = $object;
        }

        return $object;
    }

    /**
     * Instantiate concrete (class name, closure, or callable)
     */
    protected function resolve(mixed $concrete, array $args = []): mixed
    {
        if ($concrete instanceof \Closure) {
            return $concrete($this);
        }

        if (is_array($concrete) && isset($concrete[0], $concrete[1])) {
            $class = $concrete[0];
            $method = $concrete[1];
            if (class_exists($class) && method_exists($class, $method)) {
                return $class::$method(...$args);
            }
        }

        if (is_string($concrete) && class_exists($concrete)) {
            $reflection = new \ReflectionClass($concrete);
            return $reflection->newInstanceArgs($args);
        }

        return $concrete; // raw object or value
    }
}
