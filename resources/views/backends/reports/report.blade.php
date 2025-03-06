@extends('backends.master')
@section('page_title', __('Sales Report'))
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
                    <h3>{{ __('Report') }}</h3>
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
                                <form method="GET" action="{{ route('admin.report.index') }}">
                                    <div class="row">
                                        <!-- Customer Filter -->
                                        <div class="col-md-3">
                                            <label>Customer</label>
                                            <select name="customer_id" class="form-control">
                                                <option value="">All Customers</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}"
                                                        {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->first_name }} {{ $customer->last_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Order Date -->
                                        <div class="col-md-3">
                                            <label>Order Date</label>
                                            <input type="date" name="order_date" value="{{ request('order_date') }}"
                                                class="form-control">
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

                                        <!-- Total Amount Range -->
                                        <div class="col-md-3 mt-2">
                                            <label>Total Amount</label>
                                            <select name="total_amount_range" class="form-control">
                                                <option value="">All</option>
                                                <option value="0-100"
                                                    {{ request('total_amount_range') == '0-100' ? 'selected' : '' }}>0 -
                                                    100</option>
                                                <option value="100-500"
                                                    {{ request('total_amount_range') == '100-500' ? 'selected' : '' }}>100
                                                    - 500</option>
                                                <option value="500-1000"
                                                    {{ request('total_amount_range') == '500-1000' ? 'selected' : '' }}>500
                                                    - 1000</option>
                                                <option value="1000-3000"
                                                    {{ request('total_amount_range') == '1000-3000' ? 'selected' : '' }}>
                                                    1000 - 3000</option>
                                                <option value="3000-5000"
                                                    {{ request('total_amount_range') == '3000-5000' ? 'selected' : '' }}>
                                                    3000 - 5000</option>
                                                <option value="5000-"
                                                    {{ request('total_amount_range') == '5000-' ? 'selected' : '' }}>5000+
                                                </option>
                                            </select>
                                        </div>

                                        <!-- Filter & Reset Buttons -->
                                        <div class="col-md-3">
                                            <div class="row mt-3  align-items-center">
                                                <div class=" mt-4 mr-2">
                                                    <button type="submit"
                                                        class="btn btn-primary w-100 btn-filter-report">Filter</button>
                                                </div>
                                                <div class=" mt-4">
                                                    <a href="{{ route('admin.report.index') }}"
                                                        class="btn btn-danger w-100 btn-reset-report">Reset</a>
                                                </div>
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
                            </div>
                        </div>
                        <div id="sellreportTableButtons" class="col-md-12" style="justify-content: space-between"></div>

                        <!-- /.card-header -->

                        {{-- table --}}
                        @include('backends.reports._table')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade modal_form" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
@endsection
@push('js')
    <script>
        $(document).on('click', '.clickable-row', function() {
            console.log($(this).data('href'));
            let url = $(this).data('href');

            if (url) {
                $("div.modal_form").load(url, function() {
                    $(this).modal('show');
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            var sellreportTable;
            if ($('#sellreportTable').length) {
                if ($.fn.DataTable.isDataTable('#sellreportTable')) {
                    $('#sellreportTable').DataTable().clear().destroy();
                }

                sellreportTable = $('#sellreportTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    destroy: true,
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
                    ajax: {
                        url: "{{ route('admin.report.index') }}",
                        type: "GET",
                        data: function(d) {
                            d.customer_id = $('select[name="customer_id"]').val();
                            d.order_date = $('input[name="order_date"]').val();
                            d.date_from = $('input[name="date_from"]').val();
                            d.date_to = $('input[name="date_to"]').val();
                            d.total_amount_range = $('select[name="total_amount_range"]').val();
                            d.search_value = $('#sellreportTable_filter input').val();
                        },
                        dataSrc: function(json) {
                            $('#totalamount').text('$' + parseFloat(json.totalamount).toFixed(2));
                            return json.data;
                        },
                        error: function(xhr, error, thrown) {
                            console.log("AJAX Error:", xhr.responseText);
                        }
                    },
                    columns: [{
                            data: "order_number",
                            name: "order_number",
                        },
                        {
                            data: "customer_name",
                            name: "customer_name",
                            defaultContent: "-",
                        },
                        {
                            data: "created_at",
                            name: "created_at"
                        },
                        {
                            data: "discount",
                            name: "discount"
                        },
                        {
                            data: "total_before_discount",
                            name: "total_before_discount"
                        },
                        {
                            data: "total_amount",
                            name: "total_amount"
                        },

                    ],
                    createdRow: function(row, data, dataIndex) {
                        $(row).attr('style', 'cursor: pointer;');
                        $(row).addClass('clickable-row');
                        $(row).attr('data-href', `/admin/report/report-detail/${data.id}`);
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
                    drawCallback: function(settings) {
                        var total = settings.json.totalCost;
                        $('#totalCost').text('$' + parseFloat(total).toFixed(2));
                    }
                });

                if ($('#sellreportTableButtons').length) {
                    $('.dataTables_length').prependTo('#sellreportTableButtons');
                    sellreportTable.buttons().container().appendTo('#sellreportTableButtons');
                    $('.dataTables_filter').appendTo('#sellreportTableButtons');
                } else {
                    console.error("Div #sellreportTableButtons not found.");
                }

                $('#sellreportTable_filter input').on('keyup', function() {
                    sellreportTable.ajax.reload();
                });

                $('.btn-filter-report').on('click', function(e) {
                    e.preventDefault();
                    sellreportTable.ajax.reload();
                });

                $('.btn-reset-report').on('click', function(e) {
                    e.preventDefault();
                    $('select[name="customer_id"]').val('');
                    $('input[name="order_date"]').val('');
                    $('input[name="date_from"]').val('');
                    $('input[name="date_to"]').val('');
                    $('select[name="total_amount_range"]').val('');
                    $('#sellreportTable_filter input').val('');
                    sellreportTable.ajax.reload();
                });

            } else {
                console.error("Table #sellreportTable not found.");
            }
        });
    </script>
@endpush
