<?php

namespace Core\Database;

use Core\Support\Traits\Internal\Queries;
use Exception;
use Whoops\Exception\ErrorException;

class Doctrine
{
    use Queries;

    // Add separate properties for each clause
    protected $joins = '';
    public $wheres = '';
    protected $groupBy = '';
    protected $having = '';
    protected $orderBy = '';
    protected $limit = '';
    protected $offset = '';
    protected $take = '';

    /**
     * @return mixed
     * @throws ErrorException
     */
    public function first($timestamp = [])
    {
        if (empty($this->fields)) {
            $columns = '*';
        } else {
            $columns = $this->fields;
        }

        // skip the timestamp if false in model
        $columns = Timestamp::withoutTimestamps(
            $this->table,
            $this->con,
            [$columns],
            $timestamp
        );

        $limitClause = $this->limit ?: '';
        $offsetClause = $this->offset ?: '';
        $sql = $this->selectStatement($columns)
            . $this->joins
            . $this->wheres
            . $this->groupBy
            . $this->having
            . $this->orderBy
            . $limitClause
            . $offsetClause;
        $query = $this->con->query($sql);
        $this->result = $query->fetch(\PDO::FETCH_OBJ);
        return $this->result;
    }

    /**
     * @param $id
     * @param array $timestamp
     * @return mixed
     */
    public function find($id, array $timestamp = [])
    {
        if (empty($this->fields)) {
            $columns = '*';
        } else {
            $columns = $this->fields;
        }

        // skip the timestamp if false in model
        $columns = Timestamp::withoutTimestamps(
            $this->table,
            $this->con,
            [$columns],
            $timestamp
        );

        $sql = $this->selectStatement($columns)
            . $this->joins
            . $this->groupBy
            . $this->having
            . $this->orderBy
            . $this->offset
            . " WHERE "
            . $this->table . ".id = " . $id;
        $query = $this->con->query($sql);
        $this->result = $query->fetch(\PDO::FETCH_OBJ);
        return $this->result;
    }

    public function findOrFail($id, $timestamp = [])
    {
        $record = $this->find($id, $timestamp);

        if (!$record) {
            throw new \Exception("Record not found with ID: $id", 404);
        }

        return $record;
    }


    /**
     * @return array|false
     * @throws ErrorException
     */
    public function get($timestamp = [])
    {
        if (empty($this->fields)) {
            $columns = '*';
        } else {
            $columns = $this->fields;
        }

        // skip the timestamp if false in model
        $columns = Timestamp::withoutTimestamps(
            $this->table,
            $this->con,
            [$columns],
            $timestamp
        );

        $limitClause = $this->limit ?: '';
        $offsetClause = $this->offset ?: '';
        $sql = $this->selectStatement($columns)
            . $this->joins
            . $this->wheres
            . $this->take
            . $this->groupBy
            . $this->having
            . $this->orderBy
            . $limitClause
            . $offsetClause;
        $query = $this->con->query($sql);
        $this->result = $query->fetchAll(\PDO::FETCH_OBJ);
        return $this->result;
    }

