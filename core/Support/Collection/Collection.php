<?php

namespace Core\Support\Collection;

class Collection implements \ArrayAccess, \IteratorAggregate, \Countable
{
    protected  $items;

    public function __construct($items = [])
    {
        $this->items = $this->getArrayableItems($items);
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

    /**
     * @param int $depth
     * @return $this
     */
    public function flatten(int $depth = 0): static
    {
        $result = [];

        array_walk_recursive($this->items, function ($item) use (&$result) {
            $result[] = $item;
        });

        return new static($result);
    }

    /**
     * @return $this
     */
    public function collapse(): static
    {
        $results = [];

        foreach ($this->items as $values) {
            if (is_array($values) || $values instanceof self) {
                foreach ($values as $value) {
                    $results[] = $value;
                }
            }
        }

        return new static($results);
    }

    /**
     * @return $this
     */
    public function flip(): static
    {
        return new static(array_flip($this->items));
    }

    /**
     * @param string $keyField
     * @param string $valueField
     * @return $this
     */
    public function safeFlip(string $keyField = 'id', string $valueField = 'name'): static
    {
        return $this->mapWithKeys(function ($item) use ($keyField, $valueField) {
            return [$item->$keyField => $item->$valueField];
        });
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function mapWithKeys(callable $callback): static
    {
        $result = [];

        foreach ($this->items as $key => $value) {
            $assoc = $callback($value, $key);

            if (!is_array($assoc) || count($assoc) !== 1) {
                throw new \InvalidArgumentException("Callback must return an associative array with one key-value pair.");
            }

            foreach ($assoc as $mapKey => $mapValue) {
                $result[$mapKey] = $mapValue;
            }
        }

        return new static($result);
    }


    /**
     * @param string $valueKey
     * @param string|null $keyKey
     * @return $this
     */
    public function pluck(string $valueKey, ?string $keyKey = null): static
    {
        $results = [];

        foreach ($this->items as $item) {
            // Get value
            $value = is_array($item) ? ($item[$valueKey] ?? null) : ($item->{$valueKey} ?? null);

            if ($keyKey === null) {
                $results[] = $value;
            } else {
                // Get key
                $key = is_array($item) ? ($item[$keyKey] ?? null) : ($item->{$keyKey} ?? null);
                if ($key !== null) {
                    $results[$key] = $value;
                }
            }
        }

        return new static($results);
    }


    /**
     * @param callable $callback
     * @return $this
     */
    public function each(callable $callback): static
    {
        foreach ($this->items as $key => $item) {
            $callback($item, $key);
        }

        return $this;
    }

    /**
     * @param callable|string $keyOrCallback
     * @param $value
     * @return bool
     */
    public function contains(callable|string $keyOrCallback, $value = null): bool
    {
        if (is_callable($keyOrCallback)) {
            foreach ($this->items as $key => $item) {
                if ($keyOrCallback($item, $key)) {
                    return true;
                }
            }
        } elseif (is_null($value)) {
            return in_array($keyOrCallback, $this->items, true);
        } else {
            foreach ($this->items as $item) {
                if ((is_array($item) && ($item[$keyOrCallback] ?? null) === $value) ||
                    (is_object($item) && ($item->{$keyOrCallback} ?? null) === $value)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * @return $this
     */
    public function keys(): static
    {
        return new static(array_keys($this->items));
    }

    /**
     * @return $this
     */
    public function values(): static
    {
        return new static(array_values($this->items));
    }

    /**
     * @param callable|null $callback
     * @return $this
     */
    public function unique(?callable $callback = null): static
    {
        $exists = [];
        $results = [];

        foreach ($this->items as $key => $item) {
            $value = is_callable($callback) ? $callback($item, $key) : $item;

            if (!in_array($value, $exists, true)) {
                $exists[] = $value;
                $results[$key] = $item;
            }
        }

        return new static($results);
    }

    /**
     * @param callable|null $callback
     * @return $this
     */
    public function sort(callable $callback = null): static
    {
        $items = $this->items;
        $callback ? uasort($items, $callback) : asort($items);
        return new static($items);
    }

    /**
     * @param callable|null $callback
     * @return $this
     */
    public function sortDesc(callable $callback = null): static
    {
        $items = $this->items;
        $callback ? uasort($items, fn($a, $b) => $callback($b, $a)) : arsort($items);
        return new static($items);
    }

    /**
     * @param $key
     * @return $this
     */
    public function groupBy($key): static
    {
        $results = [];

        foreach ($this->items as $item) {
            $groupKey = is_callable($key)
                ? $key($item)
                : (is_array($item) ? $item[$key] ?? null : $item->{$key} ?? null);

            $results[$groupKey][] = $item;
        }

        return new static($results);
    }

    /**
     * @param int $size
     * @return $this
     */
    public function chunk(int $size): static
    {
        if ($size <= 0) {
            throw new \InvalidArgumentException("Chunk size must be greater than zero.");
        }

        return new static(array_chunk($this->items, $size));
    }

    /**
     * @param $items
     * @return $this
     */
    public function merge($items): static
    {
        $items = $items instanceof self ? $items->all() : (array)$items;

        return new static(array_merge($this->items, $items));
    }

    /**
     * @param int $size
     * @param $value
     * @return $this
     */
    public function pad(int $size, $value): static
    {
        return new static(array_pad($this->items, $size, $value));
    }

    /**
     * @param int $offset
     * @param int|null $length
     * @return $this
     */
    public function slice(int $offset, ?int $length = null): static
    {
        return new static(array_slice($this->items, $offset, $length, true));
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function take(int $limit): static
    {
        if ($limit < 0) {
            return $this->slice($limit, abs($limit));
        }

        return $this->slice(0, $limit);
    }

    /**
     * @return $this
     */
    public function shuffle(): static
    {
        $shuffled = $this->items;
        shuffle($shuffled);
        return new static($shuffled);
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
     * @return array
     */
    private function getArrayableItems($items): array
    {
        return match (true) {
            is_null($items) => [],
            is_array($items) => $items,
            $items instanceof \Traversable => iterator_to_array($items),
            is_object($items) => [$items], // Wrap single object/model
            default => throw new \InvalidArgumentException('Invalid items provided to Collection.'),
        };
    }

} 