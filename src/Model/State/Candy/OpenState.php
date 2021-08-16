<?php

declare(strict_types=1);

namespace App\Model\State\Candy;


use App\Exception\Machine\CoinInventoryFullException;
use App\Interfaces\State;
use App\Model\Coin;
use App\Model\Machine\CandyMachine;

/**
 * When the machine is in open state, it can dispense a candy, or it can be reset to dispense to retrieve a coin.
 *
 * Class OpenState
 * @package App\Model\State
 */
class OpenState implements State
{
    /**
     * @var CandyMachine
     */
    public CandyMachine $candyMachine;

    /**
     * OpenState constructor.
     * @param CandyMachine $candyMachine
     */
    public function __construct(CandyMachine $candyMachine)
    {
        $this->candyMachine = $candyMachine;
    }

    /**
     * When in open state, no other coin can be inserted to the machine. The machine dispenses any coins put to it.
     *
     * @param Coin $coin
     * @throws CoinInventoryFullException
     */
    public function insertCoin(Coin $coin): void
    {
        $this->candyMachine->getStore()->dispenseCoin($coin);
        throw new CoinInventoryFullException();
    }

    /**
     * Turning knob in open state dispenses a candy. It also remembers how many coins are stored inside of it.
     */
    public function turnKnob(): void
    {
        $this->candyMachine->getStore()->incrementCoinStash();
        $this->dispense();
    }

    /**
     * While dispensing a candy, the machine changes its state back to closed state.
     */
    public function dispense(): void
    {
        $this->candyMachine->getStore()->dispenseCandy();
        $this->candyMachine->setState($this->candyMachine->getClosedState());
    }

    /**
     *  Resetting the machine in open state dispenses the coin and changes state back to closed state.
     */
    public function reset(): void
    {
        $this->candyMachine->getStore()->dispenseCoin($this->candyMachine->getStore()->getCoinInventory());
        $this->candyMachine->getStore()->setCoinInventory(null);
        $this->candyMachine->setState($this->candyMachine->getClosedState());
    }
}