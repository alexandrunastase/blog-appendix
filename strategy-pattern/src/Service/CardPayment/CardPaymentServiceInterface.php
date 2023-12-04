<?php

declare(strict_types=1);

namespace App\Service\CardPayment;

use App\Dto\CardPaymentDto;
use App\Dto\CardPaymentResponseDto;

interface CardPaymentServiceInterface
{
    public function handleCardPayment(CardPaymentDto $paymentDto): CardPaymentResponseDto;
}
