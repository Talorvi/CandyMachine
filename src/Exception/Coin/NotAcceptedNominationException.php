<?php

declare(strict_types=1);

namespace App\Exception\Coin;


use Exception;

final class NotAcceptedNominationException extends Exception
{
    protected $message = "This nomination is not accepted.";
}