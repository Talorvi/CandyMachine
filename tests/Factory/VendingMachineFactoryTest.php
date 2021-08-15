<?php

namespace Tests\Factory;

use App\Factory\VendingMachineFactory;
use App\Model\Machine\CandyMachine;
use PHPUnit\Framework\TestCase;

class VendingMachineFactoryTest extends TestCase
{

    public function testCreateCandyMachine()
    {
        $candyMachine = VendingMachineFactory::createCandyMachine();
        self::assertInstanceOf(CandyMachine::class, $candyMachine);
    }
}
