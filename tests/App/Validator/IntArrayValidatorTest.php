<?php

namespace Tests\App\Validator;

use App\Exception\Type\WrongTypeException;
use App\Validator\IntArrayValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class IntArrayValidatorTest
 * @package Tests\App\Validator
 */
class IntArrayValidatorTest extends TestCase
{
    /**
     * Tests if a proper array is positively validated
     */
    public function testIntArrayValidatorPositive()
    {
        try {
            $result = IntArrayValidator::validate([2, 3, 4, 5]);
            self::assertTrue($result);
        } catch (WrongTypeException $e) {
        }
    }

    /**
     * Tests if given an improper array returns an exception
     *
     * @throws WrongTypeException
     */
    public function testIntArrayValidatorWrongTypeException()
    {
        $this->expectException(WrongTypeException::class);

        $result = IntArrayValidator::validate([2, "test", 4, 5]);
    }
}
