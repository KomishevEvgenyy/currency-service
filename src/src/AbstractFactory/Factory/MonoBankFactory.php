<?php

declare(strict_types=1);

namespace App\AbstractFactory\Factory;

use App\AbstractFactory\Abstract\AbstractFactory;
use App\AbstractFactory\Interface\CurrencyServiceInterface;
use App\AbstractFactory\MonoBankService;
use App\Contract\AbstractContract;
use App\Contract\MonoBankContract;

class MonoBankFactory extends AbstractFactory
{
    public function createCurrencyService(): CurrencyServiceInterface
    {
        return new MonoBankService($this->host, $this->httpClient);
    }

    public function makeContractResponse(array $response): AbstractContract
    {
        return new MonoBankContract($response);
    }
}