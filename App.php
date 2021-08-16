<?php

declare(strict_types=1);


namespace Talorvi\CandyMachine;

require __DIR__ . '/vendor/autoload.php';

use App\Factory\VendingMachineFactory;
use App\Model\Coin;
use App\Model\Machine\CandyMachine;

/**
 * Class App
 * @package Talorvi\CandyMachine
 */
class App
{
    /**
     * @var CandyMachine
     */
    private CandyMachine $candyMachine;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->candyMachine = VendingMachineFactory::createCandyMachine(1);
    }

    /**
     * Insert coin (2PLN) and retrieve a candy
     */
    public function exampleUsageGetCandy()
    {
        echo '--------------------------' . PHP_EOL;
        echo 'Retrieving candy example: ' . PHP_EOL;
        $coin = new Coin(200);

        echo 'Inserting coin (2PLN).' . PHP_EOL;
        $this->candyMachine->insertCoin($coin);

        echo 'Turning the knob to retrieve a candy. Retreived item: ';
        $this->candyMachine->turnKnob();
        echo PHP_EOL;
    }

    /**
     * If the machine is empty, the machine dispenses inserted candy
     */
    public function exampleUsageNoCandy()
    {
        echo '--------------------------' . PHP_EOL;
        echo 'No coin example:' . PHP_EOL;
        $coin = new Coin(200);

        echo 'Inserting coin (2PLN).' . PHP_EOL;
        $this->candyMachine->insertCoin($coin);
        echo PHP_EOL;
    }

    /**
     * When inserting a wrong coin, the machine dispenses it
     */
    public function exampleUsageNotAcceptedCoinNomination()
    {
        echo '--------------------------' . PHP_EOL;
        echo 'Not accepted coin nomination example:' . PHP_EOL;
        $coin = new Coin(100);

        echo 'Inserting coin (1PLN)' . PHP_EOL;
        $this->candyMachine->insertCoin($coin);
        echo PHP_EOL;
    }

    /**
     * Technician can refill the machine
     */
    public function exampleTechnicianAddsCandies()
    {
        echo '--------------------------' . PHP_EOL;
        echo 'Technician adds candies:' . PHP_EOL;
        echo 'Remaining candies: ' . $this->candyMachine->getStore()->getRemainingCandies() . PHP_EOL;
        echo 'Inserting 5 candies...' . PHP_EOL;
        $this->candyMachine->getStore()->addCandies(5);
        echo 'Remaining candies after filling the machine: ' . $this->candyMachine->getStore()->getRemainingCandies(
            ) . PHP_EOL;
        echo PHP_EOL;
    }
}

$app = new App();
$app->exampleUsageGetCandy();
$app->exampleUsageNoCandy();
$app->exampleUsageNotAcceptedCoinNomination();
$app->exampleTechnicianAddsCandies();
