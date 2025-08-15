<?php

namespace Core\Database\Traits;

use Core\Database\Doctrine;

/**
 * Trait for ordering, grouping, having, limit, offset.
 */
trait ClauseTrait
{
    protected string $groupBy = '';
    protected string $having = '';
    protected string $orderBy = '';
    protected string $limit = '';
    protected string $offset = '';
    protected string $take = '';

    /**
     * @param string $field
     * @param string $order
     * @return ClauseTrait|Doctrine
     */
    public function orderBy(string $field, string $order = 'ASC'): self
    {
        $this->orderBy = " ORDER BY {$field} {$order}";
        return $this;
    }

    /**
     * @param string $field
     * @return ClauseTrait|Doctrine
     */
    public function orderByDesc(string $field): self
    {
        $this->orderBy = " ORDER BY {$field} DESC";
        return $this;
    }

    /**
     * @param string $fields
     * @return ClauseTrait|Doctrine
     */
    public function groupBy(string $fields): self
    {
        $this->groupBy = " GROUP BY {$fields}";
        return $this;
    }

    /**
     * @param string $column
     * @param string $condition
     * @param mixed $value
     * @return ClauseTrait|Doctrine
     */
    public function having(string $column, string $condition, mixed $value): self
    {
        $escapedValue = $value === null ? 'NULL' : "'" . addslashes($value) . "'";
        $this->having = " HAVING {$column} {$condition} {$escapedValue}";
        return $this;
    }

    /**
     * @param int $limit
     * @return ClauseTrait|Doctrine
     */
    public function limit(int $limit): self
    {
        $this->limit = " LIMIT {$limit}";
        return $this;
    }

    /**
     * @param int $offset
     * @return ClauseTrait|Doctrine
     */
    public function offset(int $offset): self
    {
        $this->offset = " OFFSET {$offset}";
        return $this;
    }

    /**
     * @param int $take
     * @return ClauseTrait|Doctrine
     */
    public function take(int $take): self
    {
        $this->take = " LIMIT {$take}";
        return $this;
    }

}