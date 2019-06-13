<?php

namespace App\Service;

use App\DTO\RateDTO;

/**
 * Class ExchangeRatesApi
 * @package App\Service
 */
class ExchangeRatesApi implements ExchangeAPIInterface
{
    private const API_URL = 'https://api.exchangeratesapi.io/latest?base=%s';

    /**
     * @param string $defaultCurrency
     * @return RateDTO[]
     */
    public function getRates(string $defaultCurrency): array
    {
        $response = file_get_contents(sprintf(self::API_URL, $defaultCurrency));
        $data = json_decode($response, true);

        return array_map(function (string $currency, float $rate) {
            return new RateDTO($currency, $rate);
        }, array_keys($data['rates']), $data['rates']);
    }
}
