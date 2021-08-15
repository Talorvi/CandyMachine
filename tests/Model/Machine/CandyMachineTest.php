<?php

namespace Tests\Model\Machine;

use App\Exception\Coin\InvalidCoinNominationException;
use App\Exception\Coin\NotAcceptedNominationException;
use App\Exception\Machine\CoinInventoryFullException;
use App\Exception\Machine\NoCoinException;
use App\Exception\Machine\SoldOutException;
use App\Model\Coin;
use App\Model\Item\Candy;
use App\Model\Machine\CandyMachine;
use App\Model\State\ClosedState;
use App\Model\State\OpenState;
use PHPUnit\Framework\TestCase;

class CandyMachineTest extends TestCase
{
    private CandyMachine $candyMachine;

    public function setUp(): void
    {
        $this->candyMachine = new CandyMachine(10);
    }

    public function testValidScenario()
    {
        $this->expectOutputString((new Candy())->getName());

        self::assertInstanceOf(ClosedState::class, $this->candyMachine->getState());
        $coin = new Coin(200);
        $this->candyMachine->insertCoin($coin);
        self::assertInstanceOf(OpenState::class, $this->candyMachine->getState());

        $this->candyMachine->turnKnob();
        self::assertInstanceOf(ClosedState::class, $this->candyMachine->getState());

        self::assertEquals(1, $this->candyMachine->getCoinStash());
    }

    public function testInvalidCoinNomination()
    {
        $this->expectOutputString((new InvalidCoinNominationException())->getMessage());

        $coin = new Coin(3);
        $this->candyMachine->insertCoin($coin);
    }

    public function testNotAcceptedNomination()
    {
        $this->expectOutputString((new NotAcceptedNominationException())->getMessage());

        $coin = new Coin(500);
        $this->candyMachine->insertCoin($coin);
    }

    public function testNoCoin()
    {
        $this->expectOutputString((new NoCoinException())->getMessage());

        $this->candyMachine->turnKnob();
    }

    public function testNoCandies()
    {
        $this->expectOutputString((new SoldOutException())->getMessage());

        $this->candyMachine = new CandyMachine(0);
        $coin = new Coin(200);
        $this->candyMachine->insertCoin($coin);
    }

    public function testCoinInventoryFull()
    {
        $coin = new Coin(200);

        $exceptionMessage = (new CoinInventoryFullException())->getMessage();
        $message = $coin->getNomination().PHP_EOL.$exceptionMessage;

        $this->expectOutputString($message);

        $this->candyMachine->insertCoin($coin);
        $this->candyMachine->insertCoin($coin);
    }

    public function testCandyMachineReset()
    {
        $coin = new Coin(200);

        $this->expectOutputString($coin->getNomination().PHP_EOL);

        $this->candyMachine->insertCoin($coin);
        $this->candyMachine->reset();

        self::assertNull($this->candyMachine->getCoinInventory());
        self::assertInstanceOf(ClosedState::class, $this->candyMachine->getState());

        $this->candyMachine->reset();
        self::assertNull($this->candyMachine->getCoinInventory());
        self::assertInstanceOf(ClosedState::class, $this->candyMachine->getState());
    }

    public function testAddCandies()
    {
        $this->candyMachine = new CandyMachine(0);
        $this->candyMachine->addCandies(5);
        self::assertEquals(5, $this->candyMachine->getRemainingCandies());
    }
}
