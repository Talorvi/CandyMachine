<?php

declare(strict_types=1);

namespace App\Model\State;


use App\Exception\Coin\InvalidCoinNominationException;
use App\Exception\Coin\NotAcceptedNominationException;
use App\Exception\Machine\NoCoinException;
use App\Exception\Machine\SoldOutException;
use App\Interfaces\State;
use App\Model\Coin;
use App\Model\Machine\CandyMachine;
use App\Validator\CandyMachineValidator;
use App\Validator\CoinValidator;

class ClosedState implements State
{
    private CandyMachine $candyMachine;
    private CoinValidator $coinValidator;

    public function __construct(CandyMachine $candyMachine)
    {
        $this->candyMachine = $candyMachine;
        $this->coinValidator = new CoinValidator();
    }

    /**
     * @param Coin $coin
     * @throws InvalidCoinNominationException
     * @throws NotAcceptedNominationException
     * @throws SoldOutException
     */
    public function insertCoin(Coin $coin): void
    {
        $this->coinValidator->validate($coin->getNomination());
        CandyMachineValidator::validateCanDispenseCandy($this->candyMachine);

        $this->candyMachine->setCoinInventory($coin);
        $this->candyMachine->setState($this->candyMachine->getOpenState());
    }

    /**
     * @throws NoCoinException
     */
    public function turnKnob(): void
    {
        throw new NoCoinException();
    }

    public function dispense(): void
    {
        /**
         * Do nothing
         */
    }

    public function reset(): void
    {
        /**
         * Do nothing
         */
    }
}