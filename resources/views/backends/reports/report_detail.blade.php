<style>
    .text-sm .select2-container--default .select2-selection--single,
    select.form-control-sm~.select2-container--default .select2-selection--single {
        height: 38px !important;
        align-content: center !important;
    }

    fieldset {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    legend {
        font-size: 15px !important;
    }

    .report-detail {
        padding: 5px;
        font-size: 15px;
        border: none !important;
        list-style: none !important;
        display: flex !important;
        align-items: center;
        justify-content: space-between;
    }

    .custom-background {
        border-radius: 5px;
        background-color: #9FE9C9 !important;
    }
</style>
<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Report Detail') }} : #{{ $report->order_number }}</h5>
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                {{-- <div class="col-6">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                            <strong>Invoice No : {{ $report->invoice_no }}</strong>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                            <strong>
                                @if ($report->order_status == 'request')
                                    Status : <span class="badge badge-danger p-2 text-uppercase"> {{ $report->order_status }} </span>
                                @else
                                    Status : <span class="badge badge-primary p-2 text-uppercase"> {{ $report->order_status }} </span>
                                @endif
                            </strong>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                            <strong>
                                @if ($report->payment_status == 'paid')
                                    Payment Status : <span class="badge badge-success p-2 text-uppercase"> {{ $report->payment_status }} </span>
                                @else
                                    Payment Status : <span class="badge badge-warning p-2 text-uppercase"> {{ $report->payment_status }} </span>
                                @endif
                            </strong>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                            <strong>
                                Booking Date : {{ $report->created_at->format('Y-m-d') }}
                            </strong>
                        </li>
                    </ul>
                </div> --}}
                {{-- <div class="col-6">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-end align-items-center">
                            <strong>Customer : {{ @$report->customer->first_name }}
                                {{ @$report->customer->last_name }}</strong>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-end align-items-center">
                            <strong>Email : {{ @$report->customer->email }}</strong>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-end align-items-center">
                            <strong>Phone : {{ @$report->customer->phone??'NA' }}</strong>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-end align-items-center">
                            @if (@$report->customer->city != null)
                                <strong>City : {{ @$report->customer->city??'NA' }}</strong>
                            @else
                                <strong>Address : {{ @$report->customer->address??'NA' }}</strong>
                            @endif
                        </li>
                    </ul>
                </div> --}}
                <div class="col-12">
                    <fieldset class="border p-3">
                        <legend class="w-auto text-uppercase">{{ __('Booking Detail') }}</legend>
                        <table class="table table-hover">
                            <thead class="text-uppercase text-white" style="background-color: #337AB7">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ format_currency($item->unit_price ?? '0.00') }}</td>
                                    <td>{{ format_percentage($item->discount ?? '0.00')}}</td>
                                    <td>{{ format_currency($item->price ?? '0.00')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-9"></div>
            <div class="col-3 custom-background p-3">
                <ul class="list-group w-100" style="float: right;">
                    <li class="report-detail">
                        <strong>Sub Total:</strong>
                        <div>
                            {{ format_currency($report->total_before_discount ?? '0.00') }}
                        </div>
                    </li>
                    <hr class="w-100 m-0" />
                    <li class="report-detail">
                        <strong> Total Discount: </strong>
                        <div>
                            {{ format_percentage($items->sum('discount') ?? '0.00') }}
                        </div>
                    </li>
                    <hr class="w-100 m-0" />
                    <li class="report-detail">
                        <strong>Final Total: </strong>
                        <div>
                            {{ format_currency($report->total_amount ?? '0.00') }}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
