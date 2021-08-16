<?php

namespace Tests\App\Validator;

use App\Exception\Coin\InvalidCoinNominationException;
use App\Exception\Coin\NotAcceptedNominationException;
use App\Exception\Type\WrongTypeException;
use App\Model\Coin;
use App\Validator\CoinValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class CoinValidatorTest
 * @package Tests\App\Validator
 */
class CoinValidatorTest extends TestCase
{
    /**
     * @var CoinValidator
     */
    private CoinValidator $coinValidator;

    /**
     *
     */
    public function setUp(): void
    {
        $this->coinValidator = new CoinValidator();
    }

    /**
     * Tests if default values are not null
     */
    public function testGetAcceptedNominations()
    {
        $acceptedNominations = $this->coinValidator->getAcceptedNominations();
        self::assertIsArray($acceptedNominations);
        self::assertNotNull($acceptedNominations);
    }

    /**
     * Tests if proper array can be set as accepted nominations
     */
    public function testSetAcceptedNominations()
    {
        $newAcceptedNominations = [1, 2, 3, 4];
        $this->coinValidator->setAcceptedNominations($newAcceptedNominations);

        self::assertEquals($newAcceptedNominations, $this->coinValidator->getAcceptedNominations());
    }

    /**
     * Tests if wrong nominations will print an error message
     */
    public function testSetAcceptedNominationsFail()
    {
        $this->expectOutputString((new WrongTypeException)->getMessage());

        $newAcceptedNominations = [1, "test", 3, 4];
        $this->coinValidator->setAcceptedNominations($newAcceptedNominations);

        self::assertNotEquals($newAcceptedNominations, $this->coinValidator->getAcceptedNominations());
    }

    /**
     * Tests if default values are not null
     */
    public function testGetExistingNominations()
    {
        $existingNominations = $this->coinValidator->getExistingNominations();
        self::assertIsArray($existingNominations);
        self::assertNotNull($existingNominations);
    }

    /**
     * Tests if proper array can be set as existing nominations
     */
    public function testSetExistingNominations()
    {
        $newExistingNominations = [1, 2, 3, 4];
        $this->coinValidator->setExistingNominations($newExistingNominations);

        self::assertEquals($newExistingNominations, $this->coinValidator->getExistingNominations());
    }

    /**
     * Tests if wrong nominations will print an error message
     */
    public function testSetExistingNominationsFail()
    {
        $this->expectOutputString((new WrongTypeException)->getMessage());

        $newExistingNominations = [1, "test", 3, 4];
        $this->coinValidator->setExistingNominations($newExistingNominations);

        self::assertNotEquals($newExistingNominations, $this->coinValidator->getExistingNominations());
    }

    /**
     * Tests if a proper coin is validated properly
     */
    public function testValidate()
    {
        $coin = $this->coinValidator->validate(200);
        self::assertInstanceOf(Coin::class, $coin);
    }

    /**
     * Tests if invalid coin nomination is being recognized properly
     *
     * @throws InvalidCoinNominationException
     */
    public function testValidateInvalidCoinNominationException()
    {
        $this->expectException(InvalidCoinNominationException::class);

        $coin = $this->coinValidator->validate(3);
    }

    /**
     * Tests if not accepted coin nomination is being recognized properly
     *
     * @throws NotAcceptedNominationException
     */
    public function testValidateNotAcceptedNominationException()
    {
        $this->expectException(NotAcceptedNominationException::class);

        $coin = $this->coinValidator->validate(100);
    }
}
