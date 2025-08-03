<?php

namespace Core\Scheduling;

use DateTime;

class SimpleCron
{
    protected array $fields;

    public function __construct(protected string $expression)
    {
        $this->fields = preg_split('/\s+/', trim($expression));

        if (count($this->fields) !== 5) {
            throw new \InvalidArgumentException("Invalid cron expression: $expression");
        }
    }

    public function isDue(DateTime $now = new DateTime()): bool
    {
        [$min, $hour, $day, $month, $weekday] = $this->fields;

        return $this->matches($min, (int)$now->format('i')) &&
            $this->matches($hour, (int)$now->format('G')) &&
            $this->matches($day, (int)$now->format('j')) &&
            $this->matches($month, (int)$now->format('n')) &&
            $this->matches($weekday, (int)$now->format('w'));
    }

    protected function matches(string $expr, int $current): bool
    {
        if ($expr === '*') return true;

        foreach (explode(',', $expr) as $val) {
            if ((int)$val === $current) return true;
        }

        return false;
    }
}
