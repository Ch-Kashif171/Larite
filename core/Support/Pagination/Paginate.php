<?php

namespace Core\Support\Pagination;

use Core\Support\Collection\Collection;
use Core\Support\Constants;
use ReturnTypeWillChange;

class Paginate implements \ArrayAccess, \IteratorAggregate, \Countable
{
    // Declare all pagination-related properties
    public mixed $total;
    public mixed $page;
    public mixed $per_page;
    public mixed $current_page;
    public mixed $last_page;
    public mixed $from;
    public mixed $to;
    public mixed $first_page_url;
    public mixed $last_page_url;
    public mixed $next_page_url;
    public mixed $prev_page_url;
    public mixed $path;

    public Collection $data;


    public function __construct(array $pagination)
    {
        foreach (Constants::KEYS as $key) {
            $this->{$key} = $pagination[$key] ?? null;
        }

        $this->data = new Collection($pagination['data'] ?? []);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];

        foreach (Constants::KEYS as $key) {
            $array[$key] = $this->{$key} ?? null;
        }

        $array['data'] = $this->data->toArray();

        return $array;
    }

    public function getIterator(): \ArrayIterator
    {
        return $this->data->getIterator();
    }

    public function count(): int
    {
        return $this->data->count();
    }

    public function __call($method, $parameters)
    {
        if (method_exists($this->data, $method)) {
            return $this->data->$method(...$parameters);
        }

        throw new \BadMethodCallException("Method {$method} does not exist.");
    }

    public function offsetExists($offset): bool
    {
        return property_exists($this, $offset);
    }

    #[ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->$offset ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->$offset);
    }
}
