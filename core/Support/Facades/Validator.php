<?php

namespace Core\Support\Facades;

/**
 * @method validate(array $fields, array $rules)
 */

class Validator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'validator';
    }
}