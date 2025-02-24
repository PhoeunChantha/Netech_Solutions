@extends('backends.master')

@push('css')
    <style>
        .preview {
            margin-block: 12px;
            text-align: center;
        }

        .tab-pane {
            margin-top: 20px
        }
    </style>
@endpush
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Transactions') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="card-title"> <i class="fa fa-filter" aria-hidden="true"></i>
                                        {{ __('Filter') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="row">
                                    <form method="GET" action="{{ route('admin.transactions.index') }}" id="filter-form">
                                        <div class="row">
                                            <!-- Transaction Type -->
                                            <div class="col-md-3">
                                                <label>Transaction Type</label>
                                                <select name="transaction_type" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="income"
                                                        {{ request('transaction_type') == 'income' ? 'selected' : '' }}>
                                                        Income</option>
                                                    <option value="expense"
                                                        {{ request('transaction_type') == 'expense' ? 'selected' : '' }}>
                                                        Expense</option>
                                                </select>
                                            </div>

                                            <!-- Date Range -->
                                            <div class="col-md-3">
                                                <label>Date From</label>
                                                <input type="date" name="date_from" value="{{ request('date_from') }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Date To</label>
                                                <input type="date" name="date_to" value="{{ request('date_to') }}"
                                                    class="form-control">
                                            </div>

                                            <!-- Product Name -->
                                            <div class="col-md-3">
                                                <label>Product Name</label>
                                                <input type="text" name="product_name"
                                                    value="{{ request('product_name') }}" class="form-control">
                                            </div>

                                            <!-- Customer Name -->
                                            <div class="col-md-3 mt-2">
                                                <label>Customer Name</label>
                                                <input type="text" name="customer_name"
                                                    value="{{ request('customer_name') }}" class="form-control">
                                            </div>

                                            <!-- Supplier Name -->
                                            <div class="col-md-3 mt-2">
                                                <label>Supplier Name</label>
                                                <input type="text" name="supplier_name"
                                                    value="{{ request('supplier_name') }}" class="form-control">
                                            </div>

                                            <!-- Payment Method -->
                                            <div class="col-md-3 mt-2">
                                                <label>Payment Method</label>
                                                <select name="payment_method" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="cash"
                                                        {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash
                                                    </option>
                                                    <option value="credit_card"
                                                        {{ request('payment_method') == 'credit_card' ? 'selected' : '' }}>
                                                        Credit Card</option>
                                                    <option value="bank_transfer"
                                                        {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>
                                                        Bank Transfer</option>
                                                </select>
                                            </div>

                                            <!-- Amount Range -->
                                            <div class="col-md-3 mt-2">
                                                <label>Min Amount</label>
                                                <input type="number" name="min_amount" value="{{ request('min_amount') }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3 mt-2">
                                                <label>Max Amount</label>
                                                <input type="number" name="max_amount" value="{{ request('max_amount') }}"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-3">
                                                <div class="row align-items-center mt-3">
                                                    <div class="mt-4 mr-2">
                                                        <a href="{{ route('admin.transactions.index') }}" class="btn btn-danger w-100">Reset</a>
                                                    </div>
                                                    <div class="mt-4">
                                                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="card-title">{{ __('Transaction List') }}</h3>
                                </div>
                                {{-- <span class="badge bg-warning total-count">{{ $grades->total() }}</span> --}}

                            </div>
                        </div>
                        <div class="row mx-0 px-2 align-items-center" style="justify-content: space-between">
                            <div id="transactionTableButtons" class="col-md-12" style="justify-content: space-between"></div>
                        </div>
                        <!-- /.card-header -->
                        {{-- table --}}
                        @include('backends.transaction._table')

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade modal_form" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
@endsection
@push('js')
<script>
       $(document).ready(function() {
        if ($('#transactionTable').length && $('#transactionTableButtons').length) {
            if ($.fn.DataTable.isDataTable('#transactionTable')) {
                $('#transactionTable').DataTable().clear().destroy();
                // $('#dataTable').empty();
            }
            setTimeout(function() {
                let transactionTable;
                let actionColumnIndex = -1;
                $('#transactionTable thead th').each(function(index) {
                    let columnText = $(this).text().trim().toLowerCase();
                    if (columnText.includes('action')) {
                        actionColumnIndex = index;
                    }
                });

                transactionTable = $('#transactionTable').DataTable({
                    responsive: true,
                    dom: '<"d-flex justify-content-between align-items-center"lfB>rtip',
                    buttons: [{
                            extend: 'csv',
                            text: '<i class="fas fa-file-csv"></i> Export to CSV',
                            exportOptions: {
                                columns: ':visible:not(:last-child)'
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Export to Excel',
                            exportOptions: {
                                columns: ':visible:not(:last-child)'
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Print',
                            exportOptions: {
                                columns: ':visible:not(:last-child)'
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="fas fa-columns"></i> Column Visibility'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> Export to PDF',
                            exportOptions: {
                                columns: ':visible:not(:last-child)'
                            }
                        },
                    ],
                    columnDefs: actionColumnIndex !== -1 ? [{
                        orderable: false,
                        targets: actionColumnIndex
                    }] : [],
                    language: {
                        search: "",
                        searchPlaceholder: "Search..."
                    },
                    pagingType: "full_numbers"

                });

                if ($('#transactionTableButtons').length) {
                    $('.dataTables_length').prependTo('#transactionTableButtons');
                    transactionTable.buttons().container().appendTo('#transactionTableButtons');
                    $('.dataTables_filter').appendTo('#transactionTableButtons');
                } else {
                    console.error("Div #transactionTableButtons not found.");
                }
            }, 100);

        } else {
            console.error("Table #dataTable or Div #transactionTableButtons not found.");
        }
    });
</script>
@endpush
