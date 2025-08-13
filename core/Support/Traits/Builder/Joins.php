<?php

namespace Core\Support\Traits\Builder;

use Core\Database\Contracts\QueryBuilderContract;
use Core\Database\QueryBuilder;
use Core\Exception\Handlers\DBException;

trait Joins
{
    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderContract
     * @throws DBException
     */
    public static function join($table, $column, $equal, $second_column): QueryBuilderContract
    {
        $instance = new static();
        return (new QueryBuilder($instance->table, $instance->hidden))->join($table, $column, $equal, $second_column);
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderContract
     * @throws DBException
     */
    public static function leftJoin($table, $column, $equal, $second_column): QueryBuilderContract
    {
        $instance = new static();
        return (new QueryBuilder($instance->table, $instance->hidden))->leftJoin($table, $column, $equal, $second_column);
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return \Core\Database\Contracts\QueryBuilderContract
     * @throws DBException
     */
    public static function rightJoin($table, $column, $equal, $second_column): QueryBuilderContract
    {
        $instance = new static();
        return (new QueryBuilder($instance->table, $instance->hidden))->rightJoin($table, $column, $equal, $second_column);
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return \Core\Database\Contracts\QueryBuilderContract
     * @throws DBException
     */
    public static function fullOuterJoin($table, $column, $equal, $second_column): QueryBuilderContract
    {
        $instance = new static();
        return (new QueryBuilder($instance->table, $instance->hidden))->fullOuterJoin($table, $column, $equal, $second_column);
    }
}