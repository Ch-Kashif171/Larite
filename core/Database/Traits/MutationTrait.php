<?php

namespace Core\Database\Traits;

use Exception;
use Whoops\Exception\ErrorException;

/**
 * Trait for insert, update, delete operations.
 */
trait MutationTrait
{
    /**
     * @param array $rows
     * @return bool
     * @throws ErrorException
     */
    public function insert(array $rows): bool
    {
        return $this->createMany($rows);
    }

    /**
     * @param array $data
     * @return string
     * @throws ErrorException
     */
    public function insertGetId(array $data): string
    {
        $fields = '`' . implode('`, `', array_keys($data)) . '`';
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$this->table} ($fields) VALUES ({$placeholders})";

        try {
            $stmt = $this->con->prepare($sql);
            $stmt->execute($data);
            return $this->con->lastInsertId();
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * @param array $data
     * @return mixed
     * @throws ErrorException
     */
    public function create(array $data): mixed
    {
        $id = $this->insertGetId($data);
        return (object) array_merge(['id' => $id], $data);
    }

    /**
     * @param array $records
     * @return bool
     * @throws ErrorException
     */
    public function createMany(array $records): bool
    {
        if (empty($records)) {
            return false;
        }

        if (!is_array(reset($records))) {
            $records = [$records];
        }

        $columns = array_keys($records[0]);
        $fields = '`' . implode('`, `', $columns) . '`';

        $escapedRows = [];
        foreach ($records as $record) {
            $escaped = array_map(fn($value) => $this->con->quote($value), array_values($record));
            $escapedRows[] = '(' . implode(', ', $escaped) . ')';
        }

        $sql = "INSERT INTO {$this->table} ($fields) VALUES " . implode(', ', $escapedRows);

        try {
            return $this->con->exec($sql) !== false;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * @param array $fields
     * @return bool
     * @throws ErrorException
     */
    public function update(array $fields): bool
    {
        $current = $this->first();
        if (!$current) {
            return false;
        }

        foreach ($fields as $name => $value) {
            if (isset($current->$name) && $current->$name == $value) {
                unset($fields[$name]);
            }
        }

        if (empty($fields)) {
            return true;
        }

        $query = "UPDATE {$this->table} SET ";
        $params = [];
        foreach ($fields as $name => $value) {
            $query .= "{$name} = :{$name},";
            $params[":{$name}"] = $value;
        }
        $query = rtrim($query, ',');
        $query .= $this->wheres;

        try {
            $stmt = $this->con->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws ErrorException
     */
    public function delete(): bool
    {
        $query = "DELETE FROM {$this->table} {$this->wheres}";

        try {
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     * @throws ErrorException
     */
    public function updateOrCreate(array $attributes, array $values): mixed
    {
        $query = clone $this;
        foreach ($attributes as $key => $value) {
            $query = $query->where($key, '=', $value);
        }

        $record = $query->first();

        if ($record) {
            unset($values['created_at']);
            $updateQuery = clone $this;
            $updateQuery->where('id', '=', $record->id)->update($values);
            return (object) array_merge((array) $record, $values);
        }

        unset($attributes['id']);
        return $this->create($attributes + $values);
    }

}
