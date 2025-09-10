<?php

namespace App\Console;

use Lumite\Console\BaseKernel;
use Lumite\Scheduling\Schedule;

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
