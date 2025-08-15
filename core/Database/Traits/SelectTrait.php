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
     * @return string
     */
    protected function getSelectColumns(array $timestamp = []): string
    {
        $columns = empty($this->fields) ? '*' : $this->fields;

        // Handle timestamps (assuming Timestamp is a separate class)
        return Timestamp::withoutTimestamps(
            $this->table,
            $this->con,
            [$columns],
            $timestamp
        );
    }

}
