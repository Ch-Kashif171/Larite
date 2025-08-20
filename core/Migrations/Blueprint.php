<?php

namespace Core\Migrations;

class Blueprint
{
    public mixed $statement = '';

    public array $columns = [];

    public function __construct($statement = '')
    {
        $this->statement = $statement;
    }

    /**
     * @param $column
     * @return Blueprint
     */
    public function increments($column)
    {
        $this->statement = " {$column} INT UNSIGNED NOT NULL AUTO_INCREMENT, PRIMARY KEY ({$column}) ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @param int $length
     * @return Blueprint
     */
    public function string($column, $length = 255)
    {
        $this->statement = " {$column} VARCHAR({$length}) ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @param $allowed
     * @return Blueprint
     */
    public function enum($column, $allowed)
    {
        $allow = '';
        foreach ($allowed as $all) {
            $allow .= " '" . $all . "' ,";
        }
        $allow = rtrim($allow, ',');
        $this->statement = " {$column} ENUM({$allow}) ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return Blueprint
     */
    public function text($column)
    {
        $this->statement = " {$column} TEXT ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function mediumText($column)
    {
        $this->statement = " {$column} MEDIUMTEXT ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function longText($column)
    {
        $this->statement = " {$column} LONGTEXT ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function json($column)
    {
        $this->statement = " {$column} JSON ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @param $length
     * @return $this
     */
    public function integer($column, $length = 11)
    {
        $this->statement = " {$column} INT({$length}) ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function bigInteger($column)
    {
        $this->statement = " {$column} BIGINT ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function smallInteger($column)
    {
        $this->statement = " {$column} SMALLINT ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function tinyInteger($column)
    {
        $this->statement = " {$column} TINYINT ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function boolean($column)
    {
        $this->statement = " {$column} TINYINT(1) ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @param $total
     * @param $places
     * @return $this
     */
    public function float($column, $total = 8, $places = 2)
    {
        $this->statement = " {$column} FLOAT({$total},{$places}) ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @param $total
     * @param $places
     * @return $this
     */
    public function double($column, $total = 15, $places = 8)
    {
        $this->statement = " {$column} DOUBLE({$total},{$places}) ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @param $total
     * @param $places
     * @return $this
     */
    public function decimal($column, $total = 8, $places = 2): static
    {
        $this->statement = " {$column} DECIMAL({$total},{$places}) ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function date($column): static
    {
        $this->statement = " {$column} DATE ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function time($column): static
    {
        $this->statement = " {$column} TIME ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function year($column): static
    {
        $this->statement = " {$column} YEAR ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function dateTime($column): static
    {
        $this->statement = " {$column} DATETIME ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function timestamp($column): static
    {
        $this->statement = " {$column} TIMESTAMP ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function binary($column): static
    {
        $this->statement = " {$column} BLOB ";
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }

    // ---------- Modifiers ----------

    /**
     * @return $this
     */
    public function unique(): static
    {
        if (!empty($this->columns)) {
            $last = count($this->columns) - 1;
            $this->columns[$last]->statement .= " UNIQUE ";
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function nullable(): static
    {
        if (!empty($this->columns)) {
            $last = count($this->columns) - 1;
            $this->columns[$last]->statement .= " NULL ";
        }
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function default($value): static
    {
        if (!empty($this->columns)) {
            $last = count($this->columns) - 1;
            if (is_string($value)) {
                $value = "'{$value}'";
            }
            $this->columns[$last]->statement .= " DEFAULT {$value} ";
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function unsigned(): static
    {
        if (!empty($this->columns)) {
            $last = count($this->columns) - 1;
            $this->columns[$last]->statement .= " UNSIGNED ";
        }
        return $this;
    }

    /**
     * @return Blueprint
     */
    public function timestamps(): static
    {
        $this->statement = ' created_at TIMESTAMP NULL, updated_at TIMESTAMP NULL ';
        $this->columns[] = new Blueprint($this->statement);
        return $this;
    }
}

return new Blueprint();
