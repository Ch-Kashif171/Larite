<?php

namespace App\Console;

use App\Console\Commands\SyncUser;
use Core\Console\BaseKernel;
use Core\Scheduling\Schedule;

class Kernel extends BaseKernel
{
    /**
     * @var array|string[]
     */
    protected array $commands = [
       // SyncUser::class,
    ];

    /**
     * @param Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
       // $schedule->command(SyncUser::class)->everyMinute();
    }
}
