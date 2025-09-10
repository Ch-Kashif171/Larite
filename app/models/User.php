<?php

namespace App\Models;

use Lumite\Database\BaseModel;

class User extends BaseModel
{
    protected $hidden = ['password'];
}
