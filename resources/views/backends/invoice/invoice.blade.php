<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netteach Solution Store - Invoice</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .invoice-header {
            padding: 25px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 70px;
            height: 70px;
            margin-right: 15px;
        }

        .company-info {
            flex-grow: 1;
        }

        .company-name {
            font-size: 22px;
            font-weight: bold;
            color: #1976D2;
            margin: 0;
        }

        .company-details {
            font-size: 14px;
            color: #666;
        }

        .invoice-title {
            text-align: center;
            margin: 20px 0;
            font-size: 24px;
            color: #1976D2;
            font-weight: bold;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin: 0 25px 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-group {
            margin-bottom: 10px;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            min-width: 100px;
        }

        .detail-value {
            color: #333;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .invoice-table th {
            background-color: #1976D2 !important;
            color: white;
            padding: 12px 15px;
            text-align: left;
        }

        .invoice-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .invoice-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .quantity-col {
            width: 10%;
            text-align: center;
        }

        .description-col {
            width: 50%;
        }

        .price-col,
        .amount-col {
            width: 20%;
            text-align: right;
        }

        .invoice-summary {
            width: 350px;
            margin-left: auto;
            margin-right: 25px;
            margin-bottom: 25px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .summary-row.total {
            font-weight: bold;
            font-size: 18px;
            border-bottom: none;
            border-top: 2px solid #1976D2;
            padding-top: 12px;
            color: #1976D2;
        }

        .invoice-footer {
            margin: 30px 25px 25px;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
        }

        .payment-info {
            margin-bottom: 15px;
        }

        .thank-you {
            text-align: center;
            color: #1976D2;
            font-weight: bold;
            margin-top: 20px;
            font-size: 16px;
        }

        @media print {
            body {
                background-color: white;
                padding: 0;
            }

            .invoice-container {
                box-shadow: none;
            }

            .print-button {
                display: none;
            }

            .invoice-table th {
                background-color: #1976D2 !important;
                -webkit-print-color-adjust: exact;
            }
        }

        .print-button {
            background-color: #1976D2;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 20px;
            display: block;
            margin: 20px auto;
        }

        .print-button:hover {
            background-color: #1565C0;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="logo-container">
                <img src="{{ session()->has('app_icon') && file_exists(public_path('uploads/business_settings/' . session()->get('app_icon'))) ? asset('uploads/business_settings/' . session()->get('app_icon')) : asset('uploads/image/default-icon.png') }}"
                    alt="Netteach Logo" class="logo">
                <div class="company-info">
                    <h1 class="company-name">{{ $business->company_name }}</h1>
                    <div class="company-details">
                        {{ $business->company_address }}<br>
                        Phone: {{ $business->phone }} | Email: {{ $business->email }}
                    </div>
                </div>
            </div>
        </div>

        <h2 class="invoice-title">INVOICE</h2>

        <div class="invoice-details">
            <div class="left-details">
                <div class="detail-group">
                    <span class="detail-label">Invoice To:</span>
                    <span class="detail-value">
                        {{ $invoice->customer ? $invoice->customer->first_name . ' ' . $invoice->customer->last_name : 'Walk-in Customer' }}</span>
                </div>
                <div class="detail-group">
                    <span class="detail-label">Address:</span>
                    <span class="detail-value">{{ $invoice->customer->address ?? '' }}</span>
                </div>
                <div class="detail-group">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">{{ $invoice->customer->phone ?? '' }}</span>
                </div>
            </div>

            <div class="right-details">
                <div class="detail-group">
                    <span class="detail-label">Invoice No:</span>
                    <span class="detail-value">{{ $invoice->order_number ?? '' }}</span>
                </div>
                <div class="detail-group">
                    <span class="detail-label">Date:</span>
                    <span class="detail-value">{{ $invoice->created_at->format('d M Y h:i A') }}</span>
                </div>
                <div class="detail-group">
                    <span class="detail-label">Seller:</span>
                    <span
                        class="detail-value">{{ $invoice->user->first_name ?? ('' . ' ' . $invoice->user->last_name ?? '') }}</span>
                </div>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th class="quantity-col">QTY</th>
                    <th class="description-col">Product Name</th>
                    <th class="price-col">Unit Price</th>
                    <th class="price-col">Discount</th>
                    <th class="amount-col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->orderdetails as $item)
                    <tr>
                        <td>{{ $item->quantity ?? '' }}</td>
                        <td>{{ $item->product->name ?? '' }}</td>
                        <td>${{ number_format(optional($item->product)->price, 2) ?? '0.00' }}</td>
                        {{-- <td>{{ $item->discount_type ?? '' }}</td> --}}
                        <td>
                            @if ($item->discount_type == 'percent')
                                {{ number_format($item->discount, 2) }}%
                            @elseif ($item->discount_type == 'fixed')
                                ${{ number_format($item->discount, 2) }}
                            @else
                                $0.00
                            @endif
                        </td>
                        <td>{{ number_format($item->price, 2) ?? '' }}$</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="invoice-summary">
            <div class="summary-row">
                <span>Subtotal</span>
                <span>${{ number_format($invoice->total_amount, 2) ?? '' }}</span>
            </div>
            <div class="summary-row">
                <span>Discount</span>
                <span>
                    @if ($invoice->discount_type == 'percent')
                        {{ number_format($invoice->discount, 2) ?? '0.00' }}%
                    @else
                        ${{ number_format($invoice->discount_amount, 2) ?? '0.00' }}
                    @endif
                </span>
            </div>
            {{-- <div class="summary-row">
                <span>Tax (0%)</span>
                <span>$0.00</span>
            </div> --}}
            <div class="summary-row total">
                <span>Total</span>
                <span>${{ number_format($invoice->total_amount, 2) ?? '0.00' }}</span>
            </div>
        </div>

        <div class="invoice-footer">
            {{-- <div class="payment-info">
                <strong>Payment Information:</strong><br>
                Bank: National Bank<br>
                Account Name: Netteach Solutions<br>
                Account Number: 1234567890<br>
                Swift Code: NTECHBANK
            </div>
            <div class="terms">
                <strong>Terms & Conditions:</strong><br>
                Payment is due within 14 days. Late payment may incur additional fees.
                All items remain the property of Netteach Solution Store until full payment is received.
            </div> --}}
            <div class="thank-you">
                Thank you for your Order.
            </div>
        </div>
    </div>
</body>

</html>
