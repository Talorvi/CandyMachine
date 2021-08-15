<?php

declare(strict_types=1);

namespace App\Model;


class Coin
{
    /**
     * @var int
     */
    private int $nomination;

    /**
     * @param $nomination
     */
    public function __construct($nomination)
    {
        $this->nomination = $nomination;
    }

    /**
     * @return int
     */
    public function getNomination(): int
    {
        return $this->nomination;
    }
}