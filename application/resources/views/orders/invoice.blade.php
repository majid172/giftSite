<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->order_id }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            color: #1a1a1a;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
        }

        .invoice-wrapper {
            max-width: 850px;
            margin: 40px auto;
            background: #fff;
            padding: 60px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 30px;
            margin-bottom: 40px;
        }

        .brand h1 {
            font-size: 28px;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.025em;
            color: #111827;
        }

        .brand p {
            font-size: 14px;
            color: #6b7280;
            margin: 4px 0 0;
        }

        .invoice-meta {
            text-align: right;
        }

        .invoice-meta h2 {
            font-size: 32px;
            font-weight: 800;
            margin: 0;
            color: #111827;
            text-transform: uppercase;
        }

        .invoice-meta p {
            font-size: 14px;
            color: #6b7280;
            margin: 4px 0 0;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 50px;
        }

        .details-block h3 {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #9ca3af;
            margin-bottom: 12px;
        }

        .details-block p {
            font-size: 15px;
            margin: 0;
            color: #374151;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .items-table th {
            text-align: left;
            padding: 12px 16px;
            background: #f9fafb;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #4b5563;
        }

        .items-table td {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 15px;
            color: #111827;
        }

        .items-table .text-right { text-align: right; }
        .items-table .text-center { text-align: center; }

        .summary {
            display: flex;
            justify-content: flex-end;
        }

        .summary-box {
            width: 300px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 15px;
        }

        .summary-row.total {
            border-top: 2px solid #111827;
            margin-top: 12px;
            padding-top: 16px;
            font-weight: 800;
            font-size: 20px;
            color: #111827;
        }

        .footer {
            margin-top: 80px;
            padding-top: 30px;
            border-top: 1px solid #f3f4f6;
            text-align: center;
        }

        .footer p {
            font-size: 14px;
            color: #9ca3af;
            margin: 0;
        }

        .print-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #111827;
            color: #fff;
            padding: 12px 24px;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }

        .print-btn:hover { transform: translateY(-2px); }

        @media print {
            body { background: #fff; }
            .invoice-wrapper { margin: 0; box-shadow: none; border: none; padding: 0; }
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-wrapper">
        <header class="header">
            <div class="brand">
                <h1>GiftPack</h1>
                <p>Premium Gift Solutions</p>
            </div>
            <div class="invoice-meta">
                <h2>Invoice</h2>
                <p>#{{ $order->order_id }}</p>
                <p>Date: {{ $order->created_at->format('F d, Y') }}</p>
            </div>
        </header>

        <section class="details-grid">
            <div class="details-block">
                <h3>Billed To</h3>
                <p><strong>{{ $order->shipping_address['first_name'] }} {{ $order->shipping_address['last_name'] }}</strong></p>
                <p>{{ $order->shipping_address['address'] }}</p>
                <p>{{ $order->shipping_address['city'] }}, {{ $order->shipping_address['zip'] }}</p>
                <p>Phone: {{ $order->shipping_address['phone'] ?? 'N/A' }}</p>
            </div>
            <div class="details-block">
                <h3>Payment Details</h3>
                <p>Method: {{ $order->payment_method ?? 'Payment Verified' }}</p>
                <p>Status: Fully Paid</p>
            </div>
        </section>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->product_name }}</strong>
                            @if(!empty($item->attributes))
                                <br><small style="color: #6b7280">{{ collect($item->attributes)->map(fn($v, $k) => ucfirst($k) . ': ' . $v)->implode(', ') }}</small>
                            @endif
                        </td>
                        <td class="text-center">${{ number_format($item->price, 2) }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <div class="summary-box">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($order->price, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>$0.00</span>
                </div>
                <div class="summary-row total">
                    <span>Total Amount</span>
                    <span>${{ number_format($order->price, 2) }}</span>
                </div>
            </div>
        </div>

        <footer class="footer">
            <p>Thank you for choosing GiftPack for your premium gifting needs.</p>
            <p style="margin-top: 8px; font-weight: 600">giftpack.com &bull; support@giftpack.com</p>
        </footer>
    </div>

    <button class="print-btn" onclick="window.print()">Print Invoice</button>
</body>
</html>
