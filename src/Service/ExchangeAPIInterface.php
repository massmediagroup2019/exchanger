<?php

namespace App\Service;

use App\DTO\RateDTO;

/**
 * Interface ExchangeAPIInterface
 * @package App\Service
 */
interface ExchangeAPIInterface
{
    /**
     * @param string $defaultCurrency
     * @return RateDTO[]
     */
    public function getRates(string $defaultCurrency): array;
}
