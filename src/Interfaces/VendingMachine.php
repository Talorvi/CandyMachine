<?php

declare(strict_types=1);

namespace App\Interfaces;


use App\Model\Coin;

/**
 * Interface VendingMachine
 * @package App\Interfaces
 */
interface VendingMachine
{
    /**
     * @param Coin $coin
     */
    public function insertCoin(Coin $coin): void;

    public function turnKnob(): void;

    public function reset(): void;
}