<?php

namespace CancioLabs\Ds\Queue\Exception;

use Exception;
use Throwable;

class EmptyQueueException extends Exception
{

    public function __construct(
        string $message,
        int $code = 0,
        ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }

}