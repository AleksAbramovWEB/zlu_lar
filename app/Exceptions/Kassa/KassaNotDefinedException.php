<?php

namespace App\Exceptions\Kassa;

use Exception;
use Throwable;

class KassaNotDefinedException extends Exception
{
    public function __construct($message = "Касса ранее не определена", $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}
