<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #e5e5e5;
            color: #000;
            padding: 32px 16px;
        }

        /* ── Page shell ── */
        .invoice {
            width: 794px;          /* A4 width at 96dpi */
            margin: 0 auto;
            background: #fff;
            border: 1px solid #000;
        }

        /* ── Header ── */
        .inv-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 22px 28px 18px;
            border-bottom: 2px solid #000;
        }
        .brand-name {
            font-size: 20px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .brand-sub {
            font-size: 10px;
            color: #555;
            margin-top: 2px;
        }
        .brand-contact {
            font-size: 10px;
            color: #444;
            margin-top: 8px;
            line-height: 1.7;
        }
        .inv-meta { text-align: right; }
        .inv-title {
            font-size: 26px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #000;
        }
        .inv-meta table {
            margin-top: 6px;
            margin-left: auto;
            border: none;
        }
        .inv-meta td {
            font-size: 11px;
            padding: 1px 0 1px 12px;
            border: none;
            text-align: left;
        }
        .inv-meta td:first-child {
            color: #666;
            font-weight: 600;
            text-align: right;
            padding-left: 0;
        }

        /* ── Sub-header: Bill To / Payment / QR ── */
        .inv-sub {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 0;
            border-bottom: 1px solid #000;
        }
        .sub-col {
            padding: 14px 20px;
        }
        .sub-col + .sub-col {
            border-left: 1px solid #000;
        }
        .sub-label {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #666;
            margin-bottom: 6px;
        }
        .sub-name {
            font-size: 13px;
            font-weight: 700;
        }
        .sub-detail {
            font-size: 11px;
            color: #333;
            line-height: 1.7;
            margin-top: 2px;
        }

        /* QR */
        .qr-col {
            padding: 12px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            border-left: 1px solid #000;
        }
        .qr-col img {
            width: 76px;
            height: 76px;
            display: block;
            border: 1px solid #ccc;
        }
        .qr-label {
            font-size: 9px;
            color: #777;
            letter-spacing: .5px;
        }

        /* ── Items table ── */
        .items-section { padding: 0 0 0; }
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }
        .items-table thead tr {
            background: #000;
        }
        .items-table thead th {
            color: #fff;
            font-size: 9.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 12px;
            border: none;
        }
        .items-table thead th:first-child { width: 28px; text-align: center; }
        .items-table thead th.right { text-align: right; }
        .items-table thead th.center { text-align: center; }

        .items-table tbody td {
            font-size: 11.5px;
            padding: 8px 12px;
            border-bottom: 1px solid #e5e5e5;
            vertical-align: top;
            color: #000;
        }
        .items-table tbody tr:last-child td { border-bottom: none; }
        .items-table tbody td:first-child { text-align: center; color: #888; font-size: 10px; }
        .items-table tbody td.right { text-align: right; }
        .items-table tbody td.center { text-align: center; }
        .items-table tbody td.amount { text-align: right; font-weight: 700; }

        .product-name { font-weight: 600; }
        .product-attr { font-size: 10px; color: #777; margin-top: 2px; }

        /* ── Totals + footer bar ── */
        .inv-bottom {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 14px 20px 18px;
            border-top: 2px solid #000;
            gap: 24px;
        }

        /* Notes */
        .inv-notes {
            font-size: 10px;
            color: #555;
            line-height: 1.7;
            max-width: 340px;
        }
        .inv-notes strong {
            font-size: 10px;
            font-weight: 700;
            color: #000;
            display: block;
            margin-bottom: 2px;
        }

        /* Summary */
        .summary {
            min-width: 220px;
        }
        .sum-row {
            display: flex;
            justify-content: space-between;
            font-size: 11.5px;
            padding: 4px 0;
            border-bottom: 1px dashed #ccc;
            gap: 24px;
        }
        .sum-row:last-of-type { border-bottom: none; }
        .sum-row span:last-child { font-weight: 600; }
        .sum-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
            padding: 8px 10px;
            border: 2px solid #000;
            gap: 24px;
        }
        .sum-total-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .sum-total-val {
            font-size: 18px;
            font-weight: 800;
        }

        /* ── Sig / stamp row ── */
        .inv-sig {
            display: flex;
            justify-content: flex-end;
            gap: 60px;
            padding: 0 20px 16px;
        }
        .sig-block {
            text-align: center;
            width: 120px;
        }
        .sig-line {
            border-top: 1px solid #000;
            margin-bottom: 4px;
        }
        .sig-label {
            font-size: 9px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ── Very bottom bar ── */
        .inv-foot {
            background: #000;
            color: #fff;
            font-size: 10px;
            text-align: center;
            padding: 7px;
            letter-spacing: .5px;
        }

        /* ── Print button ── */
        .print-btn-wrap {
            text-align: center;
            margin-top: 20px;
        }
        .print-btn {
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 700;
            background: #000;
            color: #fff;
            padding: 11px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            letter-spacing: .5px;
        }
        .print-btn:hover { background: #222; }

        /* ── PRINT overrides ── */
        @page {
            size: A4 portrait;
            margin: 10mm;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .invoice {
                width: 100%;
                border: none;
                page-break-inside: avoid;
            }
            .print-btn-wrap { display: none !important; }
        }
    </style>
</head>
<body>

<div class="invoice">

    {{-- ── Header ── --}}
    <div class="inv-header">
        <div>
            <div class="brand-name">{{ get_setting('site_name', config('app.name')) }}</div>
            <div class="brand-sub">{{ get_setting('site_motto', '') }}</div>
            <div class="brand-contact">
                {{ request()->getHost() }}<br>
                {{ get_setting('contact_email', 'support@example.com') }}<br>
                {{ get_setting('contact_phone', '') }}
            </div>
        </div>
        <div class="inv-meta">
            <div class="inv-title">Invoice</div>
            <table>
                <tr><td>Invoice #</td><td><strong>{{ $order->order_id }}</strong></td></tr>
                <tr><td>Date</td><td>{{ $order->created_at->format('d M Y') }}</td></tr>
                <tr><td>Status</td><td>{{ ucfirst($order->payment_status ?? 'Paid') }}</td></tr>
                @if(!empty($order->transaction_id))
                <tr><td>Txn ID</td><td>{{ $order->transaction_id }}</td></tr>
                @endif
            </table>
        </div>
    </div>

    {{-- ── Sub-header: Billed To / Payment / QR ── --}}
    <div class="inv-sub">
        <div class="sub-col">
            <div class="sub-label">Billed To</div>
            <div class="sub-name">
                {{ $order->shipping_address['first_name'] ?? '' }} {{ $order->shipping_address['last_name'] ?? '' }}
            </div>
            <div class="sub-detail">
                {{ $order->shipping_address['address'] ?? '' }}<br>
                {{ $order->shipping_address['city'] ?? '' }}@if(!empty($order->shipping_address['zip'])), {{ $order->shipping_address['zip'] }}@endif
                @if(!empty($order->shipping_address['phone']))<br>{{ $order->shipping_address['phone'] }}@endif
            </div>
        </div>

        <div class="sub-col">
            <div class="sub-label">Payment Method</div>
            <div class="sub-name" style="font-size:12px;">{{ $order->payment_method ?? 'Online Payment' }}</div>
            <div class="sub-detail" style="margin-top:10px;">
                <div class="sub-label">Order Status</div>
                {{ ucfirst($order->status ?? 'Processing') }}
            </div>
        </div>

        <div class="qr-col">
            <div class="sub-label">Scan Invoice</div>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=76x76&data={{ urlencode(route('product.show', $order->items->first()->product_id)) }}&color=000000&bgcolor=ffffff&margin=3" alt="QR">
            <div class="qr-label">#{{ $order->order_id }}</div>
        </div>
    </div>

    {{-- ── Items ── --}}
    <div class="items-section">
        <table class="items-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="text-align:left">Description</th>
                    <th class="right">Unit Price</th>
                    <th class="center">Qty</th>
                    <th class="right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="product-name">{{ $item->product_name }}</div>
                        @if(!empty($item->attributes))
                            <div class="product-attr">
                                {{ collect($item->attributes)->map(fn($v,$k) => ucfirst($k).': '.$v)->implode('  ·  ') }}
                            </div>
                        @endif
                    </td>
                    <td class="right">{{ get_setting('currency_symbol', '$') }}{{ number_format($item->price, 2) }}</td>
                    <td class="center">{{ $item->quantity }}</td>
                    <td class="amount">{{ get_setting('currency_symbol', '$') }}{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ── Bottom: Notes + Totals ── --}}
    <div class="inv-bottom">

        <div class="inv-notes">
            <strong>Notes</strong>
            Thank you for your purchase. Please keep this invoice for your records.
            For any queries, contact us at {{ get_setting('contact_email', 'support@example.com') }}.
        </div>

        <div class="summary">
            <div class="sum-row">
                <span>Subtotal</span>
                <span>{{ get_setting('currency_symbol', '$') }}{{ number_format($order->price, 2) }}</span>
            </div>
            <div class="sum-row">
                <span>Shipping</span>
                <span>{{ get_setting('currency_symbol', '$') }}{{ number_format($order->shipping_cost, 2) }}</span>
            </div>
            @if(!empty($order->discount) && $order->discount > 0)
            <div class="sum-row">
                <span>Discount</span>
                <span>- {{ get_setting('currency_symbol', '$') }}{{ number_format($order->discount, 2) }}</span>
            </div>
            @endif
            <div class="sum-total">
                <span class="sum-total-label">Grand Total</span>
                <span class="sum-total-val">{{ get_setting('currency_symbol', '$') }}{{ number_format($order->price + $order->shipping_cost - ($order->discount ?? 0), 2) }}</span>
            </div>
        </div>
    </div>

    {{-- ── Signature row ── --}}
    <div class="inv-sig">
        <div class="sig-block">
            <div class="sig-line"></div>
            <div class="sig-label">Customer Signature</div>
        </div>
        <div class="sig-block">
            <div class="sig-line"></div>
            <div class="sig-label">Authorized Signature</div>
        </div>
    </div>

    {{-- ── Footer bar ── --}}
    <div class="inv-foot">
        {{ get_setting('site_name', config('app.name')) }} &nbsp;|&nbsp; {{ request()->getHost() }} &nbsp;|&nbsp; {{ get_setting('contact_email', 'support@example.com') }}
    </div>

</div>

{{-- Print button (screen only) --}}
<div class="print-btn-wrap">
    <button class="print-btn" onclick="window.print()">
        🖨 &nbsp;Print Invoice
    </button>
</div>

</body>
</html>
