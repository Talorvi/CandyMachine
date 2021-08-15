<?php

namespace Tests\App\Validator;

use App\Exception\Coin\InvalidCoinNominationException;
use App\Exception\Coin\NotAcceptedNominationException;
use App\Exception\Type\WrongTypeException;
use App\Model\Coin;
use App\Validator\CoinValidator;
use PHPUnit\Framework\TestCase;

class CoinValidatorTest extends TestCase
{
    private CoinValidator $coinValidator;

    public function setUp(): void
    {
        $this->coinValidator = new CoinValidator();
    }

    public function testGetAcceptedNominations()
    {
        $acceptedNominations = $this->coinValidator->getAcceptedNominations();
        self::assertIsArray($acceptedNominations);
        self::assertNotNull($acceptedNominations);
    }

    public function testSetAcceptedNominations()
    {
        $newAcceptedNominations = [1, 2, 3, 4];
        $this->coinValidator->setAcceptedNominations($newAcceptedNominations);

        self::assertEquals($newAcceptedNominations, $this->coinValidator->getAcceptedNominations());
    }

    public function testSetAcceptedNominationsFail()
    {
        $this->expectOutputString((new WrongTypeException)->getMessage());

        $newAcceptedNominations = [1, "test", 3, 4];
        $this->coinValidator->setAcceptedNominations($newAcceptedNominations);

        self::assertNotEquals($newAcceptedNominations, $this->coinValidator->getAcceptedNominations());
    }

    public function testGetExistingNominations()
    {
        $existingNominations = $this->coinValidator->getExistingNominations();
        self::assertIsArray($existingNominations);
        self::assertNotNull($existingNominations);
    }

    public function testSetExistingNominations()
    {
        $newExistingNominations = [1, 2, 3, 4];
        $this->coinValidator->setExistingNominations($newExistingNominations);

        self::assertEquals($newExistingNominations, $this->coinValidator->getExistingNominations());
    }

    public function testSetExistingNominationsFail()
    {
        $this->expectOutputString((new WrongTypeException)->getMessage());

        $newExistingNominations = [1, "test", 3, 4];
        $this->coinValidator->setExistingNominations($newExistingNominations);

        self::assertNotEquals($newExistingNominations, $this->coinValidator->getExistingNominations());
    }

    public function testValidate()
    {
        try {
            $coin = $this->coinValidator->validate(200);
            self::assertInstanceOf(Coin::class, $coin);
        } catch (InvalidCoinNominationException | NotAcceptedNominationException $e) {
        }
    }

    public function testValidateInvalidCoinNominationException()
    {
        $this->expectException(InvalidCoinNominationException::class);

        $coin = $this->coinValidator->validate(3);
    }

    public function testValidateNotAcceptedNominationException()
    {
        $this->expectException(NotAcceptedNominationException::class);

        $coin = $this->coinValidator->validate(100);
    }
}
