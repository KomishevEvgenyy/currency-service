<?php

declare(strict_types=1);

namespace App\AbstractFactory\Factory;

use App\AbstractFactory\Abstract\AbstractFactory;
use App\AbstractFactory\Interface\CurrencyServiceInterface;
use App\AbstractFactory\PrivatBankService;
use App\Contract\AbstractContract;
use App\Contract\PrivatBankContract;

class PrivatBankFactory extends AbstractFactory
{
    public function createCurrencyService(): CurrencyServiceInterface
    {
        return new PrivatBankService($this->host, $this->httpClient);
    }

    public function makeContractResponse(array $response): AbstractContract
    {
        return new PrivatBankContract($response);
    }
}