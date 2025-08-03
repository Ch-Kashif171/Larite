<?php

namespace Core\Console;

use Core\Scheduling\Schedule;
use Core\Scheduling\Event;
use Core\Scheduling\ScheduleRun;
use Symfony\Component\Console\Application;

abstract class BaseKernel
{
    protected Application $console;

    public function __construct()
    {
        $this->console = new Application();

        // Dynamically schedule commands
        if (method_exists($this, 'schedule')) {
            $schedule = new Schedule();
            $this->schedule($schedule);

            foreach ($schedule->getCommands() as $event) {
                if ($event instanceof Event && class_exists($event->command)) {
                    $this->console->add(new $event->command);
                }
            }
        }
    }

    protected array $commands = [
        ScheduleRun::class, // Internal command, not shown to app developers
    ];

    public function getCommands(): array
    {
        return $this->commands;
    }

}
