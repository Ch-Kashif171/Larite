<?php

namespace Core\Support\Collection;

class Collection implements \ArrayAccess, \IteratorAggregate, \Countable
{
    protected  $items;

    public function __construct($items = [])
    {
        $this->mapItems($items);
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function ($item) {
            if (is_object($item) && method_exists($item, 'toArray')) {
                return $item->toArray();
            } elseif (is_array($item)) {
                return $this->recursiveToArray($item);
            }
            return $item;
        }, $this->items);
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function map(callable $callback): static
    {
        return new static(array_map($callback, $this->items));
    }

    /**
     * @param callable|null $callback
     * @return $this
     */
    public function filter(callable $callback = null): static
    {
        return new static(array_filter($this->items, $callback));
    }

    /**
     * @param callable|null $callback
     * @param $default
     * @return mixed|null
     */
    public function first(callable $callback = null, $default = null)
    {
        foreach ($this->items as $key => $item) {
            if (is_null($callback) || $callback($item, $key)) {
                return $item;
            }
        }
        return $default;
    }

    /**
     * @param callable|null $callback
     * @param $default
     * @return mixed|null
     */
    public function last(callable $callback = null, $default = null)
    {
        return $this->reverse()->first($callback, $default);
    }

    /**
     * @return $this
     */
    public function reverse(): static
    {
        return new static(array_reverse($this->items, true));
    }


    // ArrayAccess
    public function offsetExists($offset): bool { return isset($this->items[$offset]); }
    public function offsetGet($offset): mixed { return $this->items[$offset]; }
    public function offsetSet($offset, $value): void { $this->items[$offset] = $value; }
    public function offsetUnset($offset): void { unset($this->items[$offset]); }

    // IteratorAggregate
    public function getIterator(): \Traversable { return new \ArrayIterator($this->items); }

    // Countable
    public function count(): int { return count($this->items); }

    // For convenience
    public function all(): array { return $this->items; }

    /**
     * @param $value
     * @return array
     */
    private function recursiveToArray($value): array
    {
        if (is_object($value) && method_exists($value, 'toArray')) {
            return $value->toArray();
        } elseif (is_array($value)) {
            $result = [];
            foreach ($value as $k => $v) {
                $result[$k] = $this->recursiveToArray($v);
            }
            return $result;
        }
        return $value;
    }

    /**
     * @param $items
     * @return void
     */
    private function mapItems($items)
    {
        if (is_null($items)) {
            $this->items = [];
        } elseif (is_array($items)) {
            $this->items = $items;
        } elseif ($items instanceof \Traversable) {
            $this->items = iterator_to_array($items);
        } elseif (is_object($items)) {
            $this->items = [$items]; // wrap single model/object
        } else {
            throw new \InvalidArgumentException('Invalid items provided to Collection.');
        }
    }
} 