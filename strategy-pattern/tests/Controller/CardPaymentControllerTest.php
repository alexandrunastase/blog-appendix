<?php

declare(strict_types=1);

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Response;

use function json_decode;
use function json_encode;

class CardPaymentControllerTest extends WebTestCase
{
    public function getValidPaymentProviders(): iterable
    {
        yield 'visa' => ['visa'];
        yield 'mastercard' => ['mastercard'];
        yield 'american express' => ['american_express'];
    }

    /**
     * @dataProvider getValidPaymentProviders
     */
    public function testPostCardPaymentWhenValidProviderReturnsExpectedTransactionId(string $paymentProvider): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/card-payments',
            content: json_encode([
                'amount' => '99.00',
                'currency' => 'EUR',
                'provider' => $paymentProvider,
            ],
            ),
        );

        $this->assertResponseIsSuccessful();
        $result = json_decode($client->getResponse()->getContent(), true);
        $this->assertStringStartsWith($paymentProvider, $result['transactionId']);
    }

    public function testPostCardPaymentWhenInvalidProviderIsGiven(): void
    {
        $client = static::createClient();
        $response = $client->request(
            'POST',
            '/card-payments',
            content: json_encode([
                'amount' => '99.00',
                'currency' => 'EUR',
                'provider' => 'invalid_provider',
            ],
            ),
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
