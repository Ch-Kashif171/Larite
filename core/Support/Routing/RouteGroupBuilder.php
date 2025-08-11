<?php

namespace Core\Support\Routing;

use Closure;

class RouteGroupBuilder
{
    protected array $options = [];

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * Set the prefix for the group
     */
    public function prefix(string $prefix): static
    {
        $this->options['prefix'] = trim($prefix, '/');
        return $this;
    }

    /**
     * Set the middleware(s) for the group
     */
    public function middleware(string|array $middleware): static
    {
        $this->options['middleware'] = (array) $middleware;
        return $this;
    }

    /**
     * @param string|array $namespace
     * @return $this
     */
    public function namespace(string|array $namespace): static
    {
        $this->options['namespace'] = (array) $namespace;
        return $this;
    }

    /**
     * Apply the group options and run the callback
     */
    public function group(Closure $callback): mixed
    {
        return RouteGroup::apply($this->options, $callback);
    }
}
