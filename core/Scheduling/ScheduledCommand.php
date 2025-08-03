<?php

namespace Core\Scheduling;


use Cron\CronExpression;

class ScheduledCommand
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

    public function everyFiveMinutes(): static
    {
        return $this->cron('*/5 * * * *');
    }

    public function everyTenMinutes(): static
    {
        return $this->cron('*/10 * * * *');
    }

    public function everyFifteenMinutes(): static
    {
        return $this->cron('*/15 * * * *');
    }

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

    public function twiceDaily(int $first = 1, int $second = 13): static
    {
        return $this->cron("0 {$first},{$second} * * *");
    }

    public function weekdays(): static
    {
        return $this->cron('0 0 * * 1-5');
    }

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

    public function monthly(): static
    {
        return $this->cron('0 0 1 * *');
    }

    public function yearly(): static
    {
        return $this->cron('0 0 1 1 *');
    }

    /**
     * @return bool
     */
    public function isDue(): bool
    {
        $cron = CronExpression::factory($this->expression);
        return $cron->isDue();
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
