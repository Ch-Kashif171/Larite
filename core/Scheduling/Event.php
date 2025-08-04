<?php

namespace Core\Scheduling;


class Event
{
    /**
     * @var string
     */
    public string $expression = '* * * * *';

    /**
     * @var string
     */
    public string $commandClass;

    /**
     * @param string $commandClass
     */
    public function __construct(string $commandClass)
    {
        $this->commandClass = $commandClass;
    }

    /**
     * @param string $expression
     * @return $this
     */
    public function cron(string $expression): static
    {
        $this->expression = $expression;
        return $this;
    }

    /**
     * @return $this
     */
    public function everyMinute(): static
    {
        return $this->cron('* * * * *');
    }

    /**
     * @return $this
     */
    public function everyFiveMinutes(): static
    {
        return $this->cron('*/5 * * * *');
    }

    /**
     * @return $this
     */
    public function everyTenMinutes(): static
    {
        return $this->cron('*/10 * * * *');
    }

    /**
     * @return $this
     */
    public function everyFifteenMinutes(): static
    {
        return $this->cron('*/15 * * * *');
    }

    /**
     * @return $this
     */
    public function everyThirtyMinutes(): static
    {
        return $this->cron('0,30 * * * *');
    }

    /**
     * @return $this
     */
    public function hourly(): static
    {
        return $this->cron('0 * * * *');
    }

    /**
     * @return $this
     */
    public function daily(): static
    {
        return $this->cron('0 0 * * *');
    }

    /**
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function twiceDaily(int $first = 1, int $second = 13): static
    {
        return $this->cron("0 {$first},{$second} * * *");
    }

    /**
     * @return $this
     */
    public function weekdays(): static
    {
        return $this->cron('0 0 * * 1-5');
    }

    /**
     * @return $this
     */
    public function weekends(): static
    {
        return $this->cron('0 0 * * 6,0');
    }

    /**
     * @return $this
     */
    public function weekly(): static
    {
        return $this->cron('0 0 * * 0');
    }

    /**
     * @return $this
     */
    public function monthly(): static
    {
        return $this->cron('0 0 1 * *');
    }

    /**
     * @return $this
     */
    public function yearly(): static
    {
        return $this->cron('0 0 1 1 *');
    }

    /**
     * @return bool
     */
    public function isDue(): bool
    {
        return (new SimpleCron($this->expression))->isDue();
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $command = new $this->commandClass();
        $command->handle();
    }
}
