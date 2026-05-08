<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Payment;
use App\Events\PaymentProcessed;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\PaymentRepositoryInterface;

class PaymentService
{
    public function __construct(
        private readonly PaymentRepositoryInterface $payments,
        private readonly PaymentManager $paymentManager
    ) {
    }

    public function process(array $data): Payment
    {

        return DB::transaction(function () use ($data) {
            $gatewayPayment = $this->paymentManager
                ->gateway($data['gateway'])
                ->pay($data);

            $payment = $this->payments->create([

                'transaction_id' => Str::uuid(),

                'user_id' => auth()->id(),

                'gateway' => $gatewayPayment['gateway'],

                'amount' => $gatewayPayment['amount'],

                'currency' => $gatewayPayment['currency'],

                'status' => $gatewayPayment['status'],

                'gateway_transaction_id' =>
                    $gatewayPayment['gateway_transaction_id'],

                'idempotency_key' =>
                    request()->header('Idempotency-Key'),

                'failure_reason' =>
                    $gatewayPayment['failure_reason'] ?? null,

                'paid_at' =>
                    $gatewayPayment['status'] === 'success' ? now() : null,

                'meta' => [
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'gateway' => $gatewayPayment['meta'] ?? [],
                ],
            ]);

            event(new PaymentProcessed(
                $payment->toArray()
            ));

            return $payment;
        });
    }
}
