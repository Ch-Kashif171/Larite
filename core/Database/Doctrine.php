<?php

namespace Core\Database;

use Core\Database\Contracts\DoctrineContract;
use Core\Database\Traits\AggregateTrait;
use Core\Database\Traits\ClauseTrait;
use Core\Database\Traits\JoinTrait;
use Core\Database\Traits\MutationTrait;
use Core\Database\Traits\PaginationTrait;
use Core\Database\Traits\RetrievalTrait;
use Core\Database\Traits\SelectTrait;
use Core\Database\Traits\WhereTrait;
use Core\Support\Traits\Internal\Queries;

/**
 * Main Query ORMQueryBuilder class implementing the contract and composing traits.
 */
class Doctrine implements DoctrineContract
{
    use Queries; // Assuming this sets $con, $table, etc.
    use SelectTrait;
    use RetrievalTrait;
    use AggregateTrait;
    use MutationTrait;
    use WhereTrait;
    use JoinTrait;
    use ClauseTrait;
    use PaginationTrait;

    /**
     * @param string $columns
     * @return string
     */
    protected function buildSelectQuery(string $columns): string
    {
        $limitClause = $this->limit ?: '';
        $offsetClause = $this->offset ?: '';
        $takeClause = $this->take ?: '';

        return "SELECT {$columns} FROM {$this->table}"
            . $this->joins
            . $this->wheres
            . $takeClause
            . $this->groupBy
            . $this->having
            . $this->orderBy
            . $limitClause
            . $offsetClause;
    }

    public function getWheres(): string
    {
        return $this->wheres;
    }

}

