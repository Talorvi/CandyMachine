<?php

declare(strict_types=1);

namespace App\Model\Machine;


use App\Interfaces\State;
use App\Interfaces\VendingMachine;
use App\Model\Coin;
use App\Model\Item\Candy;
use App\Model\State\ClosedState;
use App\Model\State\OpenState;
use Throwable;

class CandyMachine implements VendingMachine
{
    private OpenState $openState;
    private ClosedState $closedState;
    private State $state;

    /**
     * Number of coins stored in the machine
     *
     * @var int
     */
    private int $coinStash = 0;

    /**
     * Current inventory of the machine.
     *
     * @var Coin|null
     */
    private ?Coin $coinInventory = null;

    /**
     * @var int
     */
    private int $remainingCandies = 0;

    public function __construct(int $remainingCandies = 0)
    {
        $this->openState = new OpenState($this);
        $this->closedState = new ClosedState($this);

        $this->state = $this->closedState;

        $this->remainingCandies = $remainingCandies;
    }

    /**
     *
     */
    public function insertCoin(Coin $coin): void
    {
        try {
            $this->state->insertCoin($coin);
        } catch (Throwable $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     *
     */
    public function turnKnob(): void
    {
        try {
            $this->state->turnKnob();
            $this->state->dispense();
        } catch (Throwable $exception) {
            echo $exception->getMessage();
        }
    }

    public function reset(): void
    {
        $this->state->reset();
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @param State $state
     */
    public function setState(State $state): void
    {
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getCoinStash(): int
    {
        return $this->coinStash;
    }

    /**
     * Increments the coin stash
     */
    public function incrementCoinStash(): void
    {
        $this->coinStash++;
    }

    /**
     * @return OpenState
     */
    public function getOpenState(): OpenState
    {
        return $this->openState;
    }

    /**
     * @return ClosedState
     */
    public function getClosedState(): ClosedState
    {
        return $this->closedState;
    }

    /**
     * @return int
     */
    public function getRemainingCandies(): int
    {
        return $this->remainingCandies;
    }

    /**
     * @param int $candyAmount
     */
    public function addCandies(int $candyAmount): void
    {
        $this->remainingCandies += $candyAmount;
    }

    /**
     * @return Coin|null
     */
    public function getCoinInventory(): ?Coin
    {
        return $this->coinInventory;
    }

    /**
     * @param Coin|null $coin
     */
    public function setCoinInventory(?Coin $coin): void
    {
        $this->coinInventory = $coin;
    }

    /**
     * @param Coin $coin
     * @return Coin
     */
    public function dispenseCoin(Coin $coin): Coin
    {
        echo $coin->getNomination().PHP_EOL;
        return $coin;
    }

    /**
     * @return Candy
     */
    public function dispenseCandy(): Candy
    {
        $candy = new Candy();
        $this->remainingCandies--;
        echo $candy->getName();

        return $candy;
    }
}