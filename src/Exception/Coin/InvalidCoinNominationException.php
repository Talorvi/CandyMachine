<?php

declare(strict_types=1);

namespace App\Exception\Coin;


use Exception;

final class InvalidCoinNominationException extends Exception
{
    protected $message = "This coin nomination does not exist.";
}