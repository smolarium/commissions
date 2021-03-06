<?php

declare(strict_types = 1);

namespace Smolarium\Commissions\Infrastructure\Domain\Payment\Factory;

use Smolarium\Commissions\Domain\CreditCard\Bin;
use Smolarium\Commissions\Infrastructure\Domain\Money\Factory\ScalarImplementation as MoneyFactory;
use Smolarium\Commissions\Domain\Payment;

class FromJsonImplementation
{
    /**
     * @param string $jsonString
     * @return Payment
     * @throws \JsonException
     */
    public static function createFromJson(string $jsonString) : Payment
    {
        $decoded = json_decode($jsonString, false, 2, JSON_THROW_ON_ERROR);
        //@todo more validation needed here
        return new Payment(
            new Bin((int)$decoded->bin),
            MoneyFactory::createFromScalar(
                (float)$decoded->amount,
                $decoded->currency
            )
        );
    }
}
