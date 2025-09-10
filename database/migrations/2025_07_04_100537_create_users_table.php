<?php

use Lumite\Migrations\Blueprint;
use Lumite\Migrations\Migrate;

class CreateUsersTable extends Migrate
{
    public function up()
    {
        Migrate::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Migrate::dropIfExists('users');
    }
}