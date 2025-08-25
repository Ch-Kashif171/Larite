<?php

namespace Core\Database\Traits\Builder;

use Core\Support\Collection\Collection;

trait Getters
{
    use Wrapper;

    /**
     * @return array|Collection
     */
    public function all(): array|Collection
    {
        return new Collection($this->doctrine->get());
    }

    /**
     * @return array|Collection
     */
    public function get(): array|Collection
    {
        return new Collection($this->doctrine->get());
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return new Collection($this->doctrine->first());
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
        return new Collection($this->doctrine->find($id));
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function findOrFail($id)
    {
        return new Collection($this->doctrine->findOrFail($id));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function firstOrFail()
    {
        return new Collection($this->doctrine->firstOrFail());
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function paginate($limit)
    {
        return new Collection($this->doctrine->paginate($limit));
    }

    /**
     * @param $limit
     * @return array
     */
    public function simplePaginate($limit): array
    {
        return new Collection($this->doctrine->simplePaginate($limit));
    }

}