<?php

namespace App\Console;

use App\Console\Commands\SyncUser;
use Core\Console\BaseKernel;

class Kernel extends BaseKernel
{
    /**
     * Register all commands here
     * @var array|string[]
     */
    public array $commands = [
        SyncUser::class,
    ];
}
