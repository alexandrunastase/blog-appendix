<?php

declare(strict_types=1);

namespace App\Service\CardPayment\Strategy;

use App\Constant\PaymentProvider;
use App\Dto\CardPaymentDto;
use App\Dto\CardPaymentResponseDto;

use function uniqid;

class VisaCardPaymentStrategy implements CardPaymentStrategyInterface
{
    public function isPaymentMethodSupported(string $paymentMethod): bool
    {
        return $paymentMethod === PaymentProvider::VISA;
    }

    public function handlePayment(CardPaymentDto $payment): CardPaymentResponseDto
    {
        // Call Visa payment provider
        // Add more logic

        $transactionId = PaymentProvider::VISA . uniqid();
        return new CardPaymentResponseDto($transactionId);
    }
}
