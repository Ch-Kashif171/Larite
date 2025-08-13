<?php

namespace Core\Database;


use Core\Exception\Handlers\DBException;
use Core\Support\Constants;
use Core\Support\Traits\Builder\Aggregators;
use Core\Support\Traits\Builder\EagerLoading;
use Core\Support\Traits\Builder\Getters;
use Core\Support\Traits\Builder\MakeResult;
use Whoops\Exception\ErrorException;

class QueryBuilder implements QueryBuilderInterface
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
     * @return QueryBuilderInterface
     * @throws DBException
     */
    public function select(...$fields): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->select(...$fields);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $field
     * @param string $order
     * @return QueryBuilderInterface
     */
    public function orderBy($field, string $order = 'ASC'): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->orderBy($field, $order);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $field
     * @return QueryBuilderInterface
     */
    public function orderByDesc($field): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->orderByDesc($field);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $limit
     * @return QueryBuilderInterface
     */
    public function limit($limit): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->limit($limit);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilderInterface
     */
    public function latest($column): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->orderByDesc($column);
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilderInterface
     */
    public function oldest($column): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->orderBy($column);
        return $this;
    }

    /**
     * @param $fields
     * @return QueryBuilderInterface
     */
    public function groupBy($fields): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->groupBy($fields);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $take
     * @return QueryBuilderInterface
     */
    public function take($take): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->take($take);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $offset
     * @return QueryBuilderInterface
     */
    public function offset($offset): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->offset($offset);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderInterface
     */
    public function where($column, $operator = null, $value = null): QueryBuilderInterface
    {
        return $this->addWhere('where', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderInterface
     */
    public function orWhere($column, $operator = null, $value = null): QueryBuilderInterface
    {
        return $this->addWhere('orWhere', ...func_get_args());
    }

    /**
     * @param $column
     * @param array $values
     * @return QueryBuilderInterface
     */
    public function whereIn($column, array $values): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->whereIn($column, $values);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilderInterface
     */
    public function whereNull($column): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->whereNull($column);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @return QueryBuilderInterface
     */
    public function whereNotNull($column): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->whereNotNull($column);
        // Ensure modelClass is preserved
        return $this;
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderInterface
     */
    public function whereDate($column, $operator = null, $value = null): QueryBuilderInterface
    {
        return $this->addWhere('whereDate', ...func_get_args());
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return QueryBuilderInterface
     */
    public function orWhereDate($column, $operator = null, $value = null): QueryBuilderInterface
    {
        return $this->addWhere('orWhereDate', ...func_get_args());
    }

    /**
     * @param $column
     * @param $values
     * @return QueryBuilderInterface
     */
    public function whereBetween($column, $values): QueryBuilderInterface
    {
        return $this->addWhere('whereBetween', ...func_get_args());
    }

    /**
     * @param $column
     * @param $values
     * @return QueryBuilderInterface
     */
    public function whereNotBetween($column, $values): QueryBuilderInterface
    {
        return $this->addWhere('whereNotBetween', ...func_get_args());
    }

    /**
     * @param $column
     * @param $values
     * @return QueryBuilderInterface
     */
    public function orWhereBetween($column, $values): QueryBuilderInterface
    {
        return $this->addWhere('orWhereBetween', ...func_get_args());
    }

    /**
     * @param $column
     * @param $values
     * @return QueryBuilderInterface
     */
    public function orWhereNotBetween($column, $values): QueryBuilderInterface
    {
        return $this->addWhere('orWhereNotBetween', ...func_get_args());
    }

    /**
     * Handles both where and orWhere calls with flexible arguments.
     * @param string $method 'where' or 'orWhere'
     * @param mixed $column
     * @param mixed|null $operator
     * @param mixed|null $value
     * @return QueryBuilderInterface
     */
    private function addWhere(string $method, mixed $column, mixed $operator = null, mixed $value = null): QueryBuilderInterface
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
     * @return QueryBuilderInterface
     */
    public function having($column, $operator, $value): QueryBuilderInterface
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
        // add timestamp in case of orm
        $data = Timestamp::addTimeStamp($data, $this->modelClass ?? null);

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
     * @return QueryBuilderInterface
     */
    public function join($table, $column, $equal, $second_column): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->join($table, $column, $equal, $second_column);
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderInterface
     */
    public function leftJoin($table, $column, $equal, $second_column): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->leftJoin($table, $column, $equal, $second_column);
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderInterface
     */
    public function rightJoin($table, $column, $equal, $second_column): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->rightJoin($table, $column, $equal, $second_column);
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return QueryBuilderInterface
     */
    public function fullOuterJoin($table, $column, $equal, $second_column): QueryBuilderInterface
    {
        $this->doctrine = $this->doctrine->fullOuterJoin($table, $column, $equal, $second_column);
        return $this;
    }

} 