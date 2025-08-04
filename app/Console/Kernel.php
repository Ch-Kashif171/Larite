<?php

namespace App\Console;

use Core\Console\BaseKernel;
use Core\Scheduling\Schedule;

class Kernel extends BaseKernel
{
    /**
     * @var array|string[]
     */
    protected array $commands = [
      //  SyncUsers::class,
    ];

    /**
     * @param Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
      // $schedule->command(SyncUsers::class)->everyMinute();
    }
}
