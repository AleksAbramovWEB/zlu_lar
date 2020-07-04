<?php

namespace App\Exceptions\Connexion\News;

use Exception;

class NewsAddClassNotFound extends Exception
{
    public function __construct($message = "не верно указан тип новостей", $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}
