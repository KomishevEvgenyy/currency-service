<?php

declare(strict_types=1);

namespace App\Message;

class CurrencyNotificationMessage extends AbstractMessage
{
    public function __construct(private readonly array $messages)
    {
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}