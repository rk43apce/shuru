<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\PaymentProcessed;

class SendPaymentSms implements ShouldQueue
{
    public string $queue = 'sms';

    public int $tries = 3;

    public int $timeout = 30;


    public function handle(PaymentProcessed $event): void
    {
        Log::info('Sending payment SMS', [
            'payment' => $event->payment
        ]);
    }
}