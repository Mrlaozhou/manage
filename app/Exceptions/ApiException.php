<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ApiException extends Exception
{
    //
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message);
    }
}
