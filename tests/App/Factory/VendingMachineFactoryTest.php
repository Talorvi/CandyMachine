<?php

namespace Tests\App\Factory;

use App\Factory\VendingMachineFactory;
use App\Model\Machine\CandyMachine;
use PHPUnit\Framework\TestCase;

/**
 * Class VendingMachineFactoryTest
 * @package Tests\Factory
 */
class VendingMachineFactoryTest extends TestCase
{
    /**
     * Test if a new instance is created
     */
    public function testCreateCandyMachine()
    {
        $candyMachine = VendingMachineFactory::createCandyMachine();
        self::assertInstanceOf(CandyMachine::class, $candyMachine);
    }
}
