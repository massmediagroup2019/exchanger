<?php

namespace App\DTO;

/**
 * Class RateDTO
 * @package App\DTO
 */
class RateDTO
{
    /**
     * @var string
     */
    private $currency;

    /**
     * @var float
     */
    private $rate;

    /**
     * RatePDO constructor.
     * @param string $currency
     * @param float $rate
     */
    public function __construct(string $currency, float $rate)
    {
        $this->currency = $currency;
        $this->rate = round($rate, 2);
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }
}
