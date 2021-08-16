<?php

declare(strict_types=1);

namespace App\Exception\Type;


use Exception;

/**
 * Class WrongTypeException
 * @package App\Exception\Type
 */
final class WrongTypeException extends Exception
{
    /**
     * @var string
     */
    protected $message = "Wrong type.";
}