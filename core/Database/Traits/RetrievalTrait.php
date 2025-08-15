<?php

namespace Core\Database\Traits;

use Exception;
use PDO;

/**
 * Trait for retrieval methods like first, get, find, etc.
 */
trait RetrievalTrait
{
    /**
     * @param array $timestamp
     * @return mixed
     */
    public function first(array $timestamp = []): mixed
    {
        $columns = $this->getSelectColumns($timestamp);

        $sql = $this->buildSelectQuery($columns);
        $query = $this->con->query($sql);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @param array $timestamp
     * @return mixed
     */
    public function find($id, array $timestamp = []): mixed
    {
        $columns = $this->getSelectColumns($timestamp);

        $sql = $this->buildSelectQuery($columns)
            . " WHERE {$this->table}.id = {$id}";
        $query = $this->con->query($sql);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @param array $timestamp
     * @return mixed
     * @throws Exception
     */
    public function findOrFail($id, array $timestamp = []): mixed
    {
        $record = $this->find($id, $timestamp);

        if (!$record) {
            throw new Exception("Record not found with ID: $id", 404);
        }

        return $record;
    }

    /**
     * @param array $timestamp
     * @return array|false
     */
    public function get(array $timestamp = []): array|false
    {
        $columns = $this->getSelectColumns($timestamp);

        $sql = $this->buildSelectQuery($columns);
        $query = $this->con->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param array $timestamp
     * @return mixed
     * @throws Exception
     */
    public function firstOrFail(array $timestamp = []): mixed
    {
        $result = $this->first($timestamp);
        if (!$result) {
            throw new Exception("No record found.");
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        $result = $this->limit(1)->first();
        return $result !== false && $result !== null;
    }

    /**
     * @param array|string $columns
     * @return array
     */
    public function pluck(array|string $columns): array
    {
        if (!is_array($columns)) {
            $columns = [$columns];
        }

        $results = $this->get();

        if (empty($results)) {
            return [];
        }

        if (count($columns) === 1) {
            $column = $columns[0];
            return array_map(fn($item) => $item->$column ?? null, $results);
        }

        if (count($columns) === 2) {
            [$keyColumn, $valueColumn] = $columns;
            $assoc = [];
            foreach ($results as $item) {
                $key = $item->$keyColumn ?? null;
                $value = $item->$valueColumn ?? null;
                $assoc[$key] = $value;
            }
            return $assoc;
        }

        return array_map(function ($item) use ($columns) {
            $row = [];
            foreach ($columns as $col) {
                $row[$col] = $item->$col ?? null;
            }
            return $row;
        }, $results);
    }

}
