<?php

namespace Core\Scheduling;

use App\Console\Kernel;

class ScheduleRunner
{
    protected Schedule $schedule;

    public function __construct()
    {
        $this->schedule = new Schedule();
    }

    public function getSchedule(): Schedule
    {
        $kernel = new Kernel();

        if (method_exists($kernel, 'schedule')) {
            $kernel->schedule($this->schedule);
        }

        return $this->schedule;
    }
}
