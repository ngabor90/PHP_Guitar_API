<?php

class DBException extends Exception
{
    public function __construct(string $message, Throwable $previous)
    {
        parent::__construct($message, 10, $previous);
    }
}
