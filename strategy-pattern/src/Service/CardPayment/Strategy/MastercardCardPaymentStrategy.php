<?php

declare(strict_types=1);

namespace App\Service\CardPayment\Strategy;

use App\Constant\PaymentProvider;
use App\Dto\CardPaymentDto;
use App\Dto\CardPaymentResponseDto;

use function uniqid;

class MastercardCardPaymentStrategy implements CardPaymentStrategyInterface
{
    public function isPaymentMethodSupported(string $paymentMethod): bool
    {
        return $paymentMethod === PaymentProvider::MASTERCARD;
    }

    public function handlePayment(CardPaymentDto $payment): CardPaymentResponseDto
    {
        // Call Mastercard payment provider
        // Add more logic

        $transactionId = PaymentProvider::MASTERCARD . uniqid();
        return new CardPaymentResponseDto($transactionId);
    }
}
