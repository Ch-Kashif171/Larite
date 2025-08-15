<?php

namespace Core\Database\Traits;

trait Timestampable
{
    /**
     * @var bool
     */
    protected $timestamp = true;

    /**
     * @var bool
     */
    protected static bool $isTimestamp = true;

    /**
     * @return bool
     */
    public static function getIsTimestamp(): bool
    {
        return static::$isTimestamp;
    }

    public function getTimestamp(): bool
    {
        return $this->timestamp;
    }

}