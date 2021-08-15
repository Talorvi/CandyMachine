<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\Coin\InvalidCoinNominationException;
use App\Exception\Coin\NotAcceptedNominationException;
use App\Model\Coin;
use Throwable;

/**
 * Class CoinValidator
 * @package Validator
 */
class CoinValidator
{
    /**
     * Array of existing nominations in Poland in gross
     *
     * @var array
     */
    private array $existingNominations = [1, 2, 5, 10, 20, 50, 100, 200, 500];

    /**
     * Array of accepted nominations in the machine
     *
     * @var array
     */
    private array $acceptedNominations = [200];

    /**
     * @return array
     */
    public function getExistingNominations(): array
    {
        return $this->existingNominations;
    }

    /**
     * Existing nominations have to be integers
     *
     * @param array $existingNominations
     */
    public function setExistingNominations(array $existingNominations): void
    {
        try {
            IntArrayValidator::validate($existingNominations);
            $this->existingNominations = $existingNominations;
        }
        catch (Throwable $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @return array
     */
    public function getAcceptedNominations(): array
    {
        return $this->acceptedNominations;
    }

    /**
     * Accepted nominations have to be integers
     *
     * @param array $acceptedNominations
     */
    public function setAcceptedNominations(array $acceptedNominations): void
    {
        try {
            IntArrayValidator::validate($acceptedNominations);
            $this->acceptedNominations = $acceptedNominations;
        }
        catch (Throwable $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Checks if the coin exists and nomination is supported by the machine
     *
     * @param $nomination
     * @return Coin
     * @throws InvalidCoinNominationException
     * @throws NotAcceptedNominationException
     */
    public function validate($nomination): Coin
    {
        if (!in_array($nomination, $this->existingNominations))
            throw new InvalidCoinNominationException();
        if (!in_array($nomination, $this->acceptedNominations))
            throw new NotAcceptedNominationException();
        return new Coin($nomination);
    }
}