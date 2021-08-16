<?php

namespace Tests\App\Model\Machine;

use App\Exception\Coin\InvalidCoinNominationException;
use App\Exception\Coin\NotAcceptedNominationException;
use App\Exception\Machine\CoinInventoryFullException;
use App\Exception\Machine\NoCoinException;
use App\Exception\Machine\SoldOutException;
use App\Model\Coin;
use App\Model\Item\Candy;
use App\Model\Machine\CandyMachine;
use App\Model\State\Candy\ClosedState;
use App\Model\State\Candy\OpenState;
use PHPUnit\Framework\TestCase;

/**
 * Class CandyMachineTest
 * @package Tests\Model\Machine
 */
class CandyMachineTest extends TestCase
{
    /**
     * @var CandyMachine
     */
    private CandyMachine $candyMachine;

    /**
     *
     */
    public function setUp(): void
    {
        $this->candyMachine = new CandyMachine(10);
    }

    /**
     * Tests if the application runs properly in the right scenario
     */
    public function testValidScenario()
    {
        $this->expectOutputString((new Candy())->getName());

        self::assertInstanceOf(ClosedState::class, $this->candyMachine->getState());
        $coin = new Coin(200);
        $this->candyMachine->insertCoin($coin);
        self::assertInstanceOf(OpenState::class, $this->candyMachine->getState());

        $this->candyMachine->turnKnob();
        self::assertInstanceOf(ClosedState::class, $this->candyMachine->getState());

        self::assertEquals(1, $this->candyMachine->getStore()->getCoinStash());
    }

    /**
     * Tests if the application recognizes invalid coin nomination
     */
    public function testInvalidCoinNomination()
    {
        $coin = new Coin(3);

        $exceptionMessage = (new InvalidCoinNominationException())->getMessage();
        $message = $coin->getNomination() . PHP_EOL . $exceptionMessage;

        $this->expectOutputString($message);

        $this->candyMachine->insertCoin($coin);
    }

    /**
     * Tests if the application recognizes not accepted nomination
     */
    public function testNotAcceptedNomination()
    {
        $coin = new Coin(500);

        $exceptionMessage = (new NotAcceptedNominationException())->getMessage();
        $message = $coin->getNomination() . PHP_EOL . $exceptionMessage;

        $this->expectOutputString($message);

        $this->candyMachine->insertCoin($coin);
    }

    /**
     * Tests if the application behaves properly when turning the knob without inserted coin.
     */
    public function testNoCoin()
    {
        $this->expectOutputString((new NoCoinException())->getMessage());

        $this->candyMachine->turnKnob();
    }

    /**
     * Tests if the application behaves properly when it runs out of candies.
     */
    public function testNoCandies()
    {
        $coin = new Coin(200);

        $exceptionMessage = (new SoldOutException())->getMessage();
        $message = $coin->getNomination() . PHP_EOL . $exceptionMessage;

        $this->expectOutputString($message);

        $this->candyMachine = new CandyMachine(0);
        $this->candyMachine->insertCoin($coin);
    }

    /**
     * Tests if the application behaves properly when a coin is already inserted
     */
    public function testCoinInventoryFull()
    {
        $coin = new Coin(200);

        $exceptionMessage = (new CoinInventoryFullException())->getMessage();
        $message = $coin->getNomination() . PHP_EOL . $exceptionMessage;

        $this->expectOutputString($message);

        $this->candyMachine->insertCoin($coin);
        $this->candyMachine->insertCoin($coin);
    }

    /**
     * Tests if the application behaves properly while resetting
     */
    public function testCandyMachineReset()
    {
        $coin = new Coin(200);

        $this->expectOutputString($coin->getNomination() . PHP_EOL);

        $this->candyMachine->insertCoin($coin);
        $this->candyMachine->reset();

        self::assertNull($this->candyMachine->getStore()->getCoinInventory());
        self::assertInstanceOf(ClosedState::class, $this->candyMachine->getState());

        $this->candyMachine->reset();
        self::assertNull($this->candyMachine->getStore()->getCoinInventory());
        self::assertInstanceOf(ClosedState::class, $this->candyMachine->getState());
    }

    /**
     * Tests if adding candies by the repairman works properly
     */
    public function testAddCandies()
    {
        $this->candyMachine = new CandyMachine(0);
        $this->candyMachine->getStore()->addCandies(5);
        self::assertEquals(5, $this->candyMachine->getStore()->getRemainingCandies());
    }
}
