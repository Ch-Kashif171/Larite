<?php

namespace Core\Scheduling;

class Event
{
    public string $command;
    protected string $expression = '* * * * *'; // default every minute

    public function __construct(string $command)
    {
        $this->command = $command;
    }

    public function getCommandClass(): string
    {
        return $this->command;
    }

    public function cron(string $expression): static
    {
        $this->expression = $expression;
        return $this;
    }

    public function daily(): static
    {
        return $this->cron('0 0 * * *');
    }

    public function hourly(): static
    {
        return $this->cron('0 * * * *');
    }

    public function everyMinute(): static
    {
        return $this->cron('* * * * *');
    }

    public function isDue(): bool
    {
        return (new SimpleCron($this->expression))->isDue();
    }
}
