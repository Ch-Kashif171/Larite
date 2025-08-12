<?php

namespace Core\Support\Traits\Builder;

use Core\Database\QueryBuilder;
use Core\Database\QueryBuilderInterface;
use Core\Exception\Handlers\DBException;

trait Clauses
{
    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @return QueryBuilderInterface
     * @throws DBException
     */
    public static function where($column, $operator = null, $value = null): QueryBuilderInterface
    {
        $instance = new static();
        return (new QueryBuilder($instance->table, $instance->hidden, static::class))->where(...func_get_args());
    }

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @return QueryBuilderInterface
     * @throws DBException
     */
    public static function orWhere($column, $operator = null, $value = null): QueryBuilderInterface
    {
        $instance = new static();
        return (new QueryBuilder($instance->table, $instance->hidden, static::class))->orWhere(...func_get_args());
    }

    /**
     * @param $column
     * @param $value
     * @return QueryBuilderInterface
     * @throws DBException
     */
    public static function whereIn($column, $value): QueryBuilderInterface
    {
        $instance = new static();
        return (new QueryBuilder($instance->table, $instance->hidden, static::class))->whereIn($column, $value);
    }

    /**
     * @param $column
     * @return QueryBuilderInterface
     * @throws DBException
     */
    public static function whereNull($column): QueryBuilderInterface
    {
        $instance = new static();
        return (new QueryBuilder($instance->table, $instance->hidden, static::class))->whereNull($column);
    }

    /**
     * @param $column
     * @return QueryBuilderInterface
     * @throws DBException
     */
    public static function whereNotNull($column): QueryBuilderInterface
    {
        $instance = new static();
        return (new QueryBuilder($instance->table, $instance->hidden, static::class))->whereNotNull($column);
    }

    /**
     * @param $column
     * @param $condition
     * @param $value
     * @return QueryBuilderInterface
     * @throws DBException
     */
    public static function having($column, $condition, $value): QueryBuilderInterface
    {
        $instance = new static();
        return (new QueryBuilder($instance->table, $instance->hidden, static::class))->having($column, $condition, $value);
    }
}