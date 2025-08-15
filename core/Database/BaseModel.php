<?php
namespace Core\Database;

use Core\Database\Traits\Builder\Arrayable;
use Core\Database\Traits\Builder\Builder;
use Core\Database\Traits\Builder\OrmMethods;
use Core\Database\Traits\Builder\Relational;
use Core\Database\Traits\Builder\StaticForwarding;
use Core\Database\Traits\Timestampable;

/**
 * Base ORM Model
 *
 * @property int $id
 */
class BaseModel
{
    use Builder,
        StaticForwarding,
        OrmMethods,
        Relational,
        Arrayable,
        Timestampable;
}