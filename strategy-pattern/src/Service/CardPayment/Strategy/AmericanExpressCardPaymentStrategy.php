<?php

declare(strict_types=1);

namespace App\Service\CardPayment\Strategy;

use App\Constant\PaymentProvider;
use App\Dto\CardPaymentDto;
use App\Dto\CardPaymentResponseDto;

use function uniqid;

class AmericanExpressCardPaymentStrategy implements CardPaymentStrategyInterface
{
    public function isPaymentMethodSupported(string $paymentMethod): bool
    {
        return $paymentMethod === PaymentProvider::AMERICAN_EXPRESS;
    }

    public function handlePayment(CardPaymentDto $payment): CardPaymentResponseDto
    {
        // Call American Express payment provider
        // Add more logic

        $transactionId = PaymentProvider::AMERICAN_EXPRESS . uniqid();
        return new CardPaymentResponseDto($transactionId);
    }
}
