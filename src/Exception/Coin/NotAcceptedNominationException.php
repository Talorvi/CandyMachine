<?php

declare(strict_types=1);

namespace App\Exception\Coin;


use Exception;

/**
 * Class NotAcceptedNominationException
 * @package App\Exception\Coin
 */
final class NotAcceptedNominationException extends Exception
{
    /**
     * @var string
     */
    protected $message = "This nomination is not accepted.";
}