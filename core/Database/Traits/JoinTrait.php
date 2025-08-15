<?php

namespace Core\Database\Traits;

use Core\Database\Doctrine;

/**
 * Trait for join clauses.
 */
trait JoinTrait
{
    protected string $joins = '';

    /**
     * @param string $table
     * @param string $column
     * @param string $equal
     * @param string $second_column
     * @return JoinTrait|Doctrine
     */
    public function join(string $table, string $column, string $equal, string $second_column): self
    {
        $this->joins .= " INNER JOIN {$table} ON {$column} {$equal} {$second_column}";
        return $this;
    }

    /**
     * @param string $table
     * @param string $column
     * @param string $equal
     * @param string $second_column
     * @return JoinTrait|Doctrine
     */
    public function leftJoin(string $table, string $column, string $equal, string $second_column): self
    {
        $this->joins .= " LEFT JOIN {$table} ON {$column} {$equal} {$second_column}";
        return $this;
    }

    /**
     * @param string $table
     * @param string $column
     * @param string $equal
     * @param string $second_column
     * @return JoinTrait|Doctrine
     */
    public function rightJoin(string $table, string $column, string $equal, string $second_column): self
    {
        $this->joins .= " RIGHT JOIN {$table} ON {$column} {$equal} {$second_column}";
        return $this;
    }

    /**
     * @param string $table
     * @param string $column
     * @param string $equal
     * @param string $second_column
     * @return JoinTrait|Doctrine
     */
    public function fullOuterJoin(string $table, string $column, string $equal, string $second_column): self
    {
        $this->joins .= " FULL OUTER JOIN {$table} ON {$column} {$equal} {$second_column}";
        return $this;
    }

}
