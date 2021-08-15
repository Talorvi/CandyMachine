<?php

declare(strict_types=1);

namespace App\Interfaces;


use App\Model\Coin;

interface State
{
    public function insertCoin(Coin $coin): void;
    public function turnKnob(): void;
    public function dispense(): void;
    public function reset(): void;
}