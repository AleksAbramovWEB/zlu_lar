<?php

namespace App\Exceptions\Kassa;

use Exception;
use Throwable;

class KassaNotFoundException extends Exception
{
    public function __construct($message = "касса не найдена", $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}
