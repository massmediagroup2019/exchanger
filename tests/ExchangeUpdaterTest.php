<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ExchangeUpdaterTest extends KernelTestCase
{
    /**
     * @var ExchangeUpdater
     */
    private $exchangeUpdater;

    public function setUp()
    {
        $this->exchangeUpdater = self::bootKernel()->getContainer()->get(ExchangeUpdater::class);
    }

    public function testUpdate()
    {
        $numberOfRates = $this->exchangeUpdater->update();

        $this->assertGreaterThan(0, $numberOfRates);
    }
}
