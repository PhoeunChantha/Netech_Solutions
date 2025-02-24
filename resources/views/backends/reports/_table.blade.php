<div class="card-body pt-0  table-wrapper">
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

    {{-- <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $reports->firstItem() }} {{ __('to') }} {{ $reports->lastItem() }}
                    {{ __('of') }} {{ $reports->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $reports->links() }}</div>
            </div>
        </div>
    </div> --}}
</div>
