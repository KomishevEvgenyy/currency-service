<?php

declare(strict_types=1);

namespace App\Contract;

abstract class AbstractContract
{
    protected array $response = [];
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    abstract public function getDetails(): array;

}