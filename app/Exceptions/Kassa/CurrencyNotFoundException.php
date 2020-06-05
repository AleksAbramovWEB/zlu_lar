<?php

namespace App\Exceptions\Kassa;

use Exception;
use Throwable;

class CurrencyNotFoundException extends Exception
{
    public function __construct($message = "указанная валюта не найдена", $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}
