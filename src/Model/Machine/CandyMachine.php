<?php

declare(strict_types=1);

namespace App\Model\Machine;


use App\Exception\Machine\CoinInventoryFullException;
use App\Interfaces\State;
use App\Interfaces\VendingMachine;
use App\Model\Coin;
use App\Model\State\Candy\ClosedState;
use App\Model\State\Candy\OpenState;
use App\Model\Store\CandyMachineStore;
use Throwable;

/**
 * Class CandyMachine
 * @package App\Model\Machine
 */
class CandyMachine implements VendingMachine
{
    /**
     * Coin is in the inventory
     *
     * @var OpenState
     */
    private OpenState $openState;

    /**
     * There is no coin in the inventory
     *
     * @var ClosedState
     */
    private ClosedState $closedState;

    /**
     * Current state of the machine
     *
     * @var State
     */
    private State $state;

    /**
     * Store of the machine. It stores its' remaining candies, stored money and coin inventory
     *
     * @var CandyMachineStore
     */
    private CandyMachineStore $store;

    /**
     * CandyMachine constructor.
     * @param int $remainingCandies
     */
    public function __construct(int $remainingCandies = 0)
    {
        $this->openState = new OpenState($this);
        $this->closedState = new ClosedState($this);
        $this->store = new CandyMachineStore($remainingCandies);

        $this->state = $this->closedState;
    }

    /**
     * Inserting coin can change the state of the machine from OPEN to CLOSED
     *
     * @param Coin $coin
     */
    public function insertCoin(Coin $coin): void
    {
        try {
            $this->state->insertCoin($coin);
        } catch (CoinInventoryFullException $exception) {
            echo $exception->getMessage();
        } catch (Throwable $exception) {
            $this->store->dispenseCoin($coin);
            echo $exception->getMessage();
        }
    }

    /**
     * Turning the knob can dispense a candy, when a proper coin is in the machines' inventory
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

    /**
     * When a coin is in the machines' inventory, it's possible to retrieve the coin, resetting the machines' state
     */
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
     * @return CandyMachineStore
     */
    public function getStore(): CandyMachineStore
    {
        return $this->store;
    }
}