<?php

namespace Core\Database\Traits;

use Core\Database\Doctrine;

/**
 * Trait for where clauses and conditions.
 */
trait WhereTrait
{
    public string $wheres = '';

    /**
     * @param string $column
     * @param string $condition
     * @param mixed $value
     * @return WhereTrait|Doctrine
     */
    public function where(string $column, string $condition, mixed $value): self
    {
        $escapedValue = $value === null ? 'NULL' : "'" . addslashes($value) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} {$condition} {$escapedValue}";
        } else {
            $this->wheres .= " AND {$column} {$condition} {$escapedValue}";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param string $condition
     * @param mixed $value
     * @return WhereTrait|Doctrine
     */
    public function orWhere(string $column, string $condition, mixed $value): self
    {
        if (empty($this->joins) && str_contains($column, '.')) {
            [, $col] = explode('.', $column, 2);
            $column = $col;
        }
        $escapedValue = $value === null ? 'NULL' : "'" . addslashes($value) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} {$condition} {$escapedValue}";
        } else {
            $this->wheres .= " OR {$column} {$condition} {$escapedValue}";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param string $condition
     * @param string $date
     * @return WhereTrait|Doctrine
     */
    public function whereDate(string $column, string $condition, string $date): self
    {
        $escapedValue = "'" . addslashes($date) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE DATE({$column}) {$condition} {$escapedValue}";
        } else {
            $this->wheres .= " AND DATE({$column}) {$condition} {$escapedValue}";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param string $condition
     * @param string $date
     * @return WhereTrait|Doctrine
     */
    public function orWhereDate(string $column, string $condition, string $date): self
    {
        $escapedValue = "'" . addslashes($date) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE DATE({$column}) {$condition} {$escapedValue}";
        } else {
            $this->wheres .= " OR DATE({$column}) {$condition} {$escapedValue}";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param string $operator
     * @param int $day
     * @return WhereTrait|Doctrine
     */
    public function whereDay(string $column, string $operator, int $day): self
    {
        if ($this->wheres === '') {
            $this->wheres = " WHERE DAY({$column}) {$operator} {$day}";
        } else {
            $this->wheres .= " AND DAY({$column}) {$operator} {$day}";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param string $operator
     * @param int $day
     * @return WhereTrait|Doctrine
     */
    public function whereDayOfWeek(string $column, string $operator, int $day): self
    {
        if ($this->wheres === '') {
            $this->wheres = " WHERE DAYOFWEEK({$column}) {$operator} {$day}";
        } else {
            $this->wheres .= " AND DAYOFWEEK({$column}) {$operator} {$day}";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param string $operator
     * @param string $time
     * @return WhereTrait|Doctrine
     */
    public function whereTime(string $column, string $operator, string $time): self
    {
        $escapedValue = "'" . addslashes($time) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE TIME({$column}) {$operator} {$escapedValue}";
        } else {
            $this->wheres .= " AND TIME({$column}) {$operator} {$escapedValue}";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param string $operator
     * @param int $month
     * @return WhereTrait|Doctrine
     */
    public function whereMonth(string $column, string $operator, int $month): self
    {
        if ($this->wheres === '') {
            $this->wheres = " WHERE MONTH({$column}) {$operator} {$month}";
        } else {
            $this->wheres .= " AND MONTH({$column}) {$operator} {$month}";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param string $operator
     * @param int $year
     * @return WhereTrait|Doctrine
     */
    public function whereYear(string $column, string $operator, int $year): self
    {
        if ($this->wheres === '') {
            $this->wheres = " WHERE YEAR({$column}) {$operator} {$year}";
        } else {
            $this->wheres .= " AND YEAR({$column}) {$operator} {$year}";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param array $values
     * @return WhereTrait|Doctrine
     */
    public function whereBetween(string $column, array $values): self
    {
        if (count($values) !== 2) {
            throw new \InvalidArgumentException('whereBetween requires exactly two values.');
        }

        $escapedFrom = "'" . addslashes($values[0]) . "'";
        $escapedTo = "'" . addslashes($values[1]) . "'";

        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} BETWEEN {$escapedFrom} AND {$escapedTo}";
        } else {
            $this->wheres .= " AND {$column} BETWEEN {$escapedFrom} AND {$escapedTo}";
        }

        return $this;
    }

    /**
     * @param string $column
     * @param array $values
     * @return WhereTrait|Doctrine
     */
    public function whereNotBetween(string $column, array $values): self
    {
        if (count($values) !== 2) {
            throw new \InvalidArgumentException('whereNotBetween requires exactly two values.');
        }

        $escapedFrom = "'" . addslashes($values[0]) . "'";
        $escapedTo = "'" . addslashes($values[1]) . "'";

        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} NOT BETWEEN {$escapedFrom} AND {$escapedTo}";
        } else {
            $this->wheres .= " AND {$column} NOT BETWEEN {$escapedFrom} AND {$escapedTo}";
        }

        return $this;
    }

    /**
     * @param string $column
     * @param mixed $start
     * @param mixed $end
     * @return WhereTrait|Doctrine
     */
    public function orWhereBetween(string $column, mixed $start, mixed $end): self
    {
        $escapedStart = "'" . addslashes($start) . "'";
        $escapedEnd = "'" . addslashes($end) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} BETWEEN {$escapedStart} AND {$escapedEnd}";
        } else {
            $this->wheres .= " OR {$column} BETWEEN {$escapedStart} AND {$escapedEnd}";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param mixed $start
     * @param mixed $end
     * @return WhereTrait|Doctrine
     */
    public function orWhereNotBetween(string $column, mixed $start, mixed $end): self
    {
        $escapedStart = "'" . addslashes($start) . "'";
        $escapedEnd = "'" . addslashes($end) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} NOT BETWEEN {$escapedStart} AND {$escapedEnd}";
        } else {
            $this->wheres .= " OR {$column} NOT BETWEEN {$escapedStart} AND {$escapedEnd}";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param array $values
     * @return WhereTrait|Doctrine
     */
    public function whereIn(string $column, array $values): self
    {
        $in = implode(",", array_map(fn($v) => $v === null ? 'NULL' : "'".addslashes($v)."'", $values));
        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} IN ({$in})";
        } else {
            $this->wheres .= " AND {$column} IN ({$in})";
        }
        return $this;
    }

    /**
     * @param string $column
     * @return WhereTrait|Doctrine
     */
    public function whereNull(string $column): self
    {
        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} IS NULL";
        } else {
            $this->wheres .= " AND {$column} IS NULL";
        }
        return $this;
    }

    /**
     * @param string $column
     * @return WhereTrait|Doctrine
     */
    public function whereNotNull(string $column): self
    {
        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} IS NOT NULL";
        } else {
            $this->wheres .= " AND {$column} IS NOT NULL";
        }
        return $this;
    }

}
