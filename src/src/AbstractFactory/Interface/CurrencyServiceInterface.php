<?php

declare(strict_types=1);

namespace App\AbstractFactory\Interface;

interface CurrencyServiceInterface
{
    public const REQUEST_TYPE = 'GET';

    public function getRates(bool $fiatType = true): array;
}