{{-- @extends('backends.master')
@section('contents') --}}
{{-- <div class="layout-container">
    <!-- Invoice Content -->
    <div class="invoice-container">
        <!-- Logo and Company Name -->
        <div class="text-center">
            <svg class="logo" viewBox="0 0 100 100">
                <rect x="20" y="20" width="60" height="60" fill="#0077cc" />
                <path d="M30 50 L70 50 M50 30 L50 70" stroke="white" stroke-width="5" />
            </svg>
            <h2 class="store-name text-center">Netteach Solution Store</h2>
            <h3 class="invoice-title text-center">Invoice</h3>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-header">
            <div>
                <p style="margin-bottom: 5px;"><strong style="color: rgb(0, 157, 255)">Invoice ID:</strong> <span style="margin-left: 10px;">001</span></p>
                <p style="margin-bottom: 0;"><strong style="color: rgb(0, 157, 255)">Date:</strong> <span style="margin-left: 42px;">11/02/2024</span></p>
            </div>
            <div>
                <p style="margin-bottom: 0;"><strong style="color: rgb(0, 157, 255)">Customer:</strong> <span style="margin-left: 10px;">Walk in customer</span></p>
            </div>
        </div>

        <!-- Invoice Table -->
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10%">QTY</th>
                    <th style="width: 50%">Description</th>
                    <th style="width: 20%">Unit Price</th>
                    <th style="width: 20%">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2</td>
                    <td>Charger</td>
                    <td>10.00$</td>
                    <td>Amount</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Dell desktop</td>
                    <td>10.00$</td>
                    <td>Amount</td>
                </tr>
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="total-section">
            <div class="total-row">
                <span class="total-label">Subtotal:</span>
                <span>4.00$</span>
            </div>
            <div class="total-row">
                <span class="total-label">Discount:</span>
                <span>1.00$</span>
            </div>
            <div class="total-row">
                <span class="total-label total">Total:</span>
                <span class="total">3.00$</span>
            </div>
        </div>
        <div style="display: flex; justify-content: flex-end;" class="mt-4">
            <button onclick="printFile()" class="btn btn-primary" style="width: 100px;">Print</button>
        </div>
    </div>

</div> --}}
{{-- @include('backends.invoice.invoice_style') --}}




{{-- @endsection --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        .logo {
            width: 100px;
            margin: 20px auto;
            display: block;
        }

        .store-name {
            color: #0077cc;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .invoice-title {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .invoice-header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .table {
            margin-top: 20px;
        }

        .table th {
            background-color: #0077cc;
            color: white;
            font-weight: normal;
            border: none;
        }

        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .total-section {
            margin-top: 20px;
            text-align: right;
        }

        .total-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 5px;
        }

        .total-label {
            margin-right: 50px;
        }

        .total {
            color: #0077cc;
        }

        .layout-container {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            padding: 20px;
            width: 90%;
        }

        .invoice-container {
            flex: 1;
            margin-left: 15px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <div class="layout-container">
        <!-- Invoice Content -->
        <div class="invoice-container">
            <!-- Logo and Company Name -->
            <div class="text-center">
                <img class="logo" src="{{ asset('svgs/invoice-profile.svg') }}" alt="Logo">
                <h2 class="store-name text-center">Netteach Solution Store</h2>
                <h3 class="invoice-title text-center">Invoice</h3>
            </div>

            <!-- Invoice Details -->
            <div class="invoice-header">
                <div>
                    <p style="margin-bottom: 5px;">
                        <strong style="color: rgb(0, 157, 255)">Invoice ID:</strong>
                        <span style="margin-left: 10px;">{{ $invoice->order_number ?? '' }}</span>
                    </p>
                    <p style="margin-bottom: 0;">
                        <strong style="color: rgb(0, 157, 255)">Date:</strong>
                        <span style="margin-left: 42px;">{{ $invoice->created_at->format('d/m/Y') }}</span>
                    </p>
                </div>
                <div>
                    <p style="margin-bottom: 0;">
                        <strong style="color: rgb(0, 157, 255)">Customer:</strong>
                        <span style="margin-left: 10px;">
                            {{ $invoice->user ? $invoice->user->first_name . ' ' . $invoice->user->last_name : 'Walk-in Customer' }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Invoice Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10%">QTY</th>
                        <th style="width: 50%">Description</th>
                        <th style="width: 20%">Unit Price</th>
                        <th style="width: 20%">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->orderdetails as $item)
                        <tr>
                            <td>{{ $item->quantity ?? '' }}</td>
                            <td>{{ $item->products->name ?? '' }}</td>
                            <td>{{ number_format($item->products->price, 2) ?? '' }}$</td>
                            <td>{{ number_format($item->price, 2) ?? '' }}$</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Total Section -->
            <div class="total-section">
                <div class="total-row">
                    <span class="total-label">Subtotal:</span>
                    <span>{{ number_format($invoice->total_amount, 2) ?? '' }}$</span>
                </div>
                <div class="total-row">
                    <span class="total-label">Discount:</span>
                    <span>{{ number_format($invoice->discount_amount, 2) ?? '' }}$</span>
                </div>
                <div class="total-row">
                    <span class="total-label total">Total:</span>
                    <span class="total">{{ number_format($invoice->total_amount, 2) ?? '' }}$</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
