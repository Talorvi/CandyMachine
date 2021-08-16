<?php

declare(strict_types=1);

namespace App\Validator;


use App\Exception\Type\WrongTypeException;

/**
 * Class IntArrayValidator
 * @package Validator
 */
class IntArrayValidator
{
    /**
     * Validate if array consists only of integers
     *
     * @param array $arr
     * @return bool
     * @throws WrongTypeException
     */
    public static function validate(array $arr): bool
    {
        foreach ($arr as $item) {
            if (!is_int($item)) {
                throw new WrongTypeException();
            }
        }

        return true;
    }
}