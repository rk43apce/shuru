<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentProcessed
{
    use Dispatchable, SerializesModels;

    public array $payment;

    public function __construct(array $payment)
    {
        $this->payment = $payment;
    }
}