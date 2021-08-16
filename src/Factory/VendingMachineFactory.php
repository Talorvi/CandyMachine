<?php

declare(strict_types=1);

namespace App\Factory;


use App\Model\Machine\CandyMachine;

/**
 * Class VendingMachineFactory
 * @package App\Factory
 */
class VendingMachineFactory
{
    /**
     * @param int $remainingCandies
     * @return CandyMachine
     */
    public static function createCandyMachine(int $remainingCandies = 0): CandyMachine
    {
        return new CandyMachine($remainingCandies);
    }

}