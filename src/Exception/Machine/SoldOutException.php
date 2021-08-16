<?php

declare(strict_types=1);

namespace App\Exception\Machine;


use Exception;

/**
 * Class SoldOutException
 * @package App\Exception\Machine
 */
final class SoldOutException extends Exception
{
    /**
     * @var string
     */
    protected $message = "Sorry, there are no more items in the machine.";
}