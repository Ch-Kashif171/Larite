<?php

namespace App\Facades;

use Core\Support\Facades\Facade;

class Custom extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cache'; // This is the binding key in the container
    }

}