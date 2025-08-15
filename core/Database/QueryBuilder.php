<?php

namespace Core\Database;


use Core\Database\Contracts\QueryBuilderContract;
use Core\Exception\Handlers\DBException;
use Core\Support\Constants;
use Core\Support\Traits\Builder\Aggregators;
use Core\Support\Traits\Builder\EagerLoading;
use Core\Support\Traits\Builder\Getters;
use Core\Support\Traits\Builder\MakeResult;
use Whoops\Exception\ErrorException;

class QueryBuilder implements QueryBuilderContract
{
    use MakeResult, Getters, Aggregators, EagerLoading;

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
     * @return QueryBuilderContract
     * @throws DBException
     */
    public function select(...$fields): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->select(...$fields);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $field
     * @param string $order
     * @return QueryBuilderContract
     */
    public function orderBy($field, string $order = 'ASC'): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->orderBy($field, $order);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $field
     * @return QueryBuilderContract
     */
    public function orderByDesc($field): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->orderByDesc($field);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $limit
     * @return QueryBuilderContract
     */
    public function limit($limit): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->limit($limit);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilderContract
     */
    public function latest($column): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->orderByDesc($column);
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilderContract
     */
    public function oldest($column): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->orderBy($column);
        return $this;
    }

    /**
     * @param $fields
     * @return QueryBuilderContract
     */
    public function groupBy($fields): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->groupBy($fields);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $take
     * @return QueryBuilderContract
     */
    public function take($take): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->take($take);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $offset
     * @return QueryBuilderContract
     */
    public function offset($offset): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->offset($offset);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderContract
     */
    public function where($column, $operator = null, $value = null): QueryBuilderContract
    {
        return $this->addWhere('where', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderContract
     */
    public function orWhere($column, $operator = null, $value = null): QueryBuilderContract
    {
        return $this->addWhere('orWhere', ...func_get_args());
    }

    /**
     * @param $column
     * @param array $values
     * @return QueryBuilderContract
     */
    public function whereIn($column, array $values): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->whereIn($column, $values);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilderContract
     */
    public function whereNull($column): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->whereNull($column);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilderContract
     */
    public function whereNotNull($column): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->whereNotNull($column);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderContract
     */
    public function whereDate($column, $operator = null, $value = null): QueryBuilderContract
    {
        return $this->addWhere('whereDate', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderContract
     */
    public function orWhereDate($column, $operator = null, $value = null): QueryBuilderContract
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
     * @return QueryBuilderContract
     */
    public function whereMonth($column, $operator = null, $value = null): QueryBuilderContract
    {
        return $this->addWhere('whereMonth', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $year
     * @return QueryBuilderContract
     */
    public function whereYear($column, $operator = null, $year = null): QueryBuilderContract
    {
        return $this->addWhere('whereYear', ...func_get_args());
    }


    /**
     * @param $column
     * @param $values
     * @return QueryBuilderContract
     */
    public function whereBetween($column, $values): QueryBuilderContract
    {
        return $this->addWhere('whereBetween', ...func_get_args());
    }

    /**
     * @param $column
     * @param $values
     * @return QueryBuilderContract
     */
    public function whereNotBetween($column, $values): QueryBuilderContract
    {
        return $this->addWhere('whereNotBetween', ...func_get_args());
    }

    /**
     * @param $column
     * @param $values
     * @return QueryBuilderContract
     */
    public function orWhereBetween($column, $values): QueryBuilderContract
    {
        return $this->addWhere('orWhereBetween', ...func_get_args());
    }

    /**
     * @param $column
     * @param $values
     * @return QueryBuilderContract
     */
    public function orWhereNotBetween($column, $values): QueryBuilderContract
    {
        return $this->addWhere('orWhereNotBetween', ...func_get_args());
    }

    /**
     * Handles both where and orWhere calls with flexible arguments.
     * @param string $method 'where' or 'orWhere'
     * @param mixed $column
     * @param mixed|null $operator
     * @param mixed|null $value
     * @return QueryBuilderContract
     */
    private function addWhere(string $method, mixed $column, mixed $operator = null, mixed $value = null): QueryBuilderContract
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
     * @return QueryBuilderContract
     */
    public function having($column, $operator, $value): QueryBuilderContract
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
        // add timestamp in case of orm
        $data = Timestamp::addTimeStamp($data, $this->modelClass ?? null);

        return $this->doctrine->insertGetId($data);
    }

    /**
     * @param $fields
     * @return bool
     * @throws ErrorException
     */
    public function update(array $fields): mixed
    {
        // update timestamp in case of orm
        $fields = Timestamp::updateTimeStamp($fields, $this->modelClass ?? null);

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
        // add timestamp in case of orm
        $values = Timestamp::addTimeStamp($values, $this->modelClass ?? null);

        return $this->doctrine->updateOrCreate($attributes, $values);
    }

    /**
     * @param array $attributes
     * @return mixed
     * @throws ErrorException
     */
    public function create(array $attributes): mixed
    {
        // add timestamp in case of orm
        $attributes = Timestamp::addTimeStamp($attributes, $this->modelClass ?? null);

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
     * @return QueryBuilderContract
     */
    public function join($table, $column, $equal, $second_column): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->join($table, $column, $equal, $second_column);
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderContract
     */
    public function leftJoin($table, $column, $equal, $second_column): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->leftJoin($table, $column, $equal, $second_column);
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderContract
     */
    public function rightJoin($table, $column, $equal, $second_column): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->rightJoin($table, $column, $equal, $second_column);
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderContract
     */
    public function fullOuterJoin($table, $column, $equal, $second_column): QueryBuilderContract
    {
        $this->doctrine = $this->doctrine->fullOuterJoin($table, $column, $equal, $second_column);
        return $this;
    }

} 