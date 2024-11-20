<?php

declare(strict_types=1);

namespace App\AbstractFactory;

use App\AbstractFactory\Abstract\AbstractRestService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PrivatBankService extends AbstractRestService
{
    public const BANK_NAME = 'PrivatBank';

    public function __construct(
        private readonly string              $host,
        private readonly HttpClientInterface $httpClient
    )
    {
    }

    /**
     * @param bool $fiatType
     * @return array
     */
    public function getRates(bool $fiatType = true): array
    {
        $prefix = $fiatType ? (string)self::FIAT_MONEY : (string)self::VIRTUAL_MONEY;
        $url = $this->host . $prefix;

        try {
            $response = $this->httpClient->request(self::REQUEST_TYPE, $url, []);
            if ($response->getStatusCode() === Response::HTTP_OK) {
                return $response->toArray();
            }
            $this->warning('Bad request from {url}. Status code {status_code}. Response {response}',
                [
                    'url' => $url,
                    'status_code' => $response->getStatusCode(),
                    'response' => json_encode($response->getContent(false), JSON_THROW_ON_ERROR)
                ]);
        } catch (\Throwable $e) {
            $this->error('Fail request from {url}. {message}',
                [
                    'url' => $url,
                    'message' => $e->getMessage()
                ]);
        }

        return [];
    }
}