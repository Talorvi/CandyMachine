<?php

declare(strict_types=1);


namespace App\Validator;


use App\Exception\Machine\SoldOutException;
use App\Model\Machine\CandyMachine;

/**
 * Class CandyMachineValidator
 * @package App\Validator
 */
class CandyMachineValidator
{
    /**
     * Checks if a candy can be dispensed by the machine.
     *
     * @param CandyMachine $candyMachine
     * @return bool
     * @throws SoldOutException
     */
    public static function validateCanDispenseCandy(CandyMachine $candyMachine): bool
    {
        if ($candyMachine->getStore()->getRemainingCandies() > 0) {
            return true;
        }
        throw new SoldOutException();
    }
}