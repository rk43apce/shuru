<?php

namespace App\Repositories\Contracts;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;

interface PaymentRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return Collection<int, Payment>
     */
    public function all(): Collection;

    public function find(int $id): ?Payment;

    public function create(array $attributes): Payment;

    public function update(int $id, array $attributes): ?Payment;
}
