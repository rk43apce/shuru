<?php

namespace App\Contracts;

interface PaymentGatewayInterface
{
    public function gatewayName(): string;

    /**
     * @param array{
     *     amount: int|float|string,
     *     currency: string,
     *     gateway?: string
     * } $data
     *
     * @return array{
     *     gateway_transaction_id: string,
     *     gateway: string,
     *     amount: int|float|string,
     *     currency: string,
     *     status: string,
     *     meta?: array<string, mixed>,
     *     failure_reason?: string|null
     * }
     */
    public function pay(array $data): array;
}
