<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            /**
             * Public Transaction ID
             * Used for tracking
             */
            $table->uuid('transaction_id')
                ->unique();

            /**
             * User Reference
             */
            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->index();

            /**
             * Payment Gateway
             * razorpay, stripe, paypal
             */
            $table->string('gateway', 50)
                ->index();

            /**
             * Payment Amount
             */
            $table->decimal('amount', 12, 2);

            /**
             * Currency
             */
            $table->string('currency', 10)
                ->default('INR');

            /**
             * Payment Status
             */
            $table->enum('status', [
                'pending',
                'processing',
                'success',
                'failed',
                'refunded'
            ])->default('pending')
              ->index();

            /**
             * External Gateway Transaction ID
             */
            $table->string('gateway_transaction_id')
                ->nullable()
                ->index();

            /**
             * Idempotency Key
             * Prevent duplicate payments
             */
            $table->string('idempotency_key')
                ->nullable()
                ->unique();

            /**
             * Payment Metadata
             * Flexible storage
             */
            $table->json('meta')
                ->nullable();

            /**
             * Failure Reason
             */
            $table->text('failure_reason')
                ->nullable();

            /**
             * Payment Success Timestamp
             */
            $table->timestamp('paid_at')
                ->nullable();

            $table->timestamps();

            /**
             * Composite Index
             */
            $table->index([
                'user_id',
                'status'
            ]);
        });
    }

    /**
     * Reverse migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};