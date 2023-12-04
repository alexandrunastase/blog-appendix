<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\CardPaymentDto;
use App\Service\CardPayment\CardPaymentServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CardPaymentController
{
    public function __construct(
        private readonly CardPaymentServiceInterface $cardPaymentService,
        private readonly SerializerInterface $serializer,
    ) {
    }

    #[Route('/card-payments', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $paymentDto = $this->serializer->deserialize($request->getContent(), CardPaymentDto::class, 'json');

        $paymentResponse = $this->cardPaymentService->handleCardPayment($paymentDto);

        return new JsonResponse($this->serializer->serialize($paymentResponse, 'json'), json: true);
    }
}
