<?php

declare(strict_types=1);

namespace App\Contract;

class BaseCurrencyContract
{
    public float $buy = 0;
    public float $sell = 0;
    public ?string $currency = null;
}