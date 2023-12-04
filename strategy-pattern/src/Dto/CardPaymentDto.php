<?php

declare(strict_types=1);

namespace App\Dto;

class CardPaymentDto
{
    public function __construct(
        private readonly string $amount,
        private readonly string $currency,
        private readonly string $provider,
    ) {
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }
}
