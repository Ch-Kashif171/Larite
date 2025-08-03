<?php

namespace Core\Scheduling;

class Schedule
{
    protected array $events = [];

    /**
     * @param string $commandClass
     * @return ScheduledCommand
     */
    public function command(string $commandClass): ScheduledCommand
    {
        $event = new ScheduledCommand($commandClass);
        $this->events[] = $event;
        return $event;
    }

    /**
     * @return array
     */
    public function dueEvents(): array
    {
        return array_filter($this->events, fn($event) => $event->isDue());
    }
}

