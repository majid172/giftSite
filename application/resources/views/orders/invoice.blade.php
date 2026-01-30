<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - #{{ $order->order_id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        @media print {
            .no-print { display: none !important; }
            .print-shadow-none { box-shadow: none !important; }
            body { background: white; }
        }
    </style>
</head>
<body class="bg-stone-100 py-10 print:py-0 print:bg-white text-stone-800">

    <!-- Invoice Wrapper -->
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden print:shadow-none print-shadow-none print:w-full print:max-w-none">
        
        <!-- Header -->
        <div class="p-8 md:p-12 border-b border-stone-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <!-- Brand -->
                <div>
                    <h1 class="text-2xl font-bold text-emerald-950 uppercase tracking-wide">{{ get_setting('site_name', config('app.name')) }}</h1>
                    <p class="text-sm text-stone-500 mt-1">{{ get_setting('site_motto', config('app.name')) }}</p>
                    <div class="mt-4 text-xs text-stone-500 leading-relaxed">
                        {{ request()->getHost() }}<br>
                        support@giftpack.com
                    </div>
                </div>

                <!-- Invoice Meta -->
                <div class="text-right">
                    <h2 class="text-4xl font-extrabold text-stone-200 uppercase tracking-widest leading-none">Invoice</h2>
                    <div class="mt-4 space-y-1">
                        <p class="text-sm font-medium text-stone-600">Invoice #: <span class="font-bold text-stone-900">{{ $order->order_id }}</span></p>
                        <p class="text-sm font-medium text-stone-600">Date: <span class="font-bold text-stone-900">{{ $order->created_at->format('F d, Y') }}</span></p>
                        <p class="text-sm font-medium text-stone-600">Status: 
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-emerald-100 text-emerald-800 uppercase">
                                Paid
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Billing & Payment Details -->
        <div class="p-8 md:p-12 bg-stone-50/50">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Billed To -->
                <div>
                    <h3 class="text-xs font-bold text-stone-400 uppercase tracking-wider mb-4">Billed To</h3>
                    <div class="text-sm text-stone-800 leading-relaxed">
                        <p class="font-bold text-base text-stone-900">{{ $order->shipping_address['first_name'] }} {{ $order->shipping_address['last_name'] }}</p>
                        <p>{{ $order->shipping_address['address'] }}</p>
                        <p>{{ $order->shipping_address['city'] }}, {{ $order->shipping_address['zip'] }}</p>
                        @if(!empty($order->shipping_address['phone']))
                            <p class="mt-2 text-stone-500"><span class="font-medium text-stone-700">Phone:</span> {{ $order->shipping_address['phone'] }}</p>
                        @endif
                    </div>
                </div>

                <!-- Payment Details -->
                <div>
                    <h3 class="text-xs font-bold text-stone-400 uppercase tracking-wider mb-4">Payment Method</h3>
                    <div class="text-sm text-stone-800">
                        <p class="font-medium">{{ $order->payment_method ?? 'Online Payment' }}</p>
                        <p class="text-stone-500 mt-1">Thanks for your business.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="p-8 md:p-12">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-stone-100">
                            <th class="py-4 text-xs font-bold text-stone-400 uppercase tracking-wider pl-2">Description</th>
                            <th class="py-4 text-xs font-bold text-stone-400 uppercase tracking-wider text-right">Price</th>
                            <th class="py-4 text-xs font-bold text-stone-400 uppercase tracking-wider text-center">Qty</th>
                            <th class="py-4 text-xs font-bold text-stone-400 uppercase tracking-wider text-right pr-2">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($order->items as $item)
                        <tr class="border-b border-stone-50">
                            <td class="py-4 pl-2">
                                <p class="font-bold text-stone-900">{{ $item->product_name }}</p>
                                @if(!empty($item->attributes))
                                    <p class="text-xs text-stone-500 mt-0.5">
                                        {{ collect($item->attributes)->map(fn($v, $k) => ucfirst($k) . ': ' . $v)->implode(', ') }}
                                    </p>
                                @endif
                            </td>
                            <td class="py-4 text-right align-top text-stone-600">{{ get_setting('currency_symbol', '$') }}{{ number_format($item->price, 2) }}</td>
                            <td class="py-4 text-center align-top text-stone-600">{{ $item->quantity }}</td>
                            <td class="py-4 text-right align-top font-medium text-stone-900 pr-2">{{ get_setting('currency_symbol', '$') }}{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Summary -->
            <div class="mt-8 flex justify-end">
                <div class="w-full md:w-1/3 space-y-3">
                    <div class="flex justify-between text-sm text-stone-600">
                        <span>Subtotal</span>
                        <span class="font-medium">{{ get_setting('currency_symbol', '$') }}{{ number_format($order->price, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-stone-600">
                        <span>Shipping</span>
                        <span class="font-medium">{{ get_setting('currency_symbol', '$') }}0.00</span>
                    </div>
                    <div class="pt-4 border-t-2 border-stone-900 flex justify-between items-center mt-4">
                        <span class="text-base font-bold text-emerald-950">Total</span>
                        <span class="text-xl font-bold text-emerald-950">{{ get_setting('currency_symbol', '$') }}{{ number_format($order->price, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-8 md:px-12 py-8 bg-stone-50 border-t border-stone-100 text-center">
            <p class="text-sm font-medium text-emerald-900">Thank you for choosing {{ get_setting('site_name', config('app.name')) }}!</p>
            <p class="text-xs text-stone-500 mt-2">If you have any questions about this invoice, please verify with us.</p>
        </div>
    </div>

    <!-- Print Button -->
    <div class="fixed bottom-8 right-8 no-print">
        <button onclick="window.print()" class="bg-emerald-900 hover:bg-emerald-800 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Print Invoice
        </button>
    </div>

</body>
</html>
