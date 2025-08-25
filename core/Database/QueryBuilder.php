<?php

namespace Core\Database;

use Core\Database\Traits\Builder\Aggregators;
use Core\Database\Traits\Builder\Getters;
use Core\Exception\Handlers\DBException;
use Core\Support\Constants;
use Whoops\Exception\ErrorException;

class QueryBuilder
{
    use Getters, Aggregators;

    protected Doctrine $doctrine;
    protected $hidden = [];
    protected $modelClass;
    protected array $with = [];
    protected bool $isTimestamp = false;

    /**
     * @param $table
     * @param null $hidden
     * @param null $modelClass
     * @param bool $isTimestamp
     * @throws DBException
     */
    public function __construct($table, $hidden = null, $modelClass = null, bool $isTimestamp = false)
    {
        $this->doctrine = new Doctrine($table);
        $this->hidden = $hidden;
        $this->modelClass = $modelClass;
        $this->isTimestamp = $isTimestamp;
    }

    /**
     * @param ...$fields
     * @return QueryBuilder
     * @throws DBException
     */
    public function select(...$fields): QueryBuilder
    {
        $this->doctrine = $this->doctrine->select(...$fields);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $field
     * @param string $order
     * @return QueryBuilder
     */
    public function orderBy($field, string $order = 'ASC'): QueryBuilder
    {
        $this->doctrine = $this->doctrine->orderBy($field, $order);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $field
     * @return QueryBuilder
     */
    public function orderByDesc($field): QueryBuilder
    {
        $this->doctrine = $this->doctrine->orderByDesc($field);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $limit
     * @return QueryBuilder
     */
    public function limit($limit): QueryBuilder
    {
        $this->doctrine = $this->doctrine->limit($limit);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilder
     */
    public function latest($column): QueryBuilder
    {
        $this->doctrine = $this->doctrine->orderByDesc($column);
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilder
     */
    public function oldest($column): QueryBuilder
    {
        $this->doctrine = $this->doctrine->orderBy($column);
        return $this;
    }

    /**
     * @param $fields
     * @return QueryBuilder
     */
    public function groupBy($fields): QueryBuilder
    {
        $this->doctrine = $this->doctrine->groupBy($fields);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $take
     * @return QueryBuilder
     */
    public function take($take): QueryBuilder
    {
        $this->doctrine = $this->doctrine->take($take);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $offset
     * @return QueryBuilder
     */
    public function offset($offset): QueryBuilder
    {
        $this->doctrine = $this->doctrine->offset($offset);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilder
     */
    public function where($column, $operator = null, $value = null): QueryBuilder
    {
        return $this->addWhere('where', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilder
     */
    public function orWhere($column, $operator = null, $value = null): QueryBuilder
    {
        return $this->addWhere('orWhere', ...func_get_args());
    }

    /**
     * @param $column
     * @param array $values
     * @return QueryBuilder
     */
    public function whereIn($column, array $values): QueryBuilder
    {
        $this->doctrine = $this->doctrine->whereIn($column, $values);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilder
     */
    public function whereNull($column): QueryBuilder
    {
        $this->doctrine = $this->doctrine->whereNull($column);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilder
     */
    public function whereNotNull($column): QueryBuilder
    {
        $this->doctrine = $this->doctrine->whereNotNull($column);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilder
     */
    public function whereDate($column, $operator = null, $value = null): QueryBuilder
    {
        return $this->addWhere('whereDate', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilder
     */
    public function orWhereDate($column, $operator = null, $value = null): QueryBuilder
    {
        return $this->addWhere('orWhereDate', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $day
     * @return $this
     */
    public function whereDay($column, $operator = null, $day = null): static
    {
        return $this->addWhere('whereDay', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $day
     * @return $this
     */
    public function whereDayOfWeek($column, $operator = null, $day = null): static
    {
        return $this->addWhere('whereDayOfWeek', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $time
     * @return $this
     */
    public function whereTime($column, $operator = null, $time = null): static
    {
        return $this->addWhere('whereTime', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilder
     */
    public function whereMonth($column, $operator = null, $value = null): QueryBuilder
    {
        return $this->addWhere('whereMonth', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $year
     * @return QueryBuilder
     */
    public function whereYear($column, $operator = null, $year = null): QueryBuilder
    {
        return $this->addWhere('whereYear', ...func_get_args());
    }


    /**
     * @param $column
     * @param $values
     * @return QueryBuilder
     */
    public function whereBetween($column, $values): QueryBuilder
    {
        return $this->addWhere('whereBetween', ...func_get_args());
    }

    /**
     * @param $column
     * @param $values
     * @return QueryBuilder
     */
    public function whereNotBetween($column, $values): QueryBuilder
    {
        return $this->addWhere('whereNotBetween', ...func_get_args());
    }

    /**
     * @param $column
     * @param $values
     * @return QueryBuilder
     */
    public function orWhereBetween($column, $values): QueryBuilder
    {
        return $this->addWhere('orWhereBetween', ...func_get_args());
    }

    /**
     * @param $column
     * @param $values
     * @return QueryBuilder
     */
    public function orWhereNotBetween($column, $values): QueryBuilder
    {
        return $this->addWhere('orWhereNotBetween', ...func_get_args());
    }

    /**
     * Handles both where and orWhere calls with flexible arguments.
     * @param string $method 'where' or 'orWhere'
     * @param mixed $column
     * @param mixed|null $operator
     * @param mixed|null $value
     * @return QueryBuilder
     */
    private function addWhere(string $method, mixed $column, mixed $operator = null, mixed $value = null): QueryBuilder
    {
        // Handle array of conditions
        if (is_array($column) && !in_array($method, Constants::WHERE_BETWEENS)) {
            foreach ($column as $key => $val) {
                if (is_array($val) && count($val) === 2) {
                    [$op, $v] = $val;
                    $this->doctrine = $this->doctrine->$method($key, $op, $v);
                } else {
                    $this->doctrine = $this->doctrine->$method($key, '=', $val);
                }
            }
            return $this;
        }

        // Special case: Between / NotBetween (expects exactly two args)
        if (in_array($method, Constants::WHERE_BETWEENS)) {
            $this->doctrine = $this->doctrine->$method($column, $operator);
            return $this;
        }

        // Default behavior: if only two params, assume '='
        if (func_num_args() === 3) {
            $value = $operator;
            $operator = '=';
        }

        $this->doctrine = $this->doctrine->$method($column, $operator, $value);

        return $this;
    }


    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilder
     */
    public function having($column, $operator, $value): QueryBuilder
    {
        $this->doctrine = $this->doctrine->having($column, $operator, $value);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $data
     * @return bool
     * @throws ErrorException
     */
    public function insert($data): bool
    {
        return $this->doctrine->insert($data);
    }

    /**
     * @param $data
     * @return string
     * @throws ErrorException
     */
    public function insertGetId($data)
    {
        return $this->doctrine->insertGetId($data);
    }

    /**
     * @param $fields
     * @return bool
     * @throws ErrorException
     */
    public function update(array $fields): mixed
    {
        return $this->doctrine->update($fields);
    }

    /**
     * @return bool
     * @throws ErrorException
     */
    public function delete(): bool
    {
        return $this->doctrine->delete();
    }

    /**
     * @throws DBException
     */
    public function truncate(): bool
    {
        return $this->doctrine->truncate();
    }

    /**
     * @param $attributes
     * @param $values
     * @return mixed
     * @throws ErrorException
     */
    public function updateOrCreate($attributes, $values): mixed
    {
        return $this->doctrine->updateOrCreate($attributes, $values);
    }

    /**
     * @param array $attributes
     * @return mixed
     * @throws ErrorException
     */
    public function create(array $attributes): mixed
    {
        return $this->doctrine->create($attributes);
    }

    /**
     * @param array $rows
     * @return bool
     * @throws ErrorException
     */
    public function createMany(array $rows): bool
    {
        return $this->doctrine->createMany($rows);
    }

    /**
     * @param $sql
     * @return bool
     * @throws ErrorException
     */
    public static function rawQuery($sql)
    {
        $doctrine = new Doctrine();
        return $doctrine->rawQuery($sql);
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilder
     */
    public function join($table, $column, $equal, $second_column): QueryBuilder
    {
        $this->doctrine = $this->doctrine->join($table, $column, $equal, $second_column);
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilder
     */
    public function leftJoin($table, $column, $equal, $second_column): QueryBuilder
    {
        $this->doctrine = $this->doctrine->leftJoin($table, $column, $equal, $second_column);
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilder
     */
    public function rightJoin($table, $column, $equal, $second_column): QueryBuilder
    {
        $this->doctrine = $this->doctrine->rightJoin($table, $column, $equal, $second_column);
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilder
     */
    public function fullOuterJoin($table, $column, $equal, $second_column): QueryBuilder
    {
        $this->doctrine = $this->doctrine->fullOuterJoin($table, $column, $equal, $second_column);
        return $this;
    }

} 