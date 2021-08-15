<?php

declare(strict_types=1);

namespace App\Exception\Machine;


use Exception;

final class NoCoinException extends Exception
{
    protected $message = "No coin was put to the machine.";
}