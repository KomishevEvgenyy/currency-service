<?php

declare(strict_types=1);

namespace App\Command;

use App\AbstractFactory\Interface\AbstractFactoryInterface;
use App\AbstractFactory\MonoBankService;
use App\AbstractFactory\PrivatBankService;
use App\Contract\BaseCurrencyContract;
use App\Message\CurrencyNotificationMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app.check_currency_fiat_money',
    description: 'Check currency into Bank system for fiat money'
)]
class CompareRatesCommand extends AbstractCommand
{
    public function __construct(
        private readonly AbstractFactoryInterface $monoBankFactory,
        private readonly AbstractFactoryInterface $privatBankFactory,
        private readonly MessageBusInterface      $bus
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app.check_currency_fiat_money')
            ->setDescription('Check currency into Bank system for fiat money')
            ->addArgument('threshold', InputArgument::REQUIRED)
            ->addArgument('fiat_type');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $threshold = (float)$input->getArgument('threshold');
        $fiatType = (bool)$input->getArgument('fiat_type');

        $messages = [];
        $io->info('Start check currency into bank');

        $monoBankService = $this->monoBankFactory->createCurrencyService();
        $monoBankRates = $monoBankService->getRates();
        $contractMonoBank = $this->monoBankFactory->makeContractResponse($monoBankRates);

        $this->prepareMessages($contractMonoBank->getDetails(), $threshold, $messages, MonoBankService::BANK_NAME);

        $privatBankService = $this->privatBankFactory->createCurrencyService();
        $privatBankRates = $privatBankService->getRates($fiatType);
        $contractPrivatBank = $this->privatBankFactory->makeContractResponse($privatBankRates);

        $this->prepareMessages($contractPrivatBank->getDetails(), $threshold, $messages, PrivatBankService::BANK_NAME);

        if (empty($messages)) {
            $io->info('Current currency into the banks more big the threshold: ' . $threshold);
            return self::SUCCESS;
        }
        $io->info('Send email for subscriptions');
        $this->bus->dispatch(new CurrencyNotificationMessage($messages));
        $io->info('Finished sending email for subscriptions');

        return self::SUCCESS;
    }

    /**
     * @param array $details
     * @param float $threshold
     * @param $messages
     * @param string $bankName
     * @return void
     */
    private function prepareMessages(array $details, float $threshold, &$messages, string $bankName): void
    {
        /** @var BaseCurrencyContract $detail */
        foreach ($details as $detail) {
            $text = '';
            if ($threshold > $detail->buy) {
                $text .= '. Buying sum up to ' . $detail->buy . '.';
            }

            if ($threshold > $detail->sell) {
                $text .= '. Selling sum up to ' . $detail->sell . '.';
            }

            if ($text !== '') {
                $messages[] = 'Changed currency in ' . $bankName . ' for ' . $detail->currency . $text;
            }
        }
    }
}