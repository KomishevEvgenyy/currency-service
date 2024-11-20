<?php

declare(strict_types=1);

namespace App\Contract;

class PrivatBankContract extends AbstractContract
{
    public function getDetails(): array
    {
        $contracts = [];
        foreach ($this->response as $currencyData) {
            $contract = new BaseCurrencyContract();
            $contract->buy = $currencyData['buy'] ? (float)$currencyData['buy'] : 0;
            $contract->sell = $currencyData['sale'] ? (float)$currencyData['sale'] : 0;
            $contract->currency = $currencyData['ccy'] ?? null;
            $contracts[] = $contract;
        }

        return $contracts;
    }
}