<?php

declare(strict_types=1);

namespace App\Exception\Machine;


use Exception;

/**
 * Class CoinInventoryFullException
 * @package App\Exception\Machine
 */
final class CoinInventoryFullException extends Exception
{
    /**
     * @var string
     */
    protected $message = "Coin inventory is full. Turn the knob to retrieve your item.";
}