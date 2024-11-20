<?php

declare(strict_types=1);

namespace App\Message;

abstract class AbstractMessage
{
    abstract public function getMessages(): array;
}