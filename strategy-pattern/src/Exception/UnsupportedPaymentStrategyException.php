<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

use function sprintf;

class UnsupportedPaymentStrategyException extends Exception
{
    public static function createForPaymentProvider(string $provider): self
    {
        $message = 'Card payment provider %s is not supported';
        return new self(sprintf($message, $provider));
    }
}
