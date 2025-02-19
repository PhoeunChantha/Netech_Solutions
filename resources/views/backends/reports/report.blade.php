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

        .dataTables_wrapper .dataTables_paginate .paginate_button.first,
        .dataTables_wrapper .dataTables_paginate .paginate_button.last {
            display: none !important;
            /* Hide first and last pagination buttons */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #FFCEB1 !important;
            border: 1px solid #B04B00 !important;
            color: #B04B00 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #FFCEB1;
            border: 1px solid #B04B00;
            color: #B04B00 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #B04B00 !important;
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
                                <div class="row">
                                    <div class="col-6 ">
                                        <label for="customer_id">{{ __('Select Customer') }}</label>
                                        <select name="customer_id" id="customer_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">{{ __('Select Customer') }}</option>
                                            <option value="walk-in">{{ __('Walk In') }}</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->first_name }} {{ $customer->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="start_date">{{ __('Start Date') }}</label>
                                            <input type="date" id="start_date" class="form-control" name="start_date"
                                                value="{{ request('start_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="end_date">{{ __('End Date') }}</label>
                                            <input type="date" id="end_date" class="form-control" name="end_date"
                                                value="{{ request('end_date') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('admin.product.index') }}" class="btn btn-danger btn-lg">
                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                        {{ __('Reset') }}
                                    </a>
                                </div>
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
                        <div class="row mx-0 align-items-center" style="justify-content: space-between">
                            <div id="bookingTableButtons" class="col-md-12" style="justify-content: space-between"></div>
                        </div>
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
@endpush
