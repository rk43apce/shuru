<!DOCTYPE html>
<html>

<head>
    <title>Payment Invoice</title>

    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        .invoice {
            border: 1px solid #ccc;
            padding: 20px;
        }

        h1 {
            color: #333;
        }
    </style>
</head>

<body>

<div class="invoice">

    <h1>Payment Invoice</h1>

    <p>
        <strong>Transaction ID:</strong>
        {{ $transaction_id }}
    </p>

    <p>
        <strong>Gateway:</strong>
        {{ $gateway }}
    </p>

    <p>
        <strong>Amount:</strong>
        {{ $amount }} {{ $currency }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ $status }}
    </p>

    <p>
        <strong>Date:</strong>
        {{ $date }}
    </p>

</div>

</body>
</html>