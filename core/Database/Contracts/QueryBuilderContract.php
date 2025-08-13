<?php

namespace Core\Database\Contracts;

use Core\Support\Collection\Collection;

interface QueryBuilderContract
{
    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderContract
     */
    public function where($column, $operator = null, $value = null): QueryBuilderContract;

    /**
     * @param ...$fields
     * @return QueryBuilderContract
     */
    public function select(...$fields): QueryBuilderContract;

    /**
     * @return array|\Core\Support\Collection\Collection
     */
    public function all(): array|Collection;

    /**
     * @return array|Collection
     */
    public function get(): array|Collection;

    /**
     * @return mixed
     */
    public function first();

    /**
     * @return mixed
     */
    public function firstOrFail();

    /**
     * @return bool
     */
    public function exists(): bool;

    /**
     * @param $field
     * @param string $order
     * @return QueryBuilderContract
     */
    public function orderBy($field, string $order = 'ASC'): QueryBuilderContract;

    /**
     * @param $field
     * @return QueryBuilderContract
     */
    public function orderByDesc($field): QueryBuilderContract;

    /**
     * @param $limit
     * @return QueryBuilderContract
     */
    public function limit($limit): QueryBuilderContract;

    /**
     * @param string $column
     * @return int
     */
    public function count(string $column = "*"): int;

    /**
     * @param $column
     * @return mixed
     */
    public function sum($column);

    /**
     * @param $column
     * @return mixed
     */
    public function max($column);

    /**
     * @param $column
     * @return mixed
     */
    public function min($column);

    /**
     * @param $columns
     * @return array
     */
    public function pluck($columns): array;

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    public function findOrFail($id);

    /**
     * @param $column
     * @return QueryBuilderContract
     */
    public function latest($column): QueryBuilderContract;

    /**
     * @param $column
     * @return QueryBuilderContract
     */
    public function oldest($column): QueryBuilderContract;

    /**
     * @param $fields
     * @return QueryBuilderContract
     */
    public function groupBy($fields): QueryBuilderContract;

    /**
     * @param $take
     * @return QueryBuilderContract
     */
    public function take($take): QueryBuilderContract;

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderContract
     */
    public function orWhere($column, $operator = null, $value = null): QueryBuilderContract;

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderContract
     */
    public function whereDate($column, $operator = null, $value = null): QueryBuilderContract;

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderContract
     */
    public function orWhereDate($column, $operator = null, $value = null): QueryBuilderContract;

    /**
     * @param $column
     * @param $operator
     * @param $day
     * @return QueryBuilderContract
     */
    public function whereDay($column, $operator = null, $day = null): QueryBuilderContract;

    /**
     * @param $column
     * @param $operator
     * @param $day
     * @return QueryBuilderContract
     */
    public function whereDayOfWeek($column, $operator = null, $day = null): QueryBuilderContract;

    /**
     * @param $column
     * @param $operator
     * @param $time
     * @return QueryBuilderContract
     */
    public function whereTime($column, $operator = null, $time = null): QueryBuilderContract;

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderContract
     */
    public function whereMonth($column, $operator = null, $value = null): QueryBuilderContract;

    /**
     * @param $column
     * @param $operator
     * @param $year
     * @return QueryBuilderContract
     */
    public function whereYear($column, $operator = null, $year = null): QueryBuilderContract;

    /**
     * @param $column
     * @param $values
     * @return QueryBuilderContract
     */
    public function whereBetween($column, $values): QueryBuilderContract;

    /**
     * @param $column
     * @param $values
     * @return QueryBuilderContract
     */
    public function whereNotBetween($column, $values): QueryBuilderContract;

    /**
     * @param $column
     * @param $values
     * @return QueryBuilderContract
     */
    public function orWhereBetween($column, $values): QueryBuilderContract;

    /**
     * @param $column
     * @param $values
     * @return QueryBuilderContract
     */
    public function orWhereNotBetween($column, $values): QueryBuilderContract;

    /**
     * @param $column
     * @param array $values
     * @return QueryBuilderContract
     */
    public function whereIn($column, array $values): QueryBuilderContract;

    /**
     * @param $column
     * @return QueryBuilderContract
     */
    public function whereNull($column): QueryBuilderContract;

    /**
     * @param $column
     * @return QueryBuilderContract
     */
    public function whereNotNull($column): QueryBuilderContract;

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderContract
     */
    public function having($column, $operator, $value): QueryBuilderContract;

    /**
     * @param $limit
     * @return mixed
     */
    public function paginate($limit);

    /**
     * @param $limit
     * @return array|\Core\Support\Collection\Collection
     */
    public function simplePaginate($limit): array|Collection;

    /**
     * @param $data
     * @return bool
     */
    public function insert($data): bool;

    /**
     * @param $data
     * @return mixed
     */
    public function insertGetId($data);

    /**
     * @param array $fields
     * @return bool
     */
    public function update(array $fields): mixed;

    /**
     * @return bool
     */
    public function delete(): bool;

    /**
     * @param $attributes
     * @param $values
     * @return mixed
     */
    public function updateOrCreate($attributes, $values);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @param $column
     * @param int $value
     * @return bool
     */
    public function increment($column, int|string $value = 1): bool;

    /**
     * @param $column
     * @param int|string $value
     * @return bool
     */
    public function decrement($column, int|string $value = 1): bool;

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderContract
     */
    public function join($table, $column, $equal, $second_column): QueryBuilderContract;

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderContract
     */
    public function leftJoin($table, $column, $equal, $second_column): QueryBuilderContract;

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderContract
     */
    public function rightJoin($table, $column, $equal, $second_column): QueryBuilderContract;

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderContract
     */
    public function fullOuterJoin($table, $column, $equal, $second_column): QueryBuilderContract;

    /**
     * @param $relations
     * @return $this
     */
    public function with($relations): static;

    /**
     * @param $relation
     * @return $this
     */
    public function has($relation): static;

    /**
     * @param $relation
     * @param $callback
     * @return $this
     */
    public function whereHas($relation, $callback = null): static;

    /**
     * @param $relation
     * @param $callback
     * @return $this
     */
    public function withWhereHas($relation, $callback = null): static;

}