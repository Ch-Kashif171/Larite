<?php

namespace Core\Database\Traits;

use Core\Exception\Handlers\DBException;
use Exception;
use PDOException;
use Whoops\Exception\ErrorException;
use PDO;

/**
 * Trait for aggregate functions like sum, count, etc.
 */
trait AggregateTrait
{
    /**
     * @param string $column
     * @return mixed
     */
    public function sum(string $column): mixed
    {
        $sql = "SELECT SUM({$column}) as sum FROM {$this->table} {$this->wheres}";
        $query = $this->con->query($sql);

        return $query->fetch(PDO::FETCH_OBJ)->sum;
    }

    /**
     * @param string $column
     * @return mixed
     */
    public function count(string $column): mixed
    {
        $sql = "SELECT COUNT({$column}) as count FROM {$this->table} {$this->wheres}";
        $query = $this->con->query($sql);
        return $query->fetch(PDO::FETCH_OBJ)->count;
    }

    /**
     * @param string $column
     * @return mixed
     */
    public function max(string $column): mixed
    {
        $sql = "SELECT MAX({$column}) as max FROM {$this->table} {$this->wheres}";
        $query = $this->con->query($sql);
        return $query->fetch(PDO::FETCH_OBJ)->max;
    }

    /**
     * @param string $column
     * @return mixed
     */
    public function min(string $column): mixed
    {
        $sql = "SELECT MIN({$column}) as min FROM {$this->table} {$this->wheres}";
        $query = $this->con->query($sql);
        return $query->fetch(PDO::FETCH_OBJ)->min;
    }

    /**
     * @param string $column
     * @param int $value
     * @return bool
     * @throws ErrorException
     */
    public function increment(string $column, int $value = 1): bool
    {
        $sql = "SELECT {$column} FROM {$this->table} {$this->wheres}";

        try {
            $query = $this->con->query($sql);
            $column_value = $query->fetch(PDO::FETCH_OBJ);
            $newValue = $column_value->$column + $value;
            return $this->update([$column => $newValue]);
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * @param string $column
     * @param int $value
     * @return bool
     * @throws ErrorException
     */
    public function decrement(string $column, int $value = 1): bool
    {
        $sql = "SELECT {$column} FROM {$this->table} {$this->wheres}";

        try {
            $query = $this->con->query($sql);
            $column_value = $query->fetch(PDO::FETCH_OBJ);
            $newValue = $column_value->$column - $value;
            return $this->update([$column => $newValue]);
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws DBException
     */
    public function truncate(): bool
    {
        try {
            $sql = "TRUNCATE TABLE {$this->table}";
            return $this->con->exec($sql) === 0;
        } catch (PDOException $e) {
            throw new DBException("Failed to truncate table {$this->table}: " . $e->getMessage());
        }
    }

}
