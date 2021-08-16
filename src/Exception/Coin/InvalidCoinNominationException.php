<?php

declare(strict_types=1);

namespace App\Exception\Coin;


use Exception;

/**
 * Class InvalidCoinNominationException
 * @package App\Exception\Coin
 */
final class InvalidCoinNominationException extends Exception
{
    /**
     * @var string
     */
    protected $message = "This coin nomination does not exist.";
}