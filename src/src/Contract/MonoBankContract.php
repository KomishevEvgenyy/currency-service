<?php

declare(strict_types=1);

namespace App\Contract;

use App\Enum\CurrencyCodeEnum;

class MonoBankContract extends AbstractContract
{
    /**
     * @return array
     */
    public function getDetails(): array
    {
        $contracts = [];

        foreach ($this->response as $currencyData) {
            if ($this->checkCurrencyCode($currencyData)) {
                $contract = new BaseCurrencyContract();
                $contract->buy = $currencyData['rateBuy'] ? (float)$currencyData['rateBuy'] : 0;
                $contract->sell = $currencyData['rateSell'] ? (float)$currencyData['rateSell'] : 0;
                $contract->currency = CurrencyCodeEnum::tryFrom($currencyData['currencyCodeA'])?->name;

                $contracts[] = $contract;
            }
        }

        return $contracts;
    }

    /**
     * @param mixed $currencyData
     * @return bool
     */
    private function checkCurrencyCode(mixed $currencyData): bool
    {
        if ($currencyData['currencyCodeB'] === CurrencyCodeEnum::USD->value || $currencyData['currencyCodeB'] === CurrencyCodeEnum::EUR->value) {
            return false;
        }

        return match ($currencyData['currencyCodeA']) {
            CurrencyCodeEnum::USD->value, CurrencyCodeEnum::EUR->value => true,
            default => false
        };
    }
}