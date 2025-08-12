<?php

namespace Core\Database;

class Timestamp
{
    /**
     * @param $attributes
     * @param $modelClass
     * @return mixed
     */
    public static function addTimeStamp($attributes, $modelClass): mixed
    {
        if ($modelClass && class_exists($modelClass)) {
            if ($modelClass::getIsTimestamp()) {
                $now = date('Y-m-d H:i:s');
                $attributes['created_at'] = $now;
                $attributes['updated_at'] = $now;
            }
        }

        return $attributes;
    }

    /**
     * @param $attributes
     * @param $modelClass
     * @return mixed
     */
    public static function updateTimeStamp($attributes, $modelClass): mixed
    {
        if ($modelClass && class_exists($modelClass)) {
            if ($modelClass::getIsTimestamp()) {
                $now = date('Y-m-d H:i:s');
                $attributes['updated_at'] = $now;
            }
        }

        return $attributes;
    }

    /**
     * @param $class
     * @return array
     */
    public static function timestamp($class): array
    {
        $timestampColumns = [];
        if ($class && class_exists($class)) {

            $model = new $class();
            if (!$model->getTimestamp()) {
                $timestampColumns[] = 'created_at';
                $timestampColumns[] = 'updated_at';
            }
        }

        return $timestampColumns;
    }

    /**
     * @param $table
     * @param $con
     * @param array $columns
     * @param array $timestamps
     * @return string
     */
    public static function withoutTimestamps(
        $table,
        $con,
        array $columns = ['*'],
        array $timestamps = ['created_at', 'updated_at']
    ): string {
        // If selecting everything, get actual table columns
        if ($columns === ['*']) {
            $stmt = $con->query("SHOW COLUMNS FROM {$table}");
            $columns = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        }

        $filtered = array_values(array_diff($columns, $timestamps));

        return implode(',', $filtered);
    }

}