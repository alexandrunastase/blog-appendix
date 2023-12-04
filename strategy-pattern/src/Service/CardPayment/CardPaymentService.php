<?php

declare(strict_types=1);

namespace App\Service\CardPayment;

use App\Dto\CardPaymentDto;
use App\Dto\CardPaymentResponseDto;
use App\Exception\UnsupportedPaymentStrategyException;
use App\Service\CardPayment\Strategy\CardPaymentStrategyInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

use function is_null;

class CardPaymentService implements CardPaymentServiceInterface
{
    /**
     * @param iterable<CardPaymentStrategyInterface> $cardPaymentStrategies
     */
    public function __construct(
        #[TaggedIterator(CardPaymentStrategyInterface::class)]
        private readonly iterable $cardPaymentStrategies,
    ) {
    }

    public function handleCardPayment(CardPaymentDto $paymentDto): CardPaymentResponseDto
    {
        $paymentStrategy = $this->getStrategy($paymentDto->getProvider());

        return $paymentStrategy->handlePayment($paymentDto);
    }

    public function getStrategy(string $paymentMethod): CardPaymentStrategyInterface
    {
        $chosenPaymentStrategy = null;
        foreach ($this->cardPaymentStrategies as $paymentStrategy) {
            if ($paymentStrategy->isPaymentMethodSupported($paymentMethod)) {
                $chosenPaymentStrategy = $paymentStrategy;
            }
        }

        if (is_null($chosenPaymentStrategy)) {
            throw UnsupportedPaymentStrategyException::createForPaymentProvider($paymentMethod);
        }

        return $chosenPaymentStrategy;
    }
}
