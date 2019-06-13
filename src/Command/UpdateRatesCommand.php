<?php

namespace App\Command;

use App\Service\ExchangeUpdater;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class UpdateRatesCommand
 * @package App\Command
 */
class UpdateRatesCommand extends Command
{
    protected static $defaultName = 'app:update-rates';

    /**
     * @var ExchangeUpdater
     */
    private $exchangeUpdater;

    /**
     * UpdateRatesCommand constructor.
     * @param ExchangeUpdater $exchangeUpdater
     */
    public function __construct(ExchangeUpdater $exchangeUpdater)
    {
        parent::__construct();

        $this->exchangeUpdater = $exchangeUpdater;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->exchangeUpdater->update();
    }
}
