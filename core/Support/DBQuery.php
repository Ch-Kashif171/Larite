<?php

namespace Core\Support;

use Core\Database\QueryBuilder;
use Core\Exception\Handlers\DBException;
use Whoops\Exception\ErrorException;

/**
 * Class DBQuery
 */
class DBQuery
{
    /**
     * @param $table
     * @return QueryBuilder
     * @throws DBException
     */
    public static function table($table): QueryBuilder
    {
        return new QueryBuilder($table);
    }

    /**
     * @param $sql
     * @return bool
     * @throws ErrorException
     */
    public static function rawQuery($sql): bool
    {
        return QueryBuilder::rawQuery($sql);
    }

}
