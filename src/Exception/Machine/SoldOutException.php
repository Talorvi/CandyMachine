<?php

declare(strict_types=1);

namespace App\Exception\Machine;


use Exception;

final class SoldOutException extends Exception
{
    protected $message = "Sorry, there are no more items in the machine.";
}