<style>
    /* Base styling for select2 controls */
    .text-sm .select2-container--default .select2-selection--single,
    select.form-control-sm~.select2-container--default .select2-selection--single {
        height: 38px;
        display: flex;
        align-items: center;
        border-color: #dee2e6;
        border-radius: 0.25rem;
    }

    /* Fieldset styling */
    fieldset {
        border: 1px solid #e9ecef;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        border-radius: 0.375rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    /* Legend styling */
    legend {
        width: auto;
        padding: 0 0.5rem;
        font-size: 0.9375rem !important;
        font-weight: 600;
        color: #495057;
    }

    /* Report detail list items */
    .report-detail {
        padding: 0.625rem 0.25rem;
        font-size: 0.9375rem;
        border: none !important;
        list-style: none !important;
        display: flex !important;
        align-items: center;
        justify-content: space-between;
    }

    /* Custom background styling */
    .custom-background {
        border-radius: 0.375rem;
        background-color: #f8fdfa !important;
        border-left: 4px solid #3d97d5;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }
    
    /* Table styling */
    .purchase-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }
    
    .purchase-table thead {
        background-color: #3d85c6;
    }
    
    .purchase-table th {
        font-weight: 500;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.75rem;
        vertical-align: middle;
    }
    
    .purchase-table td {
        padding: 0.75rem;
        vertical-align: middle;
        border-top: 1px solid #f0f0f0;
    }
    
    .purchase-table tbody tr:hover {
        background-color: #f9fbfd;
    }
    
    /* Modal styling */
    .modal-content {
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #edf2f7;
        padding: 1rem 1.5rem;
    }
    
    .modal-title {
        font-weight: 600;
        color: #2d3748;
    }
    
    .modal-footer {
        border-top: 1px solid #edf2f7;
        padding: 1rem 1.5rem;
    }
    
    /* Badge styling */
    .badge-status {
        padding: 0.35rem 0.75rem;
        font-weight: 500;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border-radius: 0.25rem;
    }
    
    .badge-paid {
        background-color: #3dd598;
        color: #ffffff;
    }
    
    .badge-pending {
        background-color: #ffb946;
        color: #ffffff;
    }
    
    .badge-approved {
        background-color: #3dd598;
        color: #ffffff;
    }
    
    .badge-rejected {
        background-color: #f56565;
        color: #ffffff;
    }
    
    /* Info card */
    .info-card {
        /* background-color: #ffffff; */
        border-radius: 0.375rem;
        /* box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); */
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    
    /* Total section */
    .purchase-summary {
        padding: 1rem;
        border-left: 4px solid #3d97d5;
        background-color: #f8fdfa;
        border-radius: 0.375rem;
    }
    
    .total-amount {
        font-weight: 600;
        font-size: 1.125rem;
        color: #2d3748;
    }
    .summary-divider {
        margin: 0.5rem 0;
        border-top: 1px solid #e2e8f0;
    }
    
    /* Responsive improvements */
    @media (max-width: 767.98px) {
        .modal-footer {
            display: block;
        }
        
        .purchase-summary {
            margin-top: 1rem;
        }
    }
</style>

<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Purchase Details') }}</h5>
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="info-card">
                        {{-- <h6 class="mb-3">{{ __('Supplier Information') }}</h6> --}}
                        <ul class="list-group">
                            <li class="list-group-item py-2 border-0 d-flex justify-content-between align-items-center">
                                <strong>{{ __('Supplier Name') }}:</strong>
                                <span>{{ @$purchase->supplier->name }}</span>
                            </li>
                            <li class="list-group-item py-2 border-0 d-flex justify-content-between align-items-center">
                                <strong>{{ __('Contact') }}:</strong>
                                <span>{{ @$purchase->supplier->contact }}</span>
                            </li>
                            <li class="list-group-item py-2 border-0 d-flex justify-content-between align-items-center">
                                <strong>{{ __('Payment Status') }}:</strong>
                                @if ($purchase->payment_status == 'paid')
                                    <span class="badge badge-status badge-paid">{{ strtoupper($purchase->payment_status) }}</span>
                                @else
                                    <span class="badge badge-status badge-pending">{{ strtoupper($purchase->payment_status) }}</span>
                                @endif
                            </li>
                            <li class="list-group-item py-2 border-0 d-flex justify-content-between align-items-center">
                                <strong>{{ __('Payment Method') }}:</strong>
                                @if ($purchase->payment_method == 'Cash')
                                    <span class="badge badge-status badge-paid">{{__('Cash')}}</span>
                                @else
                                    <span class="badge badge-status badge-pending">{{__('Bank')}}</span>
                                @endif
                            </li>
                            <li class="list-group-item py-2 border-0 d-flex justify-content-between align-items-center">
                                <strong>{{ __('Purchase Date') }}:</strong>
                                <span>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y h:i A') }}</span>
                            </li>
                            <li class="list-group-item py-2 border-0 d-flex justify-content-between align-items-center">
                                <strong>{{ __('Status') }}:</strong>
                                <span class="info-value">
                                    @if($purchase->purchase_status == 'Recieved')
                                        <span class="badge badge-status badge-approved">{{ __('Received') }}</span>
                                    @elseif($purchase->purchase_status == 'Pending')
                                        <span class="badge badge-status badge-pending">{{ __('Pending') }}</span>
                                    @elseif($purchase->purchase_status == 'Ordered')
                                        <span class="badge badge-status badge-rejected">{{ __('Ordered') }}</span>
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <fieldset class="border p-3">
                        <legend class="w-auto text-uppercase">{{ __('Purchase Items') }}</legend>
                        <div class="table-responsive">
                            <table class="table table-hover purchase-table">
                                <thead class="text-uppercase text-white">
                                    <tr>
                                        <th>{{ __('Product Name') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Unit Price') }}</th>
                                        <th>{{ __('Sell Price') }}</th>
                                        <th>{{ __('Sub Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $item)
                                        <tr>
                                            <td>{{ $item->product->name ?? '' }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ format_currency($item->price ?? '0.00') }}</td>
                                            <td>{{ format_currency($item->sell_price ?? '0.00') }}</td>
                                            <td>{{ format_currency($item->price * $item->quantity ?? '0.00') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row w-100">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="purchase-summary">
                        <div class="report-detail total-amount">
                            <strong>{{ __('Payment Due') }}</strong>
                            <div>
                                {{ format_currency($details->sum('payment_due') ?? '0.00') }}
                            </div>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="report-detail total-amount">
                            <strong>{{ __('Total Amount') }}</strong>
                            <div>
                                {{ format_currency($details->sum('price') ?? '0.00') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>