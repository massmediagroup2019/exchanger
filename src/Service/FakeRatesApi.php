<?php

namespace App\Service;

use App\DTO\RateDTO;

/**
 * Class FakeRatesApi
 * @package App\Service
 */
class FakeRatesApi implements ExchangeAPIInterface
{
    /**
     * @param string $defaultCurrency
     * @return RateDTO[]
     */
    public function getRates(string $defaultCurrency): array
    {
        return [
            new RateDTO('BGN', 1.5),
            new RateDTO('NZD', 1.6),
            new RateDTO('USD', 1.7),
        ];
    }
}
