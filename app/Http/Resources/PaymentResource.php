<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'transaction_id' => $this['transaction_id'] ?? null,

            'gateway' => $this['gateway'],

            'amount' => [
                'value' => $this['amount'],
                'currency' => $this['currency'] ?? 'INR',
            ],

            'status' => $this['status'],

            'processed_at' => now()->toDateTimeString(),
        ];
    }
}