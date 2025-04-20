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
        border-left: 4px solid #3dd598;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }
    
    /* Table styling */
    .table-report thead {
        background-color: #3057d5;
    }
    
    .table-report th {
        font-weight: 500;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
    
    /* Invoice info badges */
    .badge-status {
        padding: 0.35rem 0.75rem;
        font-weight: 500;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    
    .badge-paid {
        background-color: #3dd598;
        color: #ffffff;
    }
    
    .badge-pending {
        background-color: #ffb946;
        color: #ffffff;
    }
    
    /* Summary section */
    .invoice-summary {
        padding: 1rem;
        border-left: 4px solid #3dd598;
        background-color: #f8fdfa;
        border-radius: 0.375rem;
    }
    
    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
    }
    
    .summary-divider {
        margin: 0.5rem 0;
        border-top: 1px solid #e2e8f0;
    }
    
    .summary-total {
        font-weight: 600;
        font-size: 1rem;
        color: #2d3748;
    }
</style>

<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Invoice Details') }} #{{ $report->order_number }}</h5>
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    {{-- <div class="card shadow-sm ">
                        <div class="card-body">
                        </div>
                    </div> --}}
                    <ul class="list-group">
                        <li class="list-group-item py-2 border-0 d-flex justify-content-between align-items-center">
                            <strong>{{ __('Invoice No') }}:</strong>
                            <span>{{ $report->order_number }}</span>
                        </li>
                        <li class="list-group-item py-2 border-0 d-flex justify-content-between align-items-center">
                            <strong>{{ __('Customer') }}:</strong>
                            <span>{{ @$report->customer->first_name }} {{ @$report->customer->last_name }}</span>
                        </li>
                        <li class="list-group-item py-2 border-0 d-flex justify-content-between align-items-center">
                            <strong>{{ __('Payment Status') }}:</strong>
                            @if ($report->payment_status == 'paid')
                                <span class="badge badge-status badge-paid">{{ strtoupper($report->payment_status) }}</span>
                            @else
                                <span class="badge badge-status badge-pending">{{ strtoupper($report->payment_status) }}</span>
                            @endif
                        </li>
                        <li class="list-group-item py-2 border-0 d-flex justify-content-between align-items-center">
                            <strong>{{ __('Booking Date') }}:</strong>
                            <span>{{ $report->created_at->format('d M Y h:i A') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <fieldset class="border p-3">
                <legend class="text-uppercase">{{ __('Order Details') }}</legend>
                <div class="table-responsive">
                    <table class="table table-hover table-report">
                        <thead class="text-white">
                            <tr>
                                <th>{{ __('Item Name') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Unit Price') }}</th>
                                <th>{{ __('Discount') }}</th>
                                <th>{{ __('Total Amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ @$item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ format_currency($item->unit_price ?? '0.00') }}</td>
                                <td>{{ format_percentage($item->discount ?? '0.00')}}</td>
                                <td>{{ format_currency($item->price ?? '0.00')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
        
        <div class="modal-footer">
            <div class="row w-100">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="invoice-summary">
                        <div class="summary-item">
                            <strong>{{ __('Sub Total') }}:</strong>
                            <span>{{ format_currency($report->total_before_discount ?? '0.00') }}</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-item">
                            <strong>{{ __('Total Discount') }}:</strong>
                            <span>
                                @if ($report->discount_type == 'percent')
                                    {{ format_percentage($report->discount ?? '0.00') }}
                                @else
                                    {{ format_currency($report->discount_amount ?? '0.00') }}
                                @endif
                            </span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-item summary-total">
                            <strong>{{ __('Final Total') }}:</strong>
                            <span>{{ format_currency($report->total_amount ?? '0.00') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>