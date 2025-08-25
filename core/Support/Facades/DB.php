<?php

namespace Core\Support\Facades;

/**
 * @method static \Core\Support\Facades\DB table($table): QueryBuilder
 * @method static \Core\Support\Facades\DB rawQuery($sql)
 * @method static \Core\Support\Facades\DB paginate($limit)
 * @method static \Core\Support\Facades\DB simplePaginate($limit)
 * @method static \Core\Support\Facades\DB get()
 * @method static \Core\Support\Facades\DB all()
 * @method static \Core\Support\Facades\DB first()
 * @method static \Core\Support\Facades\DB value(string $column)
 * @method static \Core\Support\Facades\DB firstOrFail()
 * @method static \Core\Support\Facades\DB find($id)
 * @method static \Core\Support\Facades\DB pluck($columns)
 * @method static \Core\Support\Facades\DB increment($column, int|string $value = 1)
 * @method static \Core\Support\Facades\DB decrement($column, int|string $value = 1)
 * @method static \Core\Support\Facades\DB exists()
 * @method static \Core\Support\Facades\DB count(string $column = "*")
 * @method static \Core\Support\Facades\DB sum($column)
 * @method static \Core\Support\Facades\DB max($column)
 * @method static \Core\Support\Facades\DB min($column)
 * @method static \Core\Support\Facades\DB create(array $data)
 * @method static \Core\Support\Facades\DB insert($data)
 * @method static \Core\Support\Facades\DB insertGetId($data)
 * @method static \Core\Support\Facades\DB updateOrCreate(array $attributes, array $values)
 * @method static \Core\Support\Facades\DB update($fields)
 * @method static \Core\Support\Facades\DB delete()
 * @method static \Core\Support\Facades\DB truncate()
 * @method static \Core\Support\Facades\DB join($table, $column, $equal, $second_column)
 * @method static \Core\Support\Facades\DB leftJoin($table, $column, $equal, $second_column)
 * @method static \Core\Support\Facades\DB rightJoin($table, $column, $equal, $second_column)
 * @method static \Core\Support\Facades\DB fullOuterJoin($table, $column, $equal, $second_column)
 * @method static \Core\Support\Facades\DB select()
 * @method static \Core\Support\Facades\DB orderBy($field, string $order = 'ASC')
 * @method static \Core\Support\Facades\DB orderByDesc($field)
 * @method static \Core\Support\Facades\DB limit($limit)
 * @method static \Core\Support\Facades\DB latest($column)
 * @method static \Core\Support\Facades\DB oldest($column)
 * @method static \Core\Support\Facades\DB groupBy($fields)
 * @method static \Core\Support\Facades\DB take($take)
 * @method static \Core\Support\Facades\DB offset($offset)
 * @method static \Core\Support\Facades\DB where($column, $operator = null, $value = null)
 * @method static \Core\Support\Facades\DB orWhere($column, $operator, $value)
 * @method static \Core\Support\Facades\DB whereIn($column, array $values)
 * @method static \Core\Support\Facades\DB whereNull($column)
 * @method static \Core\Support\Facades\DB whereNotNull($column)
 * @method static \Core\Support\Facades\DB  having($column, $operator, $value)
 */

class DB extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'db';
    }
}