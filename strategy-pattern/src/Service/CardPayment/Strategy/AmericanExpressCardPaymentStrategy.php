<?php

declare(strict_types=1);

namespace App\Service\CardPayment\Strategy;

use App\Constant\PaymentProvider;
use App\Dto\CardPaymentDto;
use App\Dto\CardPaymentResponseDto;

use function uniqid;

class AmericanExpressCardPaymentStrategy implements CardPaymentStrategyInterface
{
    public function isPaymentProviderSupported(string $paymentProvider): bool
    {
        return $paymentProvider === PaymentProvider::AMERICAN_EXPRESS;
    }

    public function handlePayment(CardPaymentDto $payment): CardPaymentResponseDto
    {
        // Call American Express payment provider
        // More logic

        $transactionId = PaymentProvider::AMERICAN_EXPRESS . uniqid();
        return new CardPaymentResponseDto($transactionId);
    }
}
