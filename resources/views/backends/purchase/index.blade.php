@extends('backends.master')
@section('page_title', __('Purchases'))
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
                    <h3>{{ __('Purchase') }}</h3>
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
                                <form method="GET" action="{{ route('admin.purchases.index') }}">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>{{ __('Supplier Name') }}</label>
                                            <input type="text" name="supplier_name"
                                                value="{{ request('supplier_name') }}" class="form-control purchase_filter">
                                        </div>

                                        <div class="col-md-3">
                                            <label>{{ __('Date Range') }}</label>
                                            <input type="text" name="date_range" id="daterangefilter"
                                                class="form-control daterangefilter " value="{{ request('date_range') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label>{{ __('Purchase Status') }}</label>
                                            <select name="purchase_status" class="form-control purchase_filter">
                                                <option value="">All</option>
                                                <option value="Pending"
                                                    {{ request('purchase_status') == 'Pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="Recieved"
                                                    {{ request('purchase_status') == 'Recieved' ? 'selected' : '' }}>
                                                    Recieved</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>{{ __('Payment Status') }}</label>
                                            <select name="Payment_status" class="form-control purchase_filter">
                                                <option value="">All</option>
                                                <option value="Paid"
                                                    {{ request('Payment_status') == 'Paid' ? 'selected' : '' }}>
                                                    Paid</option>
                                                <option value="Due"
                                                    {{ request('Payment_status') == 'Due' ? 'selected' : '' }}>
                                                    Due</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3" hidden>
                                            <div class="row mt-2  align-items-center">
                                                <div class="mt-4 mr-2">
                                                    <button class="btn btn-danger w-100 btn-reset">Reset</button>
                                                </div>
                                                <div class=" mt-4 ">
                                                    <button type="submit"
                                                        class="btn btn-primary w-100 btn-filter">Filter</button>
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
                                    <h3 class="card-title">{{ __('Purchase List') }}</h3>
                                </div>
                                {{-- <span class="badge bg-warning total-count">{{ $grades->total() }}</span> --}}
                                <div class="col-sm-6">
                                    <a class="btn btn-primary float-right" href="{{ route('admin.purchases.create') }}">
                                        <i class=" fa fa-plus-circle"></i>
                                        {{ __('Add New') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="row mx-0 px-2 align-items-center" style="justify-content: space-between">
                            <div id="purchaseTableButtons" class="col-md-12" style="justify-content: space-between"></div>
                        </div>
                        {{-- table --}}
                        @include('backends.purchase._table')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade modal_form" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

@endsection
@push('js')
    {{-- <script>
        $(document).on('click', '.detail-row', function() {
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
        $(document).on('click', '.change_status', function(e) {
            e.preventDefault();

            let status = $(this).data('status');
            let id = $(this).data('id');
            let button = $(this).closest('.btn-group').find('.status-dropdown');
            let dropdownMenu = $(this).closest('.dropdown-menu');

            $.ajax({
                type: "POST",
                url: "{{ route('admin.purchases.update_status') }}",
                data: {
                    id: id,
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === 1) {
                        toastr.success(response.msg);

                        let statusClasses = {
                            'Pending': 'btn-warning',
                            'Recieved': 'btn-primary disabled',
                            'Ordered': 'btn-danger'
                        };

                        button.removeClass('btn-warning btn-primary btn-danger')
                            .addClass(statusClasses[status])
                            .text(status);

                        dropdownMenu.find('.dropdown-item').removeClass('active');
                        dropdownMenu.find(`[data-status="${status}"]`).addClass('active');

                        button.dropdown('hide');
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error("Failed to update status.");
                }
            });
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
                                $('.table-wrapper').replaceWith(response.view);
                                toastr.success(response.msg);
                            } else {
                                toastr.error(response.msg)

                            }
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var purchaseTable;

            if ($('#purchaseTable').length) {
                if ($.fn.DataTable.isDataTable('#purchaseTable')) {
                    $('#purchaseTable').DataTable().clear().destroy();
                }

                purchaseTable = $('#purchaseTable').DataTable({
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
                        url: "{{ route('admin.purchases.index') }}",
                        type: "GET",
                        data: function(d) {
                            d.supplier_name = $('input[name="supplier_name"]').val();
                            d.product_name = $('input[name="product_name"]').val();
                            d.date_range = $('input[name="date_range"]').val();
                            d.purchase_status = $('select[name="purchase_status"]').val();
                            d.payment_status = $('select[name="Payment_status"]').val();
                            d.search_value = $('#purchaseTable_filter input').val();
                        },
                        dataSrc: function(json) {
                            const formatter = new Intl.NumberFormat('en-US', {
                                style: 'currency',
                                currency: 'USD',
                                minimumFractionDigits: 2
                            });

                            $('#totalpurchase').text(formatter.format(json.totalpurchase || 0));
                            $('#totalpurchasedue').text(formatter.format(json.totalpurchasedue || 0));
                            $('#totalpurchasepaid').text(formatter.format(json.totalpurchasepaid || 0));

                            return json.data;
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
                            data: "supplier.name",
                            name: "supplier.name",
                            defaultContent: "-"
                        },
                        {
                            data: "purchase_date",
                            name: "purchase_date"
                        },
                        {
                            data: "purchase_status",
                            name: "purchase_status"
                        },
                        {
                            data: "payment_status",
                            name: "payment_status",
                        },
                        {
                            data: "total_cost",
                            name: "total_cost"
                        },
                        {
                            data: "payment_due",
                            name: "payment_due"
                        },
                        {
                            data: "dollar_amount",
                            name: "dollar_amount"
                        },
                        {
                            data: "createdBy.name",
                            name: "createdBy.name",
                            defaultContent: "-"
                        },
                        {
                            data: "actions",
                            name: "actions",
                            orderable: false,
                            searchable: false,
                            className: 'actions-column'
                        }
                    ],
                    createdRow: function(row, data, dataIndex) {
                        $(row)
                            .addClass('detail-row')
                            .attr({
                                'style': 'cursor: pointer;',
                                'data-href': `{{ route('admin.purchases.purchase_detail', ':id') }}`
                                    .replace(':id', data.id)
                            });
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
                        },
                        processing: '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                    }
                });
                if ($('#purchaseTableButtons').length) {
                    $('.dataTables_length').prependTo('#purchaseTableButtons');
                    purchaseTable.buttons().container().appendTo('#purchaseTableButtons');
                    $('.dataTables_filter').appendTo('#purchaseTableButtons');
                } else {
                    console.error("Div #purchaseTableButtons not found.");
                }

                purchaseTable.on('click', '.detail-row', function(e) {
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
                $('.purchaseTable_filter input').on('change', function() {
                    purchaseTable.ajax.reload();
                });

                $('.purchase_filter').on('change keyup',
                    function(e) {
                        e.preventDefault();
                        purchaseTable.ajax.reload();
                    });
                $('#daterangefilter').on('apply.daterangepicker', function(e, picker) {
                    purchaseTable.ajax.reload();
                });
                $('#daterangefilter').on('cancel.daterangepicker', function(e, picker) {
                    $(this).val(''); 
                    purchaseTable.ajax.reload();
                });

                $('.btn-reset').on('click', function(e) {
                    e.preventDefault();
                    $('input[name="supplier_name"]').val('');
                    $('input[name="product_name"]').val('');
                    $('input[name="purchase_date"]').val('');
                    $('input[name="date_range"]').val('');
                    $('input[name="date_to"]').val('');
                    $('select[name="purchase_status"]').val('');
                    purchaseTable.ajax.reload();
                });
            } else {
                console.error("Table #purchaseTable not found.");
            }
        });
    </script>
@endpush
