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
                                                    <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->first_name }} {{ $customer->last_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <!-- Order Date -->
                                        <div class="col-md-3">
                                            <label>Order Date</label>
                                            <input type="date" name="order_date" value="{{ request('order_date') }}" class="form-control">
                                        </div>
                                
                                        <!-- Date Range -->
                                        <div class="col-md-3">
                                            <label>Date From</label>
                                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Date To</label>
                                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
                                        </div>
                                
                                        <!-- Total Amount Range -->
                                        <div class="col-md-3 mt-2">
                                            <label>Min Total</label>
                                            <input type="number" name="min_total" value="{{ request('min_total') }}" class="form-control">
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <label>Max Total</label>
                                            <input type="number" name="max_total" value="{{ request('max_total') }}" class="form-control">
                                        </div>
                                
                                        <!-- Filter & Reset Buttons -->
                                        <div class="col-md-3">
                                            <div class="row mt-3  align-items-center">
                                                <div class=" mt-4 mr-2">
                                                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                                                </div>
                                                <div class=" mt-4">
                                                    <a href="{{ route('admin.report.index') }}" class="btn btn-danger w-100">Reset</a>
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
                        <div id="OrderdataTableButtons" class="col-md-12" style="justify-content: space-between"></div>
                        
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
