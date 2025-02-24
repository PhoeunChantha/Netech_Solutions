<style>
    .discount-status {
        position: absolute;
        margin-right: 10px;
    }
</style>
<div class="card-body py-0 table-wrapper">
    <table id="purchaseTable" class="table table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Supplier Name') }}</th>
                <th>{{ __('Product Name') }}</th>
                <th>{{ __('QTY') }}</th>
                <th>{{ __('Unit Cost') }}</th>
                <th>{{ __('Total Cost') }}</th>
                <th>{{ __('Phurchase Date') }}</th>
                <th>{{ __('Purchase Status') }}</th>
                {{-- <th>{{ __('Action') }}</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($purchases as $purchase)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $purchase->supplier->name }}</td>
                    <td>{{ $purchase->product->name }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>${{ number_format($purchase->unit_cost, 2) }}</td>
                    <td>${{ number_format($purchase->total_cost, 2) }}</td>
                    <td>{{ $purchase->purchase_date }}</td>
                    <td>
                        @php
                            $statusMapping = [
                                'Pending' => ['label' => 'Pending', 'class' => 'btn-warning'], // Yellow bg for pending
                                'Completed' => ['label' => 'Completed', 'class' => 'btn-primary'], // Blue bg for completed
                                'Canceled' => ['label' => 'Canceled', 'class' => 'btn-danger'], // Red bg for canceled
                            ];

                            $currentStatus = $purchase->purchase_status ?? 'Pending';
                            $statusText = $statusMapping[$currentStatus]['label'];
                            $statusClass = $statusMapping[$currentStatus]['class'];
                        @endphp

                        <div class="btn-group">
                            <button type="button" class="btn btn-sm {{ $statusClass }} dropdown-toggle status-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $statusText }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="javascript:void(0)"
                                        class="change_status pending-status dropdown-item {{ $currentStatus == 'Pending' ? 'active' : '' }}"
                                        data-id="{{ $purchase->id }}" data-status="Pending">
                                        Pending
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="change_status completed-status dropdown-item {{ $currentStatus == 'Completed' ? 'active' : '' }}"
                                        data-id="{{ $purchase->id }}" data-status="Completed">
                                        Completed
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="change_status canceled-status dropdown-item {{ $currentStatus == 'Canceled' ? 'active' : '' }}"
                                        data-id="{{ $purchase->id }}" data-status="Canceled">
                                        Canceled
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>

                    {{-- <td>
                        <div class="btn-group dropleft">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                id="actionDropdown{{ $purchase->id }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('Actions') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-left"
                                aria-labelledby="actionDropdown{{ $purchase->id }}">
                                <a href="#" class="dropdown-item btn-view" data-toggle="modal"
                                    data-target="#view-product{{ $purchase->id }}">
                                    <i class="fas fa-eye"></i> {{ __('View') }}
                                </a>

                                <a href="{{ route('admin.purchases.edit', $purchase->id) }}"
                                    class="dropdown-item btn-edit">
                                    <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                </a>

                                <form action="{{ route('admin.purchases.destroy', $purchase->id) }}"
                                    class="d-inline-block form-delete-{{ $purchase->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-id="{{ $purchase->id }}"
                                        data-href="{{ route('admin.purchases.destroy', $purchase->id) }}"
                                        class="dropdown-item btn-delete">
                                        <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                                    </button>
                                </form>
                                @if (auth()->user()->can('product.delete'))
                                @endif
                            </div>
                        </div>
                    </td> --}}
                </tr>
                
            @empty
                <tr>
                    <td colspan="8" class="text-center text-danger">{{ __('No data available') }}</td>
                </tr>
            @endforelse
          
        </tbody>
    </table>
   
    {{-- <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $purchases->firstItem() }} {{ __('to') }}
                    {{ $purchases->lastItem() }}
                    {{ __('of') }} {{ $purchases->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $purchases->links() }}</div>
            </div>
        </div>
    </div> --}}
</div>
