<?php

namespace Core\Database\Traits\Builder;

use Core\Database\Doctrine;
use Core\Exception\Handlers\DBException;
use Core\Support\Str;
use Whoops\Exception\ErrorException;
use function getTable;

trait Builder
{
    use Clauses, Statements, Joins;

    protected $table;
    protected $hidden = [];
    protected $doctrine;

    /**
     * @throws DBException
     */
    public function __construct()
    {
        $this->initializeTableName();

        $this->initializeDoctrine();
    }

    /**
     * @return void
     */
    protected function initializeTableName(): void
    {
        // Automatically derive table name from model class if not explicitly defined
        if (empty($this->table)) {
            $this->table = Str::plural(getTable(static::class));
        }
    }

    /**
     * @return void
     * @throws DBException
     */
    protected function initializeDoctrine(): void
    {
        $this->doctrine = new Doctrine($this->table, $this->hidden);
    }

    public function hideFields()
    {
        return $this->hidden;
    }

    public function table()
    {
        return $this->table;
    }

    public function groupBy($fields)
    {
        return $this->doctrine->groupBy($fields);
    }

    /**
     * @return bool
     * @throws DBException
     * @throws ErrorException
     */
    public function save(): bool
    {
        $data = $this->attributes;

        if (empty($data)) {
            throw new \Exception('No data to save');
        }

        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);

            if (empty($data)) {
                // Nothing to update
                return true;
            }

            $updated = static::where('id', '=', $id)->update($data);

            // Restore id in attributes
            $this->attributes['id'] = $id;

            return $updated;
        }

        return static::insert($data);
    }


    /**
     * Get the model's attributes
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Delete the model instance
     * @return bool
     * @throws \Exception
     */
    public function delete(): bool
    {
        if (!isset($this->attributes['id'])) {
            throw new \Exception('Cannot delete model without ID');
        }

        return static::where('id', '=', $this->attributes['id'])->delete();
    }
}