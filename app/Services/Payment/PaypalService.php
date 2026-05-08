<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;

class PaypalService implements PaymentGatewayInterface
{
    public function gatewayName(): string
    {
        return 'paypal';
    }

    public function pay(array $data): array
    {
        return [
            'gateway_transaction_id' => uniqid('paypal_'),

            'gateway' => $this->gatewayName(),

            'amount' => $data['amount'],

            'currency' => $data['currency'],

            'status' => 'success',

            'meta' => [],
        ];
    }
}
