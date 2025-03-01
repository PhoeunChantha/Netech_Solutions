{{-- <div class="card-body pt-0  table-wrapper">
    <table id="OrderdataTable" class="table table-hover">
        <thead>
            <tr>
                <th>Invoice No.</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th>Discount</th>
                <th>Total before discount</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr style="cursor: pointer;" class="clickable-row" data-href="{{ route('admin.report.report-detail', $report->id) }}">
                    <td data-id="{{ $report->id }}" data-href="{{ route('admin.report.report-detail', $report->id) }}"
                        class="clickable-spa">
                        {{ $report->order_number }}
                    </td>
                    <td>{{ $report->customer_id }}</td>
                    <td>{{ $report->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if ($report->discount_type == 'percent')
                            {{ $report->discount ?? '0.00'}}%
                        @else
                            {{ $report->discount ?? '0.00'}}$
                        @endif
                    </td>
                    <td>{{ $report->total_before_discount }}</td>
                    <td>{{ $report->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}
<div class="card-body pt-0  table-wrapper">
    <table id="sellreportTable" class="table table-hover">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th>Discount</th>
                <th>Total before discount</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
        <tfoot class="" style="background-color: #D2D6DE;">
            <tr>
                <td colspan="5" class="text-right"></td>
                <td colspan="1"><strong>{{ __('Total: ') }} <span id="totalamount">$0.00</span></strong></td>
            </tr>
        </tfoot>
    </table>
</div>
