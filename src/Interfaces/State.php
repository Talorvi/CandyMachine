<?php

declare(strict_types=1);

namespace App\Interfaces;


use App\Model\Coin;

/**
 * Interface State
 * @package App\Interfaces
 */
interface State
{
    /**
     * @param Coin $coin
     */
    public function insertCoin(Coin $coin): void;

    public function turnKnob(): void;

    public function dispense(): void;

    public function reset(): void;
}