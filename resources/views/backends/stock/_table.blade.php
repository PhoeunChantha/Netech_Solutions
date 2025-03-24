<div class="card-body py-0 table-wrapper">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                {{-- <th>Total Purchased</th> --}}
                <th>Total Ordered</th>
                <th>Stock Available</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock['code'] }}</td>
                    <td>{{ $stock['product_name'] }}</td>
                    {{-- <td>{{ $stock['total_purchased'] }}</td> --}}
                    <td>{{ $stock['total_ordered'] }}</td>
                    {{-- <td class="{{ $stock['stock_available'] <= 0 ? 'text-danger' : 'text-success' }}">
                        {{ $stock['stock_available'] }}
                    </td> --}}
                    <td class="{{ $stock['stock_available'] <= 0 ? 'text-danger' : 'text-success' }}">
                        {{ $stock['stock_available'] <= 0 ? 'Out of Stock' : $stock['stock_available'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $stocks->firstItem() }} {{ __('to') }} {{ $stocks->lastItem() }}
                    {{ __('of') }} {{ $stocks->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $stocks->links() }}</div>
            </div>
        </div>
    </div>
</div>
