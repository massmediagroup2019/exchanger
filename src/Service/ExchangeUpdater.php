<?php

namespace App\Service;

use App\Entity\Rate;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ExchangeUpdater
 * @package App\Service
 */
class ExchangeUpdater
{
    /**
     * @var string
     */
    private $defaultCurrency;

    /**
     * @var ExchangeAPIInterface
     */
    private $exchangeAPI;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ExchangeUpdater constructor.
     * @param ExchangeAPIInterface $exchangeAPI
     * @param EntityManagerInterface $entityManager
     * @param string $defaultCurrency
     */
    public function __construct(
        ExchangeAPIInterface $exchangeAPI,
        EntityManagerInterface $entityManager,
        string $defaultCurrency
    ) {
        $this->exchangeAPI = $exchangeAPI;
        $this->entityManager = $entityManager;
        $this->defaultCurrency = $defaultCurrency;
    }

    /**
     * @return int
     */
    public function update(): int
    {
        $ratesData = $this->exchangeAPI->getRates($this->defaultCurrency);
        $date = new \DateTime();

        $rates = $this->entityManager->getRepository(Rate::class)->findAll();
        $mappedRates = array_combine(
            array_map(
                function (Rate $rate) {
                    return $rate->getCurrency();
                },
                $rates
            ),
            $rates
        );

        foreach ($ratesData as $rateData) {
            $rate = $mappedRates[$rateData->getCurrency()] ?? new Rate();

            $rate->setCurrency($rateData->getCurrency());
            if ($rateData->getRate() !== $rate->getRate()) {
                $rate->setRate($rateData->getRate());
            }
            $rate->setUpdatedAt($date);

            $this->entityManager->persist($rate);
        }

        $this->entityManager->flush();

        return count($ratesData);
    }
}
