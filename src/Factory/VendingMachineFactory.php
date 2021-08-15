<?php

declare(strict_types=1);

namespace App\Factory;


use App\Model\Machine\CandyMachine;

class VendingMachineFactory
{
    public static function createCandyMachine(int $remainingCandies = 0): CandyMachine
    {
        return new CandyMachine($remainingCandies);
    }

}