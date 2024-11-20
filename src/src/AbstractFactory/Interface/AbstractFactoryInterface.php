<?php

declare(strict_types=1);

namespace App\AbstractFactory\Interface;

use App\Contract\AbstractContract;

interface AbstractFactoryInterface
{
    public function createCurrencyService(): CurrencyServiceInterface;

    public function makeContractResponse(array $response): AbstractContract;
}