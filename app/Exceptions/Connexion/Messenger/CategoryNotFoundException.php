<?php

namespace App\Exceptions\Connexion\Messenger;

use Exception;
use Throwable;

class CategoryNotFoundException extends Exception
{

    public function __construct($message = "не верно указан тип категории сообщений", $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }

}
