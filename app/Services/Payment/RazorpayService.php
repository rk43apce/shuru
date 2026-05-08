<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;

class RazorpayService implements PaymentGatewayInterface
{
    public function gatewayName(): string
    {
        return 'razorpay';
    }

    public function pay(array $data): array
    {
        return [
            'gateway_transaction_id' => uniqid('rzp_'),

            'gateway' => $this->gatewayName(),

            'amount' => $data['amount'],

            'currency' => $data['currency'],

            'status' => 'success',

            'meta' => [],
        ];
    }
}
