<?php

declare(strict_types=1);

namespace App\AbstractFactory\Abstract;

use App\AbstractFactory\Interface\AbstractFactoryInterface;
use App\AbstractFactory\Interface\CurrencyServiceInterface;
use App\Contract\AbstractContract;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractFactory implements AbstractFactoryInterface
{
    protected string $host;
    protected HttpClientInterface $httpClient;

    public function __construct(string $host, HttpClientInterface $httpClient)
    {
        $this->host = $host;
        $this->httpClient = $httpClient;
    }

    abstract public function createCurrencyService(): CurrencyServiceInterface;

    abstract public function makeContractResponse(array $response): AbstractContract;
}