<?php

namespace App\Repositories\Eloquent;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\PaymentRepositoryInterface;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    public function __construct(Payment $payment)
    {
        parent::__construct($payment);
    }

    /**
     * @return Collection<int, Payment>
     */
    public function all(): Collection
    {
        return parent::all();
    }

    public function find(int $id): ?Payment
    {
        /** @var Payment|null $payment */
        $payment = parent::find($id);

        return $payment;
    }

    public function create(array $attributes): Payment
    {
        /** @var Payment $payment */
        $payment = parent::create($attributes);

        return $payment;
    }

    public function update(int $id, array $attributes): ?Payment
    {
        /** @var Payment|null $payment */
        $payment = parent::update($id, $attributes);

        return $payment;
    }
}
