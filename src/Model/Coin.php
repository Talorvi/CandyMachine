<?php

declare(strict_types=1);

namespace App\Model;

/**
 * The nomination is told in gross (2PLN = 200 gross)
 *
 * Class Coin
 * @package App\Model
 */
class Coin
{
    /**
     * @var int
     */
    private int $nomination;

    /**
     * @param int $nomination
     */
    public function __construct(int $nomination)
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