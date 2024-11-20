<?php

declare(strict_types=1);

namespace App\Trait;

use Psr\Log\LoggerAwareTrait;

trait LoggerTrait
{
    use LoggerAwareTrait;

    protected function info(string|\Stringable $message, array $context = []): void
    {
        $context['class'] = static::class;

        $this->logger?->info($message, $context);
    }

    protected function warning(string|\Stringable $message, array $context = []): void
    {
        $context['class'] = static::class;

        $this->logger?->warning($message, $context);
    }

    protected function error(string|\Stringable $message, array $context = []): void
    {
        $context['class'] = static::class;

        $this->logger?->error($message, $context);
    }

    protected function debug(string|\Stringable $message, array $context = []): void
    {
        $context['class'] = static::class;

        $this->logger?->debug($message, $context);
    }
}