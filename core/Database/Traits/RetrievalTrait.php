<?php

namespace Core\Database\Traits;

use Core\Support\Collection\Collection;
use Exception;
use PDO;

/**
 * Trait for retrieval methods like first, get, find, etc.
 */
trait RetrievalTrait
{
    /**
     * @param array $timestamp
     * @param array $hidden
     * @return mixed
     */
    public function first(array $timestamp = [], array $hidden = []): mixed
    {
        $columns = $this->getColumns($timestamp, $hidden);

        $sql = $this->buildSelectQuery($columns);
        $query = $this->con->query($sql);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @param array $timestamp
     * @param array $hidden
     * @return mixed
     */
    public function find($id, array $timestamp = [], array $hidden = []): mixed
    {
        $columns = $this->getColumns($timestamp, $hidden);

        $sql = $this->buildSelectQuery($columns)
            . " WHERE {$this->table}.id = {$id}";
        $query = $this->con->query($sql);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @param array $timestamp
     * @param array $hidden
     * @return mixed
     * @throws Exception
     */
    public function findOrFail($id, array $timestamp = [], array $hidden = []): mixed
    {
        $record = $this->find($id, $timestamp, $hidden);

        if (!$record) {
            throw new Exception("Record not found with ID: $id", 404);
        }

        return $record;
    }

    /**
     * @param array $hidden
     * @param array $timestamp
     * @return array|false
     */
    public function get(array $timestamp = [], array $hidden = []): array|false
    {
        $columns = $this->getColumns($timestamp, $hidden);

        $sql = $this->buildSelectQuery($columns);
        $query = $this->con->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
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
     * @param string $column
     * @return mixed
     */
    public function value(string $column): mixed
    {
        // Build query only with the given column
        $sql = $this->buildSelectQuery($column . ' AS value');

        $query = $this->con->query($sql);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['value'] ?? null;
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
     * @return Collection
     */
    public function pluck(array|string $columns): Collection
    {
        $columns = $this->normalizePluckColumns(func_get_args());

        $sql = $this->buildSelectQuery(implode(', ', $columns));
        $stmt = $this->con->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows) return new Collection([]);

        $count = count($columns);

        if ($count === 1) {
            $result = $this->pluckSingleColumn($rows, $columns[0]);
        } elseif ($count === 2) {
            $result = $this->pluckKeyValue($rows, $columns[0], $columns[1]);
        } else {
            $result = $rows; // multiple columns as associative arrays
        }

        // Wrap in Collection for Laravel-style chaining
        return new Collection($result);
    }

    /* ---------------- Helper Methods ---------------- */

    protected function normalizePluckColumns(array $args): array
    {
        if (count($args) === 1 && is_array($args[0])) {
            return $args[0];
        }
        return $args;
    }

    protected function pluckSingleColumn(array $rows, string $column): array
    {
        return array_column($rows, $column);
    }

    protected function pluckKeyValue(array $rows, string $valueColumn, string $keyColumn): array
    {
        $assoc = [];
        foreach ($rows as $row) {
            if (array_key_exists($keyColumn, $row)) {
                $assoc[(string)$row[$keyColumn]] = $row[$valueColumn] ?? null;
            }
        }
        return $assoc;
    }

    /**
     * @param $timestamp
     * @param $hidden
     * @return string
     */
    private function getColumns($timestamp, $hidden): string
    {
        $columns = $this->getSelectColumns($timestamp, $hidden);
        $columns = empty($columns) ? ['*'] : $columns;
        return implode(',', $columns);
    }

}
