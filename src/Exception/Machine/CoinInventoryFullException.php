<?php

declare(strict_types=1);

namespace App\Exception\Machine;


use Exception;

final class CoinInventoryFullException extends Exception
{
    protected $message = "Coin inventory is full. Turn the knob to retrieve your item.";
}