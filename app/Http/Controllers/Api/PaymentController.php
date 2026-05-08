<?php

namespace App\Http\Controllers\Api;

use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\PaymentResource;

class PaymentController extends Controller
{
    public function store(
        StorePaymentRequest $request,
        PaymentService $paymentService
    ) {

        $payment = $paymentService->process(
            $request->validated()
        );

        return (new PaymentResource($payment))
            ->additional([
                'success' => true,
                'message' => 'Payment processed successfully'
            ]);
    }
}