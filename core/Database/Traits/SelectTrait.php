<?php

namespace Core\Database\Traits;

use Core\Database\Doctrine;
use Core\Database\Timestamp;
use PDO;

/**
 * Trait for handling SELECT clauses and field selections.
 */
trait SelectTrait
{
    /**
     * @param ...$fields
     * @return SelectTrait|Doctrine
     */
    public function select(...$fields): self
    {
        // Flatten if first argument is an array
        if (count($fields) === 1 && is_array($fields[0])) {
            $fields = $fields[0];
        }

        // Convert 'table*' to 'table.*'
        foreach ($fields as &$field) {
            if (preg_match('/^([a-zA-Z0-9_]+)\*$/', $field, $matches)) {
                $field = $matches[1] . '.*';
            }
        }

        $this->fields = implode(',', $fields);

        return $this;
    }

    /**
     * @param array $timestamp
     * @param array $hidden
     * @return array
     */
    protected function getSelectColumns(array $timestamp = [], array $hidden = []): array
    {
        $columns = empty($this->fields) ? ['*'] : (array) $this->fields;

        if (empty($timestamp) && empty($hidden)) {
            return $columns;
        }
        // Handle timestamps
        $columns = Timestamp::withoutTimestamps(
            $this->table,
            $this->con,
            $columns,
            $timestamp
        );

        // Remove hidden columns
        if (!empty($hidden)) {
            $columns = array_diff(explode(',', $columns), $hidden);
        }

        return $columns;
    }


}
