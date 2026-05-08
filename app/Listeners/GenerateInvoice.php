<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\PaymentProcessed;

class GenerateInvoice implements ShouldQueue
{
    /**
     * Queue Name
     */
    public string $queue = 'invoices';

    /**
     * Retry Attempts
     */
    public int $tries = 3;

    /**
     * Timeout
     */
    public int $timeout = 60;

    public function handle(PaymentProcessed $event): void
    {
        $payment = $event->payment;

        // Render Blade View into HTML
        $html = view(
            'invoices.payment',
            [
                'transaction_id' => $payment['transaction_id'],
                'gateway' => $payment['gateway'],
                'amount' => $payment['amount'],
                'currency' => $payment['currency'],
                'status' => $payment['status'],
                'date' => now()->toDateTimeString(),
            ]
        )->render();

        // File name
        $fileName = 'invoices/' .
            $payment['transaction_id'] . '.html';

        // Store HTML file
        Storage::put($fileName, $html);

        Log::info('Invoice HTML generated', [
            'file' => $fileName
        ]);
    }

    /**
     * Failed Job Handler
     */
    public function failed(
        PaymentProcessed $event,
        \Throwable $exception
    ): void {

        Log::error('Invoice generation failed', [
            'error' => $exception->getMessage(),
            'payment' => $event->payment
        ]);
    }
}