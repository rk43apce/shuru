<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;

class StripeService implements PaymentGatewayInterface
{
    public function gatewayName(): string
    {
        return 'stripe';
    }

    public function pay(array $data): array
    {
        return [
            'gateway_transaction_id' => uniqid('stripe_'),

            'gateway' => $this->gatewayName(),

            'amount' => $data['amount'],

            'currency' => $data['currency'],

            'status' => 'success',

            'meta' => [],
        ];
    }
}
