@extends('backends.master')
@include('backends.invoice.invoice_style');
@section('contents')
<div class="layout-container">
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

</div>
<script>
    function printFile() {
        window.location.href = "{{ route('invoice') }}";
    }
</script>
@endsection
