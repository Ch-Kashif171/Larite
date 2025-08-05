<?php
namespace App\Models;

use Core\Database\BaseModel;

class User extends BaseModel
{

    protected $hidden = ['password'];
}
