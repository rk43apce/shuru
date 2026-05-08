# Payment Flow

```mermaid
flowchart TD
    A[Client sends POST /api/payments] --> B[PaymentController@store]
    B --> C[StorePaymentRequest validates input]

    C -->|Valid gateway, amount, currency| D[PaymentService::process]
    C -->|Invalid request| X[Return validation error response]

    D --> E[Start database transaction]
    E --> F[Build payment data]
    F --> G[PaymentRepositoryInterface::create]
    G --> H[Eloquent PaymentRepository]
    H --> I[(payments table)]

    I --> J[Create Payment model]
    J --> K[Dispatch PaymentProcessed event]
    K --> L[SendPaymentEmail listener]
    K --> M[SendPaymentSms listener]

    L --> N[Commit transaction and return Payment]
    M --> N
    N --> O[PaymentResource formats response]
    O --> P[Return success JSON response]
```

## Steps

1. The client calls `POST /api/payments`.
2. `PaymentController@store` receives the request.
3. `StorePaymentRequest` validates `gateway`, `amount`, and `currency`.
4. `PaymentService::process` starts a database transaction.
5. The service prepares payment attributes like `transaction_id`, `user_id`, `status`, `idempotency_key`, `paid_at`, and `meta`.
6. `PaymentRepositoryInterface` stores the payment through the Eloquent `PaymentRepository`.
7. The payment row is created in the `payments` table.
8. `PaymentProcessed` is dispatched.
9. Registered listeners handle side effects like email and SMS.
10. `PaymentResource` returns the successful payment response.
