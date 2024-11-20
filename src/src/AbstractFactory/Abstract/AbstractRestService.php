<?php

declare(strict_types=1);

namespace App\AbstractFactory\Abstract;

use App\AbstractFactory\Interface\CurrencyServiceInterface;
use App\Trait\LoggerTrait;
use Psr\Log\LoggerAwareInterface;

abstract class AbstractRestService implements CurrencyServiceInterface, LoggerAwareInterface
{
    use LoggerTrait;

    public const FIAT_MONEY = 5;
    public const VIRTUAL_MONEY = 11;

    abstract public function getRates(bool $fiatType = true): array;
}