<?php

declare(strict_types=1);


namespace App\Model\Store;


use App\Model\Coin;
use App\Model\Item\Candy;

/**
 * Class CandyMachineStore
 * @package App\Model\Store
 */
class CandyMachineStore
{
    /**
     * Number of coins stored in the machine
     *
     * @var int
     */
    private int $coinStash = 0;

    /**
     * Current inventory of the machine.
     *
     * @var Coin|null
     */
    private ?Coin $coinInventory = null;

    /**
     * @var int
     */
    private int $remainingCandies;

    /**
     * CandyMachineStore constructor.
     * @param int $remainingCandies
     */
    public function __construct(int $remainingCandies = 0)
    {
        $this->remainingCandies = $remainingCandies;
    }

    /**
     * @return int
     */
    public function getCoinStash(): int
    {
        return $this->coinStash;
    }

    /**
     * Increments the coin stash
     */
    public function incrementCoinStash(): void
    {
        $this->coinStash++;
    }

    /**
     * @return int
     */
    public function getRemainingCandies(): int
    {
        return $this->remainingCandies;
    }

    /**
     * @param int $candyAmount
     */
    public function addCandies(int $candyAmount): void
    {
        $this->remainingCandies += $candyAmount;
    }

    /**
     * @return Coin|null
     */
    public function getCoinInventory(): ?Coin
    {
        return $this->coinInventory;
    }

    /**
     * @param Coin|null $coin
     */
    public function setCoinInventory(?Coin $coin): void
    {
        $this->coinInventory = $coin;
    }

    /**
     * @param Coin $coin
     * @return Coin
     */
    public function dispenseCoin(Coin $coin): Coin
    {
        echo $coin->getNomination() . PHP_EOL;
        return $coin;
    }

    /**
     * @return Candy
     */
    public function dispenseCandy(): Candy
    {
        $candy = new Candy();
        $this->remainingCandies--;
        echo $candy->getName();

        return $candy;
    }
}