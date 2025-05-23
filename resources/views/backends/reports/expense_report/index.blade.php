@extends('backends.master')
@section('page_title', 'Purchase Report')
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
                    <h3>{{ __('Purchase Report') }}</h3>
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
                                <form method="GET" action="{{ route('admin.expense-report.expense') }}" id="filter-form">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>{{ __('Product Name') }}</label>
                                            <input type="text" name="product_name" value="{{ request('product_name') }}"
                                                class="form-control transaction-filter">
                                        </div>
                                        <div class="col-md-3">
                                            <label>{{ __('Date Range') }}</label>
                                            <input type="text" name="date_range" id="daterangefilter"
                                                class="form-control daterangefilter" value="{{ request('date_range') }}">
                                        </div>


                                        <div class="col-md-3">
                                            <label>{{ __('Total Amount') }}</label>
                                            <select name="transaction_amount_range" class="form-control transaction-filter">
                                                <option value="">All</option>
                                                <option value="0-100"
                                                    {{ request('transaction_amount_range') == '0-100' ? 'selected' : '' }}>
                                                    0 -
                                                    100</option>
                                                <option value="100-500"
                                                    {{ request('transaction_amount_range') == '100-500' ? 'selected' : '' }}>
                                                    100
                                                    - 500</option>
                                                <option value="500-1000"
                                                    {{ request('transaction_amount_range') == '500-1000' ? 'selected' : '' }}>
                                                    500
                                                    - 1000</option>
                                                <option value="1000-3000"
                                                    {{ request('transaction_amount_range') == '1000-3000' ? 'selected' : '' }}>
                                                    1000 - 3000</option>
                                                <option value="3000-5000"
                                                    {{ request('transaction_amount_range') == '3000-5000' ? 'selected' : '' }}>
                                                    3000 - 5000</option>
                                                <option value="5000-"
                                                    {{ request('transaction_amount_range') == '5000-' ? 'selected' : '' }}>
                                                    5000+
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <div class="row align-items-center">
                                                <div class="mt-4 mr-2">
                                                    <button type="button"
                                                        class="btn btn-danger btn-reset-transaction">Reset</button>
                                                </div>
                                                {{-- <div class="mt-4">
                                                    <button type="submit"
                                                        class="btn btn-primary w-100 btn-filter-transaction">Filter</button>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="card-title">{{ __('Report List') }}</h3>
                                </div>
                                {{-- <span class="badge bg-warning total-count">{{ $grades->total() }}</span> --}}

                            </div>
                        </div>
                        <div class="row mx-0 px-2 align-items-center" style="justify-content: space-between">
                            <div id="transactionTableButtons" class="col-md-12" style="justify-content: space-between">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        {{-- table --}}
                        @include('backends.reports.expense_report._table')
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
                                columns: ':visible',
                                modifier: {
                                    page: 'current'
                                }
                            },
                            footer: true,
                            customize: function(win) {
                                $(win.document.body).css('font-size', '10pt');
                                $(win.document.body).find('table').addClass('table table-bordered');

                                var footer = $(win.document.body).find('tfoot');
                                footer.show();
                                footer.css({
                                    'font-weight': 'bold',
                                    'background-color': '#D2D6DE',
                                    'text-align': 'right'
                                });

                                $(win.document.body).css({
                                    'padding': '10mm',
                                    'margin': '0'
                                });
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
                        }
                    ],
                    ajax: {
                        url: "{{ route('admin.expense-report.expense') }}",
                        type: "GET",
                        data: function(d) {
                            d.transaction_amount_range = $(
                                'select[name="transaction_amount_range"]').val();
                            d.product_name = $('input[name="product_name"]').val();
                            d.customer_name = $('input[name="customer_name"]').val();
                            d.date_range = $('input[name="date_range"]').val();
                            d.search_value = $('#purchaseTable_filter input').val();
                        },
                        error: function(xhr, error, thrown) {
                            console.log("AJAX Error:", xhr.responseText);
                        }
                    },
                    columns: [{
                            data: null,
                            name: "id",
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart +
                                    1;
                            }
                        },
                        {
                            data: "transaction_date",
                            name: "transaction_date"
                        },
                        
                        {
                            data: "product_name",
                            name: "product_name",
                            defaultContent: "-"
                        },

                        {
                            data: "quantity",
                            name: "quantity"
                        },
                        {
                            data: "transaction_type",
                            name: "transaction_type"
                        },
                        {
                            data: "amount",
                            name: "amount"
                        },
                        {
                            data: "description",
                            name: "description"
                        },
                    ],
                    drawCallback: function(settings) {
                        if (settings.json && settings.json.totalexpense !==
                            undefined) {
                            $('#totalexpense').text('$' + parseFloat(settings
                                .json.totalexpense).toFixed(2));
                        } else {
                            $('#totalexpense').text('$0.00');
                        }
                    },
                    language: {
                        search: "",
                        searchPlaceholder: "Search...",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "No entries available",
                        paginate: {
                            next: "Next",
                            previous: "Previous"
                        }
                    },

                });

                if ($('#transactionTableButtons').length) {
                    $('.dataTables_length').prependTo('#transactionTableButtons');
                    transactionTable.buttons().container().appendTo('#transactionTableButtons');
                    $('.dataTables_filter').appendTo('#transactionTableButtons');
                } else {
                    console.error("Div #transactionTableButtons not found.");
                }
                $('#transactionTable_filter input').on('keyup', function() {
                    transactionTable.ajax.reload();
                });

                $('.transaction-filter').on('change keyup', function(e) {
                    e.preventDefault();
                    transactionTable.ajax.reload();
                });
                $('#daterangefilter').on('apply.daterangepicker', function(e, picker) {
                    transactionTable.ajax.reload();
                });
                $('#daterangefilter').on('cancel.daterangepicker', function(e, picker) {
                    $(this).val('');
                    transactionTable.ajax.reload();
                });

                $('.btn-reset-transaction').on('click', function(e) {
                    e.preventDefault();
                    $('select[name="transaction_amount_range"]').val('');
                    $('input[name="product_name"], input[name="customer_name"], input[name="date_range"]')
                        .val('');
                    $('#transactionTable_filter input').val('');
                    transactionTable.ajax.reload();
                });


            } else {
                console.error("Table #dataTable or Div #transactionTableButtons not found.");
            }
        });
    </script>
@endpush
