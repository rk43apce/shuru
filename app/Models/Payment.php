<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'transaction_id',
        'user_id',
        'gateway',
        'amount',
        'currency',
        'status',
        'gateway_transaction_id',
        'idempotency_key',
        'meta',
        'failure_reason',
        'paid_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'paid_at' => 'datetime',
    ];
}