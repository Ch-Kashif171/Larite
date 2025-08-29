<?php

namespace Core\Database\Traits\Builder;

use Core\Database\Timestamp;
use Core\Support\Collection\Collection;

trait ORMGetters
{
    use Wrapper;

    /**
     * @return array|Collection
     */
    public function all(): array|Collection
    {
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);
        return $this->wrapMultiple(fn() => $this->doctrine->get($timestamp, $this->hidden));
    }

    /**
     * @return array|Collection
     */
    public function get(): array|Collection
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapMultiple(fn() => $this->doctrine->get($timestamp, $this->hidden));
    }

    /**
     * @return mixed
     */
    public function first(): mixed
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapSingle(fn() => $this->doctrine->first($timestamp, $this->hidden));
    }

    /**
     * @param string $column
     * @return mixed
     */
    public function value(string $column): mixed
    {
        return $this->doctrine->value($column);
    }

    /**
     * @param $columns
     * @return Collection
     */
    public function pluck($columns): Collection
    {
        return $this->doctrine->pluck(...func_get_args());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id): mixed
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapSingle(fn() => $this->doctrine->find($id, $timestamp, $this->hidden));
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function findOrFail($id): mixed
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapSingle(fn() => $this->doctrine->findOrFail($id, $timestamp, $this->hidden));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function firstOrFail()
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapSingle(fn() => $this->doctrine->firstOrFail($timestamp, $this->hidden));
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function paginate($limit): mixed
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapPaginate(fn() => $this->doctrine->paginate($limit, $timestamp, $this->hidden));
    }

    /**
     * @param $limit
     * @return array
     */
    public function simplePaginate($limit): array
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapSimplePaginate(fn() => $this->doctrine->simplePaginate($limit, $timestamp, $this->hidden));
    }

}