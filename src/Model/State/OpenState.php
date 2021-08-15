<?php

declare(strict_types=1);

namespace App\Model\State;


use App\Exception\Machine\CoinInventoryFullException;
use App\Interfaces\State;
use App\Model\Coin;
use App\Model\Item\Candy;
use App\Model\Machine\CandyMachine;

class OpenState implements State
{
    public CandyMachine $candyMachine;

    public function __construct(CandyMachine $candyMachine)
    {
        $this->candyMachine = $candyMachine;
    }

    /**
     * @param Coin $coin
     * @throws CoinInventoryFullException
     */
    public function insertCoin(Coin $coin): void
    {
        $this->candyMachine->dispenseCoin($coin);
        throw new CoinInventoryFullException();
    }

    public function turnKnob(): void
    {
        $this->candyMachine->incrementCoinStash();
        $this->dispense();
    }

    public function dispense(): void
    {
        $this->candyMachine->dispenseCandy();
        $this->candyMachine->setState($this->candyMachine->getClosedState());
    }

    public function reset(): void
    {
        $coin = $this->candyMachine->dispenseCoin($this->candyMachine->getCoinInventory());
        $this->candyMachine->setCoinInventory(null);
        $this->candyMachine->setState($this->candyMachine->getClosedState());
    }
}