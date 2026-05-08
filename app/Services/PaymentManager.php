<?php

namespace App\Services;

use Exception;
use App\Services\Payment\StripeService;
use App\Services\Payment\PaypalService;
use App\Services\Payment\RazorpayService;
use App\Contracts\PaymentGatewayInterface;

class PaymentManager
{
    public function gateway(string $gateway): PaymentGatewayInterface
    {
        return match ($gateway) {
            'razorpay' => app(RazorpayService::class),
            'stripe' => app(StripeService::class),
            'paypal' => app(PaypalService::class),

            default => throw new Exception('Unsupported gateway')
        };
    }
}
