<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gateway' => 'required|string|in:razorpay,stripe,paypal',
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|string|size:3',
        ];
    }
}
