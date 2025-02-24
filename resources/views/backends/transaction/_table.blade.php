<style>
    .discount-status {
        position: absolute;
        margin-right: 10px;
    }
</style>
<div class="card-body py-0 table-wrapper">
    <table id="dataTable" class="table table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Transaction Type') }}</th>
                <th>{{ __('Purchase ID') }}</th>
                <th>{{ __('Order ID') }}</th>
                <th>{{ __('Product ID') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Quantity') }}</th>
                <th>{{ __('Transaction Date') }}</th>
                <th>{{ __('Description') }}</th>
                {{-- <th>{{ __('Action') }}</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->transaction_type }}</td>
                    <td>{{ $transaction->purchase->id ?? 'N/A' }}</td>
                    <td>{{ $transaction->order->id ?? 'N/A' }}</td>
                    <td>{{ $transaction->product->name ?? 'N/A' }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ $transaction->description }}</td>
                    {{-- <td>
                        <div class="btn-group dropleft">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                id="actionDropdown{{ $transaction->id }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('Actions') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-left"
                                aria-labelledby="actionDropdown{{ $transaction->id }}">
                                <a href="{{ route('admin.transactions.edit', $transaction->id) }}"
                                    class="dropdown-item btn-edit">
                                    <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                </a>
                                <form action="{{ route('admin.transactions.destroy', $transaction->id) }}"
                                    class="d-inline-block form-delete-{{ $transaction->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-id="{{ $transaction->id }}"
                                        data-href="{{ route('admin.transactions.destroy', $transaction->id) }}"
                                        class="dropdown-item btn-delete">
                                        <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                                    </button>
                                </form>
                                @if (auth()->user()->can('transaction.delete'))
                                @endif
                            </div>
                        </div>
                    </td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-danger">{{ __('No records found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- <div class="col-12 d-flex flex-row flex-wrap">
        <div class="row" style="width: -webkit-fill-available;">
            <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                {{ __('Showing') }} {{ $transactions->firstItem() }} {{ __('to') }}
                {{ $transactions->lastItem() }}
                {{ __('of') }} {{ $transactions->total() }} {{ __('entries') }}
            </div>
            <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $transactions->links() }}</div>
        </div>
    </div> --}}
</div>
