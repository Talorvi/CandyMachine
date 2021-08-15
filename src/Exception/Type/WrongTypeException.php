<?php

declare(strict_types=1);

namespace App\Exception\Type;


use Exception;

final class WrongTypeException extends Exception
{
    protected $message = "Wrong type.";
}