<?php

namespace Core\Database\Contracts;

use Core\Support\Collection\Collection;
use PDO;

/**
 * Contract for the Query ORMQueryBuilder, inspired by Laravel's Query ORMQueryBuilder contract.
 */
interface DoctrineContract
{

    public function select(...$fields): self;
    public function first(array $timestamp = [], array $hidden = []): mixed;
    public function find($id, array $timestamp = []): mixed;
    public function findOrFail($id, array $timestamp = []): mixed;
    public function get(array $timestamp = [], array $hidden = []): array|false;
    public function increment(string $column, int $value = 1): bool;
    public function decrement(string $column, int $value = 1): bool;
    public function sum(string $column): mixed;
    public function count(string $column): mixed;
    public function max(string $column): mixed;
    public function min(string $column): mixed;
    public function insert(array $rows): bool;
    public function insertGetId(array $data): string;
    public function update(array $fields): bool;
    public function delete(): bool;
    public function orderBy(string $field, string $order = 'ASC'): self;
    public function orderByDesc(string $field): self;
    public function groupBy(string $fields): self;
    public function having(string $column, string $condition, mixed $value): self;
    public function limit(int $limit): self;
    public function offset(int $offset): self;
    public function take(int $take): self;
    public function where(string $column, string $condition, mixed $value): self;
    public function orWhere(string $column, string $condition, mixed $value): self;
    public function whereDate(string $column, string $condition, string $date): self;
    public function orWhereDate(string $column, string $condition, string $date): self;
    public function whereDay(string $column, string $operator, int $day): self;
    public function whereDayOfWeek(string $column, string $operator, int $day): self;
    public function whereTime(string $column, string $operator, string $time): self;
    public function whereMonth(string $column, string $operator, int $month): self;
    public function whereYear(string $column, string $operator, int $year): self;
    public function whereBetween(string $column, array $values): self;
    public function whereNotBetween(string $column, array $values): self;
    public function orWhereBetween(string $column, mixed $start, mixed $end): self;
    public function orWhereNotBetween(string $column, mixed $start, mixed $end): self;
    public function join(string $table, string $column, string $equal, string $second_column): self;
    public function leftJoin(string $table, string $column, string $equal, string $second_column): self;
    public function rightJoin(string $table, string $column, string $equal, string $second_column): self;
    public function fullOuterJoin(string $table, string $column, string $equal, string $second_column): self;
    public function paginate(int $limit, array $timestamp = []): array;
    public function simplePaginate(int $limit, array $timestamp = []): array;
    public function pluck(array|string $columns): Collection;
    public function exists(): bool;
    public function firstOrFail(array $timestamp = []): mixed;
    public function create(array $data): mixed;
    public function createMany(array $records): bool;
    public function updateOrCreate(array $attributes, array $values): mixed;
    public function whereIn(string $column, array $values): self;
    public function whereNull(string $column): self;
    public function whereNotNull(string $column): self;
    public function truncate(): bool;

}