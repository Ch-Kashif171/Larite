<?php

namespace Core\Database\Traits\Builder;

use Core\Database\Timestamp;
use Core\Support\Collection\Collection;

trait Getters
{
    use Wrapper;

    /**
     * @return array|\Core\Support\Collection\Collection
     * @throws \Whoops\Exception\ErrorException
     */
    public function all(): array|Collection
    {
        return $this->wrapMultiple(fn() => $this->doctrine->get());
    }

    /**
     * @return array|\Core\Support\Collection\Collection
     * @throws \Whoops\Exception\ErrorException
     */
    public function get(): array|Collection
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapMultiple(fn() => $this->doctrine->get($timestamp));
    }

    /**
     * @return mixed
     * @throws \Whoops\Exception\ErrorException
     */
    public function first()
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapSingle(fn() => $this->doctrine->first($timestamp));
    }

    /**
     * @param $columns
     * @return array
     */
    public function pluck($columns): array
    {
        return $this->doctrine->pluck($columns);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Whoops\Exception\ErrorException
     */
    public function find($id)
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapSingle(fn() => $this->doctrine->find($id, $timestamp));
    }

    public function findOrFail($id)
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapSingle(fn() => $this->doctrine->findOrFail($id, $timestamp));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function firstOrFail()
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapSingle(fn() => $this->doctrine->firstOrFail($timestamp));
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function paginate($limit)
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapPaginate(fn() => $this->doctrine->paginate($limit, $timestamp));
    }

    /**
     * @param $limit
     * @return array
     */
    public function simplePaginate($limit): array
    {
        // skip timestamp
        $timestamp = Timestamp::timestamp($this->modelClass ?? null);

        return $this->wrapSimplePaginate(fn() => $this->doctrine->simplePaginate($limit, $timestamp));
    }

}