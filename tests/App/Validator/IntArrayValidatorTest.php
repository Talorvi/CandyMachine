<?php

namespace Tests\App\Validator;

use App\Exception\Type\WrongTypeException;
use App\Validator\IntArrayValidator;
use PHPUnit\Framework\TestCase;

class IntArrayValidatorTest extends TestCase
{
    public function testIntArrayValidatorPositive()
    {
        try {
            $result = IntArrayValidator::validate([2, 3, 4, 5]);
            self::assertTrue($result);
        } catch (WrongTypeException $e) {
        }
    }

    public function testIntArrayValidatorWrongTypeException()
    {
        $this->expectException(WrongTypeException::class);

        $result = IntArrayValidator::validate([2, "test", 4, 5]);
    }
}
