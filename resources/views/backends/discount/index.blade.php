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
    <style>
        /* Table styling */
        .discountTable {
            width: 100% !important;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Make sure the dropdown actions are visible */
        .btn-group.dropleft .dropdown-menu {
            z-index: 1001;
        }

        /* DataTable buttons styling */
        .dt-buttons .btn {
            margin-right: 5px;
        }

        /* Custom pagination styling */
        .dataTables_paginate .paginate_button {
            padding: 0.25rem 0.5rem;
            margin-left: 2px;
            border-radius: 3px;
        }

        .dataTables_paginate .paginate_button.current {
            background: #007bff !important;
            border-color: #007bff !important;
            color: white !important;
        }

        /* Processing indicator positioning */
        .dataTables_processing {
            background: rgba(255, 255, 255, 0.9);
            z-index: 1000;
        }

        /* Custom filter elements */
        .discount_filter {
            margin-bottom: 10px;
        }

        /* Status toggle switch improvements */
        .custom-switch {
            display: flex;
            justify-content: center;
        }
    </style>
@endpush
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Discount') }}</h3>
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
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="card-title">{{ __('Discount List') }}</h3>
                                </div>
                                <div class="col-sm-6">
                                    @if (auth()->user()->can('discount.create'))
                                        <a class="btn btn-primary float-right" href="{{ route('admin.discount.create') }}">
                                            <i class=" fa fa-plus-circle"></i>
                                            {{ __('Add New') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0 px-2 align-items-center" style="justify-content: space-between">
                            <div id="discountTableButtons" class="col-md-12" style="justify-content: space-between"></div>
                        </div>
                        @include('backends.discount._table')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            if ($('#discountTable').length) {
                if ($.fn.DataTable.isDataTable('#discountTable')) {
                    $('#discountTable').DataTable().clear().destroy();
                }

                var discountTable = $('#discountTable').DataTable({
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
                        url: "{{ route('admin.discount.index') }}",
                        type: "GET",
                        data: function(d) {
                            d.search_value = $('#discountTable_filter input').val();
                        },
                        dataType: "json",
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
                            data: "name",
                            name: "name"
                        },
                        {
                            data: "product_names",
                            name: "product_names",

                        },
                        {
                            data: "discount_value",
                            name: "discount_value"
                        },
                        {
                            data: "start_date",
                            name: "start_date"
                        },
                        {
                            data: "end_date",
                            name: "end_date"
                        },
                        {
                            data: "quantity",
                            name: "quantity"
                        },
                        {
                            data: "createdBy.name",
                            name: "createdBy.name",
                            defaultContent: "-"
                        },
                        {
                            data: "status",
                            name: "status",
                        },
                        {
                            data: "actions",
                            name: "actions",
                            orderable: false,
                            searchable: false,
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
                if ($('#discountTableButtons').length) {
                    $('.dataTables_length').prependTo('#discountTableButtons');
                    discountTable.buttons().container().appendTo('#discountTableButtons');
                    $('.dataTables_filter').appendTo('#discountTableButtons');
                } else {
                    console.error("Div #discountTableButtons not found.");
                }


                $('.discountTable_filter input').on('change', function() {
                    discountTable.ajax.reload();
                });

                $('.discount_filter').on('change keyup',
                    function(e) {
                        e.preventDefault();
                        discountTable.ajax.reload();
                    });
                $('#daterangefilter').on('apply.daterangepicker', function(e, picker) {
                    discountTable.ajax.reload();
                });
                $('#daterangefilter').on('cancel.daterangepicker', function(e, picker) {
                    $(this).val('');
                    discountTable.ajax.reload();
                });

                $('.btn-reset').on('click', function(e) {
                    e.preventDefault();

                    discountTable.ajax.reload();
                });
                $(document).on('change', 'input.status', function() {
                    $.ajax({
                        type: "get",
                        url: "{{ route('admin.discount.update_status') }}",
                        data: {
                            "id": $(this).data('id')
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 1) {
                                toastr.success(response.msg);
                            } else {
                                toastr.error(response.msg);
                            }
                        }
                    });
                });
            } else {
                console.error("Table #discountTable not found.");
            }
        });
    </script>
    <script>
        $('.custom-file-input').change(function(e) {
            var reader = new FileReader();
            var preview = $(this).closest('.form-group').find('.preview img');
            console.log(preview);
            reader.onload = function(e) {
                preview.attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
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
@endpush
