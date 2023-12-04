<?php

declare(strict_types=1);

namespace App\Service\CardPayment\Strategy;

use App\Constant\PaymentProvider;
use App\Dto\CardPaymentDto;
use App\Dto\CardPaymentResponseDto;

use function uniqid;

class MastercardCardPaymentStrategy implements CardPaymentStrategyInterface
{
    public function isPaymentProviderSupported(string $paymentProvider): bool
    {
        return $paymentProvider === PaymentProvider::MASTERCARD;
    }

    public function handlePayment(CardPaymentDto $payment): CardPaymentResponseDto
    {
        // Call Mastercard payment provider
        // More logic

        $transactionId = PaymentProvider::MASTERCARD . uniqid();
        return new CardPaymentResponseDto($transactionId);
    }
}
