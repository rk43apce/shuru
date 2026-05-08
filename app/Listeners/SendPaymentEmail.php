<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\PaymentProcessed;

class SendPaymentEmail implements ShouldQueue
{
    /**
     * Retry attempts
     */
    public int $tries = 3;

    /**
     * Timeout in seconds
     */
    public int $timeout = 30;

    public string $queue = 'emails';

    public function handle(PaymentProcessed $event): void
    {
        Log::info('Sending payment email', [
            'payment' => $event->payment
        ]);

        /*
        Mail::to($user)->send(
            new PaymentSuccessMail($event->payment)
        );
        */
    }

    /**
     * Handle failed job
     */
    public function failed( PaymentProcessed $event,\Throwable $exception): void {

        Log::error('Payment email failed', [
            'error' => $exception->getMessage(),
            'payment' => $event->payment
        ]);
    }
}