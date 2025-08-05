<?php

namespace Core\Exception\Handlers;

use Exception;
use Throwable;

class SimpleException extends Exception
{
    protected string $shortMessage;
    protected string $file;
    protected int $line;
    protected string $trace;

    /**
     * @param Throwable $e
     */
    public function __construct(Throwable $e)
    {
        $this->shortMessage = $e->getMessage();
        $this->file = $e->getFile();
        $this->line = $e->getLine();
        $this->trace = $e->getTraceAsString();

        // Call parent constructor with original message, code and previous exception
        parent::__construct($this->shortMessage, $e->getCode(), $e);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "Exception: %s\nFile: %s\nLine: %d\n",
            $this->getMessage(),
            $this->getFile(),
            $this->getLine()
        );
    }

}