    /***
     * @param $column
     * @param int $value
     * @return bool
     * @throws ErrorException
     */
    public function increment($column, int $value = 1): bool
    {
        $sql = $this->selectStatement($column) . $this->wheres;

        try {

            $query = $this->con->query($sql);
            $column_value = $query->fetch(\PDO::FETCH_OBJ);
            $increment = $column_value->$column + $value;
            $fields = array(
                "{$column}" => $increment
            );
            $result = $this->update($fields);
            return $result;
        }
        catch (Exception $e){
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * @param $column
     * @param int $value
     * @return bool
     * @throws ErrorException
     */
    public function decrement($column, int $value = 1): bool
    {
        $sql = $this->selectStatement($column) . $this->wheres;
        try {
            $query = $this->con->query($sql);
            $column_value = $query->fetch(\PDO::FETCH_OBJ);
            $increment = $column_value->$column - $value;
            $fields = array(
                "{$column}" => $increment
            );
            $result = $this->update($fields);
            return $result;

        }
        catch (Exception $e){
            throw new ErrorException($e->getMessage());
        }

    }

    /**
     * @param $column
     * @return mixed
     */
    public function sum($column)
    {
        $sql = "SELECT SUM({$column}) as sum FROM " . $this->table .$this->wheres;
        $query = $this->con->query($sql) ;
        $this->result = $query->fetch(\PDO::FETCH_OBJ);
        return $this->result->sum;
    }

    /**
     * @return mixed
     */
    public function count($column)
    {
        $sql = "SELECT COUNT({$column}) as count FROM " . $this->table . $this->wheres;
        $query = $this->con->query($sql) ;
        $this->result = $query->fetch(\PDO::FETCH_OBJ);
        return $this->result->count;
    }

    /**
     * @param $column
     * @return mixed
     */
    public function max($column)
    {
        $sql = "SELECT MAX({$column}) max FROM " . $this->table." ".$this->wheres;
        $query = $this->con->query($sql) ;
        $this->result = $query->fetch(\PDO::FETCH_OBJ);

        return $this->result->max;
    }

    /**
     * @param $column
     * @return mixed
     */
    public function min($column)
    {
        $sql = "SELECT MIN({$column}) min FROM " . $this->table." ".$this->wheres;
        $query = $this->con->query($sql) ;
        $this->result = $query->fetch(\PDO::FETCH_OBJ);
        return $this->result->min;
    }

    /**
     * @param $data
     * @return bool
     * @throws ErrorException
     */
    public function insert($data): bool
    {
        $fields = '`' . implode('`, `', array_keys($data)) . '`';
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$this->table} ($fields) VALUES ({$placeholders})";

        try {
            return $this->con->prepare($sql)->execute($data);
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }

    }

    /**
     * @param $data
     * @return string
     * @throws ErrorException
     */
    public function insertGetId($data): string
    {
        $fields = '`' . implode('`, `', array_keys($data)) . '`';
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$this->table} ($fields) VALUES ({$placeholders})";

        try {
            $exec = $this->con->prepare($sql);
            $exec->execute($data);
            $last_id = $this->con->lastInsertId();
            return $last_id;
        }catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * @param $fields
     * @return Doctrine
     * @throws \Core\Exception\Handlers\DBException
     */
    public function select()
    {
        $fields = func_get_args();

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

        unset($field);

        $this->fields = implode(',', $fields);

        return $this;
    }

    /**
     * @param $fields
     * @return bool
     * @throws ErrorException
     */
    public function update($fields)
    {
        // Fetch the current record(s) using the current where clause
        $current = $this->first();
        if (!$current) {
            return false;
        }

        // Remove unchanged fields (dirty checking)
        foreach ($fields as $name => $value) {
            if (isset($current->$name) && $current->$name == $value) {
                unset($fields[$name]);
            }
        }

        // If nothing changed, skip update
        if (empty($fields)) {
            return true; // No error, nothing to update
        }

        $query = "UPDATE {$this->table} SET ";
        foreach ($fields as $name => $value) {
            $query .= ' '.$name.' = :'.$name.',';
        }
        $query = substr($query, 0, -1);
        // Use $this->wheres for the WHERE clause
        $query .= $this->wheres;

        try {
            $exec = $this->con->prepare($query);
            $exec->execute($fields);
            $result = $exec->rowCount();
            if ($result > 0) {
                return true;
            }
            return false;
        }
        catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $query = "DELETE FROM {$this->table}";
        $query .= $this->wheres;

        try {
            $exec = $this->con->prepare($query);
            $result = $exec->execute();
            $delete = $exec->rowCount();
            if ($delete) {
                return true;
            }
            return false;
        }
        catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * @param $field
     * @param $order
     * @return Doctrine
     */
    public function orderBy($field, $order = 'ASC'): self
    {
        $this->orderBy = " ORDER BY {$field} {$order}";
        return $this;
    }

    public function orderByDesc($field): self
    {
        $this->orderBy = " ORDER BY {$field} DESC";
        return $this;
    }

    /**
     * @param $fields
     * @return Doctrine
     */
    public function groupBy($fields): self
    {
        $this->groupBy = " GROUP BY {$fields}";
        return $this;
    }

    /**
     * @param $column
     * @param $condition
     * @param $value
     * @return Doctrine
     */
    public function having($column,$condition,$value): self
    {
        $escapedValue = $value === null ? 'NULL' : "'" . addslashes($value) . "'";
        $this->having = " HAVING {$column} {$condition} {$escapedValue} ";
        return $this;
    }

    /**
     * @param $limit
     * @return Doctrine
     */
    public function limit($limit): self
    {
        $this->limit = " LIMIT {$limit} ";
        return $this;
    }

    /**
     * @param $offset
     * @return Doctrine
     */
    public function offset($offset): self
    {
        $this->offset = " OFFSET {$offset} ";
        return $this;
    }

    /*still working on it*/
    /*public function skip($skip){
        $query = " LIMIT {$skip} ";
        $this->statement .= $query;
        return new Doctrine($this->table);
    }*/

    /**
     * @param $take
     * @return Doctrine
     */
    public function take($take): self
    {
        $query = " LIMIT {$take} ";
        $this->take .= $query;
        return $this;
    }

    /**
     * @param $column
     * @param $condition
     * @param $value
     * @return Doctrine
     */
    public function where($column, $condition, $value): self
    {
        $escapedValue = $value === null ? 'NULL' : "'" . addslashes($value) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} {$condition} {$escapedValue} ";
        } else {
            $this->wheres .= " AND {$column} {$condition} {$escapedValue} ";
        }
        return $this;
    }

