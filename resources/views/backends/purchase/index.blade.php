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
                    <h3>{{ __('Phurchase') }}</h3>
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
                                        <!-- Supplier Name -->
                                        <div class="col-md-3">
                                            <label>Supplier Name</label>
                                            <input type="text" name="supplier_name"
                                                value="{{ request('supplier_name') }}" class="form-control">
                                        </div>

                                        <!-- Product Name -->
                                        <div class="col-md-3">
                                            <label>Product Name</label>
                                            <input type="text" name="product_name" value="{{ request('product_name') }}"
                                                class="form-control">
                                        </div>

                                        <!-- Purchase Date -->
                                        <div class="col-md-3">
                                            <label>Purchase Date</label>
                                            <input type="date" name="purchase_date"
                                                value="{{ request('purchase_date') }}" class="form-control">
                                        </div>

                                        <!-- Date Range -->
                                        <div class="col-md-3">
                                            <label>Date From</label>
                                            <input type="date" name="date_from" value="{{ request('date_from') }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <label>Date To</label>
                                            <input type="date" name="date_to" value="{{ request('date_to') }}"
                                                class="form-control">
                                        </div>

                                        <!-- Purchase Status -->
                                        <div class="col-md-3 mt-2">
                                            <label>Purchase Status</label>
                                            <select name="purchase_status" class="form-control">
                                                <option value="">All</option>
                                                <option value="Pending"
                                                    {{ request('purchase_status') == 'Pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="Completed"
                                                    {{ request('purchase_status') == 'Completed' ? 'selected' : '' }}>
                                                    Completed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row mt-3  align-items-center">
                                                <div class=" mt-4 mr-2">
                                                    <a href="{{ route('admin.purchases.index') }}"
                                                        class="btn btn-danger w-100">Reset</a>
                                                </div>
                                                <div class=" mt-4">
                                                    <button type="submit" class="btn btn-primary w-100">Filter</button>
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
                                    <h3 class="card-title">{{ __('Phurchase List') }}</h3>
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
                            'Completed': 'btn-primary',
                            'Canceled': 'btn-danger'
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

        $(document).ready(function() {
            if ($('#purchaseTable').length && $('#purchaseTableButtons').length) {
                if ($.fn.DataTable.isDataTable('#purchaseTable')) {
                    $('#purchaseTable').DataTable().clear().destroy();
                    // $('#dataTable').empty();
                }
                setTimeout(function() {
                    let purchaseTable;
                    let actionColumnIndex = -1;
                    $('#purchaseTable thead th').each(function(index) {
                        let columnText = $(this).text().trim().toLowerCase();
                        if (columnText.includes('action')) {
                            actionColumnIndex = index;
                        }
                    });

                    purchaseTable = $('#purchaseTable').DataTable({
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

                    if ($('#purchaseTableButtons').length) {
                        $('.dataTables_length').prependTo('#purchaseTableButtons');
                        purchaseTable.buttons().container().appendTo('#purchaseTableButtons');
                        $('.dataTables_filter').appendTo('#purchaseTableButtons');
                    } else {
                        console.error("Div #purchaseTableButtons not found.");
                    }
                }, 100);

            } else {
                console.error("Table #dataTable or Div #purchaseTableButtons not found.");
            }
        });
    </script>
@endpush
