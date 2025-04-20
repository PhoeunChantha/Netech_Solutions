@extends('backends.master')
@section('page_title', __('Product Sell Report'))
@push('css')
    <style>
        .preview {
            margin-block: 12px;
            text-align: center;
        }

        .tab-pane {
            margin-top: 20px
        }

        @media print {
            .dataTable tfoot {
                display: table-footer-group !important;
            }

            .table-bordered tfoot td {
                border: 1px solid #dee2e6 !important;
            }
        }
    </style>
@endpush
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Sell Report') }}</h3>
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
                                            <label>{{ __('Customer') }}</label>
                                            <select name="customer_id" class="form-control sellreport-filter">
                                                <option value="">{{ __('All Customers') }}</option>
                                                <option value="walk-in">{{ __('Walk In Customer') }}</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}"
                                                        {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->first_name }} {{ $customer->last_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>{{ __('Payment Method') }}</label>
                                            <select name="payment_method" class="form-control sellreport-filter">
                                                <option value="">{{ __('Please Select') }}</option>
                                                <option value="Cash"
                                                    {{ request('payment_method') == 'Cash' ? 'selected' : '' }}>
                                                    {{ __('Cash') }}</option>
                                                <option value="Bank"
                                                    {{ request('payment_method') == 'Bank' ? 'selected' : '' }}>
                                                    {{ __('Bank') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>{{ __('Payment Status') }}</label>
                                            <select name="payment_status" class="form-control sellreport-filter">
                                                <option value="">{{ __('Please Select') }}</option>
                                                <option value="paid"
                                                    {{ request('payment_status') == 'paid' ? 'selected' : '' }}>
                                                    {{ __('Paid') }}</option>
                                                <option value="due"
                                                    {{ request('payment_status') == 'due' ? 'selected' : '' }}>
                                                    {{ __('Due') }}</option>
                                            </select>
                                        </div>
                                        <!-- Order Date -->
                                        <div class="col-md-3" hidden>
                                            <label>{{ __('Order Date') }}</label>
                                            <input type="text" name="order_date" class="form-control datepicker"
                                                value="{{ request('order_date') }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label>{{ __('Date Range') }}</label>
                                            <input type="text" name="date_range" id="daterangefilter"
                                                class="form-control daterangefilter" value="{{ request('date_range') }}">
                                        </div>

                                        <!-- Total Amount Range -->
                                        <div class="col-md-3 mt-2">
                                            <label>{{ __('Total Amount') }}</label>
                                            <select name="total_amount_range" class="form-control sellreport-filter">
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
                                        <div class="col-md-3 d-flex mt-3">
                                            <div class="div mt-4">
                                                <a href="{{ route('admin.report.index') }}"
                                                    class="btn btn-danger  btn-reset-report">{{ __('Reset') }}</a>
                                                {{-- <button type="submit"
                                                    class="btn btn-primary ml-2  btn-filter-report">{{ __('Filter') }}</button> --}}
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
    {{-- <script>
        $(document).on('click', '.clickable-row', function() {
            console.log($(this).data('href'));
            let url = $(this).data('href');

            if (url) {
                $("div.modal_form").load(url, function() {
                    $(this).modal('show');
                });
            }
        });
    </script> --}}
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
                    // scrollX: true,
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
                        url: "{{ route('admin.report.index') }}",
                        type: "GET",
                        data: function(d) {
                            d.customer_id = $('select[name="customer_id"]').val();
                            d.payment_status = $('select[name="payment_status"]').val();
                            d.payment_method = $('select[name="payment_method"]').val();
                            d.order_date = $('input[name="order_date"]').val();
                            d.date_range = $('input[name="date_range"]').val();
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
                            data: "created_at",
                            name: "created_at"
                        },
                        {
                            data: "order_number",
                            name: "order_number",
                        },

                        {
                            data: "customer_name",
                            name: "customer_name",
                            defaultContent: "-",
                        },

                        {
                            data: "order_quantity",
                            name: "order_quantity",
                        },
                        {
                            data: "payment_status",
                            name: "payment_status"
                        },
                        {
                            data: "payment_method",
                            name: "payment_method"
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
                        {
                            data: "action",
                            name: "action",
                            orderable: false,
                            searchable: false
                        },

                    ],
                    createdRow: function(row, data, dataIndex) {
                        $(row).attr('style', 'cursor: pointer;');
                        $(row).addClass('clickable-row');
                        $(row).attr('data-href', `/admin/report/report-detail/${data.id}`);
                    },
                    // footerCallback: function(row, data, start, end, display) {
                    //     var api = this.api();

                    //     var total = api.column(8).data().reduce(function(a, b) {
                    //         var numericValue = parseFloat(b.replace(/[^\d.-]/g, ''));
                    //         return a + numericValue;
                    //     }, 0);

                    //     $(api.column(8).footer()).html('$' + total.toFixed(2));
                    // },
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
                sellreportTable.on('click', '.clickable-row', function(e) {
                    if ($(e.target).closest('.btn-group, .dropdown-menu').length) {
                        return;
                    }
                    const url = $(this).data('href');
                    if (url) {
                        $("div.modal_form").load(url, function() {
                            $(this).modal('show');
                        });
                    }
                });
                $(document).on('click', '.btn-view', function(e) {
                    e.preventDefault();
                    console.log($(this).data('href'));
                    const url = $(this).data('href');
                    if (url) {
                        $("div.modal_form").load(url, function() {
                            $(this).modal('show');
                        });
                    }
                });

                $('#sellreportTable_filter input').on('keyup', function() {
                    sellreportTable.ajax.reload();
                });
                $('#daterangefilter').on('apply.daterangepicker', function(e, picker) {
                    sellreportTable.ajax.reload();
                });
                $('#daterangefilter').on('cancel.daterangepicker', function(e, picker) {
                    $(this).val('');
                    sellreportTable.ajax.reload();
                });
                $('.sellreport-filter').on('change keyup',
                    function(e) {
                        e.preventDefault();
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
                    $('input[name="date_range"]').val('');
                    $('select[name="total_amount_range"]').val('');
                    $('#sellreportTable_filter input').val('');
                    sellreportTable.ajax.reload();
                });
                $(document).on('click', '.btn-print', function(e) {
                    e.preventDefault();
                    const id = $(this).data('id');
                    let reportUrl = "{{ route('admin.report.print-report', ['id' => ':ID']) }}";
                    reportUrl = reportUrl.replace(':ID', id);

                    const printWindow = window.open(reportUrl, '_blank');
                    printWindow.onload = () => printWindow.print();
                    printWindow.onafterprint = () => {
                        printWindow.close();
                        window.location.href = "{{ route('admin.report.index') }}";
                    };
                });
                $(document).on('click', '.btn-delete', function(e) {
                    e.preventDefault();

                    const Confirmation = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });

                    Confirmation.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {

                            console.log(`.form-delete-${$(this).data('id')}`);
                            var data = $(`.form-delete-${$(this).data('id')}`).serialize();
                            // console.log(data);
                            $.ajax({
                                type: "post",
                                url: $(this).data('href'),
                                data: data,
                                // dataType: "json",
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 1) {
                                        sellreportTable.ajax.reload();
                                        toastr.success(response.msg);
                                    } else {
                                        toastr.error(response.msg)

                                    }
                                }
                            });
                        }
                    });
                });
            } else {
                console.error("Table #sellreportTable not found.");
            }
        });
    </script>
@endpush
