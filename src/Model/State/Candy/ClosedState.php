<?php

declare(strict_types=1);

namespace App\Model\State\Candy;


use App\Exception\Coin\InvalidCoinNominationException;
use App\Exception\Coin\NotAcceptedNominationException;
use App\Exception\Machine\NoCoinException;
use App\Exception\Machine\SoldOutException;
use App\Interfaces\State;
use App\Model\Coin;
use App\Model\Machine\CandyMachine;
use App\Validator\CandyMachineValidator;
use App\Validator\CoinValidator;

/**
 * When the machine is in the closed state, it will not dispense any candies.
 *
 * Class ClosedState
 * @package App\Model\State
 */
class ClosedState implements State
{
    /**
     * @var CandyMachine
     */
    private CandyMachine $candyMachine;
    /**
     * @var CoinValidator
     */
    private CoinValidator $coinValidator;

    /**
     * ClosedState constructor.
     * @param CandyMachine $candyMachine
     */
    public function __construct(CandyMachine $candyMachine)
    {
        $this->candyMachine = $candyMachine;
        $this->coinValidator = new CoinValidator();
    }

    /**
     * Inserting coin in closed state:
     * - when the coin is invalid, it dispenses it
     * - when the coin is valid, the machine state changes to OPEN
     *
     * @param Coin $coin
     * @throws InvalidCoinNominationException
     * @throws NotAcceptedNominationException
     * @throws SoldOutException
     */
    public function insertCoin(Coin $coin): void
    {
        $this->coinValidator->validate($coin->getNomination());
        CandyMachineValidator::validateCanDispenseCandy($this->candyMachine);

        $this->candyMachine->getStore()->setCoinInventory($coin);
        $this->candyMachine->setState($this->candyMachine->getOpenState());
    }

    /**
     * When turning the knob of the machine, the machine will tell that there should be a coin inserted.
     *
     * @throws NoCoinException
     */
    public function turnKnob(): void
    {
        throw new NoCoinException();
    }

    /**
     * In closed state, no candy can be dispensed.
     */
    public function dispense(): void
    {
        /**
         * Do nothing
         */
    }

    /**
     * In closed state the reset method does nothing.
     */
    public function reset(): void
    {
        /**
         * Do nothing
         */
    }
}