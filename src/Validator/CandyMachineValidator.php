<?php

declare(strict_types=1);


namespace App\Validator;


use App\Exception\Machine\SoldOutException;
use App\Model\Machine\CandyMachine;

class CandyMachineValidator
{
    /**
     * @param CandyMachine $candyMachine
     * @return bool
     * @throws SoldOutException
     */
    public static function validateCanDispenseCandy(CandyMachine $candyMachine): bool
    {
        if ($candyMachine->getRemainingCandies() > 0)
            return true;
        throw new SoldOutException();
    }
}