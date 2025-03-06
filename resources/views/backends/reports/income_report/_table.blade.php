{{-- <style>
    .discount-status {
        position: absolute;
        margin-right: 10px;
    }
</style>
<div class="card-body py-0 table-wrapper">
    <table id="transactionTable" class="table table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Transaction Type') }}</th>
                <th>{{ __('Product Name') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Quantity') }}</th>
                <th>{{ __('Transaction Date') }}</th>
                <th>{{ __('Description') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->transaction_type }}</td>
                    <td>{{ $transaction->product->name ?? 'N/A' }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ $transaction->description }}</td>
                   
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-danger">{{ __('No records found') }}</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot class="" style="background-color: #D2D6DE;">
            <tr>
                <td colspan="3" class="text-right"></td>
                <td colspan="1"><strong>{{ __('Total: ') }} <span id="total">$0.00</span></strong></td>
                <td colspan="3"></td>
            </tr>
        </tfoot>
    </table>
</div> --}}
<div class="card-body py-0 table-wrapper">
    <table id="transactionTable" class="table table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Transaction Type') }}</th>
                <th>{{ __('Product Name') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Quantity') }}</th>
                <th>{{ __('Transaction Date') }}</th>
                <th>{{ __('Description') }}</th>
            </tr>
        </thead>
        <tbody>
          
        </tbody>
        <tfoot class="" style="background-color: #D2D6DE;">
            <tr>
                <td colspan="3" class="text-right"></td>
                <td colspan="1"><strong>{{ __('Total: ') }} <span id="totalincome">$0.00</span></strong></td>
                <td colspan="3"></td>
            </tr>
        </tfoot>
    </table>
</div>
