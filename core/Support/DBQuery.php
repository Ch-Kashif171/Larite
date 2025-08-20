<?php

namespace Core\Support;

use Core\Database\ORMBuilder;
use Core\Exception\Handlers\DBException;
use Whoops\Exception\ErrorException;

/**
 * Class DBQuery
 */
class DBQuery
{
    /**
     * @param $table
     * @return ORMBuilder
     * @throws DBException
     */
    public static function table($table): ORMBuilder
    {
        return new ORMBuilder($table);
    }

    /**
     * @param $sql
     * @return bool
     * @throws ErrorException
     */
    public static function rawQuery($sql): bool
    {
        return ORMBuilder::rawQuery($sql);
    }

}
