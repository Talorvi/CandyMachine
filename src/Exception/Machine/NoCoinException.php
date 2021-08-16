<?php

declare(strict_types=1);

namespace App\Exception\Machine;


use Exception;

/**
 * Class NoCoinException
 * @package App\Exception\Machine
 */
final class NoCoinException extends Exception
{
    /**
     * @var string
     */
    protected $message = "No coin was put to the machine.";
}