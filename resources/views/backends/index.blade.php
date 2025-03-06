@extends('backends.master')
@section('page_title')
    Admin Dashboard
@endsection
@push('css')
    <style>
        .amount {
            font-size: 40px !important;
            color: white;
            font-family: Arial, Helvetica, sans-serif;
        }

        h4 {
            font-family: Arial, Helvetica, sans-serif;
            color: rgb(87, 158, 255);
        }

        .summary-footer a {
            color: white;
        }

        .summary-footer a:hover {
            text-decoration: underline !important;
            color: white;
        }
    </style>
@endpush
@section('contents')
    <div class="section-body">
        <div class="col-md-12 ">
            <div class="row justify-content-center p-4 ">
                <div class="col-lg-3 col-sm-6">
                    <div
                        class="small-box bg-white d-flex p-3 justify-content-between align-items-center dashboard_summary_box dashboard_shadow">
                        <div class="rounded-circle bg-light p-2 d-flex" style="height: 70px; width: 70px;">
                            <img src="{{ asset('svgs/total_product.svg') }}" alt="not found">
                        </div>
                        <div class="inner text-right">
                            <h4>{{ $products->count() }}</h4>
                            <p class="m-0 text-uppercase">{{ __('Total Products') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div
                        class="small-box bg-white d-flex p-3 justify-content-between align-items-center dashboard_summary_box dashboard_shadow">
                        <div class="rounded-circle bg-light p-2 d-flex" style="height: 70px; width: 70px;">
                            <img src="{{ asset('svgs/total_order.svg') }}" alt="not found">
                        </div>
                        <div class="inner text-right">
                            {{-- <h3>{{ App\helpers\AppHelper::dashboardQuery()['total_event'] }}</h3> --}}
                            <h4>{{ $totalorder }}</h4>
                            <p class="m-0 text-uppercase">{{ __('Total Orders') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div
                        class="small-box bg-white d-flex p-3 justify-content-between align-items-center dashboard_summary_box dashboard_shadow">
                        <div class="rounded-circle bg-light p-1 d-flex align-items-center justify-content-center"
                            style="height: 70px; width: 70px;">
                            <img width="70%" height="70%" src="{{ asset('svgs/expense.png') }}" alt="not found">
                        </div>
                        <div class="inner text-right">
                            <h4>{{ $totalexpense }}$</h4>
                            <p class="m-0 text-uppercase">{{ __('Total Expense') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div
                        class="small-box bg-white d-flex p-3 justify-content-between align-items-center dashboard_summary_box dashboard_shadow">
                        <div class="rounded-circle bg-light p-2 d-flex align-items-center justify-content-center"
                            style="height: 70px; width: 70px;">
                            <img width="70%" height="70%" src="{{ asset('svgs/income.png') }}" alt="not found">
                        </div>
                        <div class="inner text-right">
                            <h4>{{ $totalincome }}$</h4>
                            <p class="m-0 text-uppercase">{{ __('Total Income') }}</p>
                        </div>
                    </div>
                </div>

                <section class=" col-md-12 ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i>
                                        {{ __('Top Products') }}
                                    </h3>
                                    <div class="card-tools d-flex">
                                        <select id="filterTopProducts" class="form-control form-control-sm">
                                            <option value="yesterday">{{ __('Yesterday') }}</option>
                                            <option value="today">{{ __('Today') }}</option>
                                            <option value="this_week">{{ __('This Week') }}</option>
                                            <option value="this_month" selected>{{ __('This Month') }}</option>
                                            <option value="this_year">{{ __('This Year') }}</option>
                                        </select>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="bar-chartTopProducts" style="height: 400px;"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i>
                                        {{ __('Profit') }}
                                    </h3>
                                    <div class="card-tools d-flex">
                                        <select class="form-control  form-control-sm" id="profitFilter">
                                            <option value="yesterday">{{ __('Yesterday') }}</option>
                                            <option value="today">{{ __('Today') }}</option>
                                            <option value="this_week">{{ __('This Week') }}</option>
                                            <option value="this_month" selected>{{ __('This Month') }}</option>
                                            <option value="this_year">{{ __('This Year') }}</option>
                                        </select>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="line-chart" style="height: 400px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            let chartTopProducts;

            function loadTopProductsChart(filter = 'this_month') {
                $.ajax({
                    url: "{{ route('admin.dashboard.topProductsChart') }}",
                    data: {
                        filter: filter
                    },
                    success: function(response) {
                        const ctx = document.getElementById('bar-chartTopProducts').getContext('2d');

                        if (chartTopProducts) {
                            chartTopProducts.destroy();
                        }

                        const maxValue = Math.max(...response.data) || 1;
                        const suggestedMax = maxValue < 5 ? 5 :
                            maxValue;

                        chartTopProducts = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: response.labels,
                                datasets: [{
                                    label: 'Top Products',
                                    data: response.data,
                                    backgroundColor: '#007bff',
                                    borderColor: '#0056b3',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        suggestedMax: suggestedMax
                                    }
                                }
                            }
                        });
                    }
                });
            }


            loadTopProductsChart();

            $('#filterTopProducts').on('change', function() {
                const filter = $(this).val();
                loadTopProductsChart(filter);
            });
        });
        $(document).ready(function() {
            let profitChart;

            function loadProfitChart(filter = 'this_month') {
                $.ajax({
                    url: "{{ route('admin.dashboard.profitChart') }}",
                    data: {
                        filter: filter
                    },
                    success: function(response) {
                        const ctx = document.getElementById('line-chart').getContext('2d');

                        if (profitChart) {
                            profitChart.destroy();
                        }

                        profitChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: response.labels,
                                datasets: [{
                                    label: 'Profit',
                                    data: response.data,
                                    borderColor: '#28a745',
                                    backgroundColor: 'rgba(40, 167, 69, 0.5)',
                                    fill: true,
                                    tension: 0.3,
                                    borderWidth: 2,
                                    pointRadius: 3,
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        suggestedMax: Math.max(...response.data) +
                                            10 
                                    }
                                }
                            }
                        });
                    },
                    error: function(xhr) {
                        console.log("Failed to load profit chart data", xhr.responseText);
                    }
                });
            }

            $(document).ready(function() {
                loadProfitChart();

                $('#profitFilter').on('change', function() {
                    loadProfitChart($(this).val());
                });
            });

        });
    </script>
@endpush
