<?php

namespace App\Exceptions\Connexion\News;

use Exception;

class ParamIsNotObject extends Exception
{
    public function __construct($message = "параметр не является обьектом", $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}