    /**
     * @param $column
     * @param $condition
     * @param $value
     * @return Doctrine
     */
    public function orWhere($column, $condition, $value): self
    {
        // Only strip prefix if there are no joins
        if (empty($this->joins) && str_contains($column, '.')) {
            list(, $col) = explode('.', $column, 2);
            $column = $col;
        }
        $escapedValue = $value === null ? 'NULL' : "'" . addslashes($value) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} {$condition} {$escapedValue} ";
        } else {
            $this->wheres .= " OR {$column} {$condition} {$escapedValue} ";
        }
        return $this;
    }

    /**
     * @param $column
     * @param $condition
     * @param $date
     * @return $this
     */
    public function whereDate($column, $condition, $date): self
    {
        $escapedValue = "'" . addslashes($date) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE DATE({$column}) {$condition} {$escapedValue} ";
        } else {
            $this->wheres .= " AND DATE({$column}) {$condition} {$escapedValue} ";
        }
        return $this;
    }

    /**
     * @param $column
     * @param $condition
     * @param $date
     * @return $this
     */
    public function orWhereDate($column, $condition, $date): self
    {
        $escapedValue = "'" . addslashes($date) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE DATE({$column}) {$condition} {$escapedValue} ";
        } else {
            $this->wheres .= " OR DATE({$column}) {$condition} {$escapedValue} ";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param string $operator
     * @param int $month
     * @return $this
     */
    public function whereMonth(string $column, string $operator, int $month): self
    {
        $escapedValue = (int) $month;
        if ($this->wheres === '') {
            $this->wheres = " WHERE MONTH({$column}) {$operator} {$escapedValue} ";
        } else {
            $this->wheres .= " AND MONTH({$column}) {$operator} {$escapedValue} ";
        }
        return $this;
    }

    /**
     * @param string $column
     * @param string $operator
     * @param int $year
     * @return $this
     */
    public function whereYear(string $column, string $operator, int $year): self
    {
        $escapedValue = (int) $year;
        if ($this->wheres === '') {
            $this->wheres = " WHERE YEAR({$column}) {$operator} {$escapedValue} ";
        } else {
            $this->wheres .= " AND YEAR({$column}) {$operator} {$escapedValue} ";
        }
        return $this;
    }

    /**
     * @param $column
     * @param array $values
     * @return $this
     */
    public function whereBetween($column, array $values): self
    {
        if (count($values) !== 2) {
            throw new \InvalidArgumentException('whereBetween requires exactly two values.');
        }

        $escapedFrom = "'" . addslashes($values[0]) . "'";
        $escapedTo   = "'" . addslashes($values[1]) . "'";

        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} BETWEEN {$escapedFrom} AND {$escapedTo} ";
        } else {
            $this->wheres .= " AND {$column} BETWEEN {$escapedFrom} AND {$escapedTo} ";
        }

        return $this;
    }

    /**
     * @param $column
     * @param array $values
     * @return $this
     */
    public function whereNotBetween($column, array $values): self
    {
        if (count($values) !== 2) {
            throw new \InvalidArgumentException('whereNotBetween requires exactly two values.');
        }

        $escapedFrom = "'" . addslashes($values[0]) . "'";
        $escapedTo   = "'" . addslashes($values[1]) . "'";

        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} NOT BETWEEN {$escapedFrom} AND {$escapedTo} ";
        } else {
            $this->wheres .= " AND {$column} NOT BETWEEN {$escapedFrom} AND {$escapedTo} ";
        }

        return $this;
    }

    /**
     * @param $column
     * @param $start
     * @param $end
     * @return $this
     */
    public function orWhereBetween($column, $start, $end): self
    {
        $escapedStart = "'" . addslashes($start) . "'";
        $escapedEnd = "'" . addslashes($end) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} BETWEEN {$escapedStart} AND {$escapedEnd} ";
        } else {
            $this->wheres .= " OR {$column} BETWEEN {$escapedStart} AND {$escapedEnd} ";
        }
        return $this;
    }

    /**
     * @param $column
     * @param $start
     * @param $end
     * @return $this
     */
    public function orWhereNotBetween($column, $start, $end): self
    {
        $escapedStart = "'" . addslashes($start) . "'";
        $escapedEnd = "'" . addslashes($end) . "'";
        if ($this->wheres === '') {
            $this->wheres = " WHERE {$column} NOT BETWEEN {$escapedStart} AND {$escapedEnd} ";
        } else {
            $this->wheres .= " OR {$column} NOT BETWEEN {$escapedStart} AND {$escapedEnd} ";
        }
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return Doctrine
     */
    public function join($table,$column,$equal,$second_column): self
    {
        $this->joins .= " INNER JOIN $table ON $column $equal $second_column ";
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return Doctrine
     */
    public function leftJoin($table,$column,$equal,$second_column): self
    {
        $this->joins .= " LEFT JOIN $table ON $column $equal $second_column ";
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return $this
     */
    public function rightJoin($table, $column, $equal, $second_column): self
    {
        $this->joins .= " RIGHT JOIN $table ON $column $equal $second_column ";
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @param $equal
     * @param $second_column
     * @return $this
     */
    public function fullOuterJoin($table, $column, $equal, $second_column): self
    {
        $this->joins .= " FULL OUTER JOIN $table ON $column $equal $second_column ";
        return $this;
    }

    /**
     * @param $limit
     * @param array $timestamp
     * @return array
     */
    public function paginate($limit, array $timestamp = [])
    {
        $pagination = [];

        $page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;

        // Get total count first
        $sql_statement = "SELECT count(*) as count FROM {$this->table}"
            . $this->joins
            . $this->wheres
            . $this->groupBy
            . $this->having;
        $count = $this->con->query($sql_statement);
        $total = $count->fetch(\PDO::FETCH_OBJ);
        $totalCount = (int)$total->count;
        $lastPage = (int) ceil($totalCount / $limit);

        // If requested page is greater than last page, set to last page
        if ($page > $lastPage && $lastPage > 0) {
            $page = $lastPage;
        }
        $offset = ($page - 1) * $limit;

        // Use existing $this->limit/$this->offset if set, otherwise use paginate's
        $limitClause = $this->limit ?: " LIMIT {$limit} ";
        $offsetClause = $this->offset ?: " OFFSET {$offset} ";

        // Get data for current page
        if (empty($this->fields)) {
            $columns = '*';
        } else {
            $columns = $this->fields;
        }

        // skip the timestamp if false in model
        $columns = Timestamp::withoutTimestamps(
            $this->table,
            $this->con,
            [$columns],
            $timestamp
        );

        $sql = "SELECT {$columns} FROM {$this->table}"
            . $this->joins
            . $this->wheres
            . $this->groupBy
            . $this->having
            . $this->orderBy
            . $limitClause
            . $offsetClause;
        $query = $this->con->query($sql);
        $result = $query->fetchAll(\PDO::FETCH_OBJ);

        $from = $totalCount > 0 ? $offset + 1 : 0;
        $to = $totalCount > 0 ? min($offset + $limit, $totalCount) : 0;

        $baseUrl = full_path();
        $pagination['data'] = $result;
        $pagination['current_page'] = $page;
        $pagination['per_page'] = $limit;
        $pagination['total'] = $totalCount;
        $pagination['last_page'] = $lastPage;
        $pagination['from'] = $from;
        $pagination['to'] = $to;
        $pagination['first_page_url'] = $baseUrl . '?page=1';
        $pagination['last_page_url'] = $baseUrl . '?page=' . $lastPage;
        $pagination['next_page_url'] = $page < $lastPage ? $baseUrl . '?page=' . ($page + 1) : null;
        $pagination['prev_page_url'] = $page > 1 ? $baseUrl . '?page=' . ($page - 1) : null;
        $pagination['path'] = $baseUrl;

        return $pagination;
    }

    public function simplePaginate($limit, $timestamp = [])
    {
        $pagination['simple'] = $this->paginate($limit, $timestamp);
        return $pagination;

    }

    /**
     * Pluck a single column's values from the result set.
     * @param string $column
     * @return array
     */
    public function pluck($columns): array
    {
        // Normalize columns: flatten if nested (e.g., [['id', 'name']] → ['id', 'name'])
        if (count($columns) === 1 && is_array($columns[0])) {
            $columns = $columns[0];
        }

        $results = $this->get();

        if (empty($results)) {
            return [];
        }

        // One column: return simple value list
        if (count($columns) === 1) {
            $column = $columns[0];
            return array_map(fn($item) => $item->$column ?? null, $results);
        }

        // Two columns: return associative array
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

        // More than 2: return array of subarrays
        return array_map(function ($item) use ($columns) {
            $row = [];
            foreach ($columns as $col) {
                $row[$col] = $item->$col ?? null;
            }
            return $row;
        }, $results);
    }


    /**
     * @return bool
     * @throws ErrorException
     */
    public function exists(): bool
    {
        $result = $this->limit(1)->first();
        return $result !== false && $result !== null;
    }

    /**
     * Get the first result or throw an exception if not found.
     * @return mixed
     * @throws Exception
     */
    public function firstOrFail($timestamp = [])
    {
        $result = $this->first($timestamp);
        if (!$result) {
            throw new Exception("No record found.");
        }
        return $result;
    }

    /**
     * Create a new record and return it.
     * @param array $data
     * @return mixed
     * @throws ErrorException
     */
    public function create(array $data)
    {
        $id = $this->insertGetId($data);
        return $this->find($id);
    }

    /**
     * Update an existing record or create a new one.
     * @param array $attributes
     * @param array $values
     * @return mixed
     * @throws ErrorException
     */
    public function updateOrCreate(array $attributes, array $values): mixed
    {
        // Find existing record based on attributes
        $record = $this;
        foreach ($attributes as $key => $value) {
            $record = $record->where($key, '=', $value);
        }
        $record = $record->first();

        if ($record) {
            unset($values['created_at']); // Prevent overwriting created_at
            $this->update($values);
            return $this->find($record->id);
        }

        unset($attributes['id']); // Never manually insert primary key
        return $this->create($attributes + $values);
    }


    /**
     * Add a whereIn clause to the query.
     * @param string $column
     * @param array $values
     * @return $this
     */
    public function whereIn($column, array $values): self
    {
        $in = implode(",", array_map(function($v) { 
            return $v === null ? 'NULL' : "'".addslashes($v)."'"; 
        }, $values));
        $query = " WHERE {$column} IN ({$in})";
        $this->wheres .= $query;
        return $this;
    }

    /**
     * Add a whereNull clause to the query.
     * @param string $column
     * @return $this
     */
    public function whereNull($column): self
    {
        $query = " WHERE {$column} IS NULL";
        $this->wheres .= $query;
        return $this;
    }

    /**
     * Add a whereNotNull clause to the query.
     * @param string $column
     * @return $this
     */
    public function whereNotNull($column): self
    {
        $query = " WHERE {$column} IS NOT NULL";
        $this->wheres .= $query;
        return $this;
    }

    /**
     * @param $columns
     * @return string
     */
    private function selectStatement($columns): string
    {
        return "SELECT {$columns} FROM {$this->table} ";
    }

}