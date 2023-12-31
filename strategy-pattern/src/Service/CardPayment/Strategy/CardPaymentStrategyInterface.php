<?php

declare(strict_types=1);

namespace App\Service\CardPayment\Strategy;

use App\Dto\CardPaymentDto;
use App\Dto\CardPaymentResponseDto;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(CardPaymentStrategyInterface::class)]
interface CardPaymentStrategyInterface
{
    public function isPaymentProviderSupported(string $paymentProvider);

    public function handlePayment(CardPaymentDto $payment): CardPaymentResponseDto;
}
