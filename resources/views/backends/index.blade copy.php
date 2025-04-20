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
    <style>
        #topProductsTableBody {
            /* height: 267px; */
            height: 345px;
            overflow-y: auto;
            display: block;

        }

        #topProductsTable thead,
        #topProductsTable tbody tr {
            display: table;
            width: 100%;
        }

        #topProductsTable th,
        #topProductsTable td {
            text-align: center;
            padding: 8px;
        }


        .animate-table tbody tr {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease-out;
            animation: fadeInTable 0.5s forwards;
            animation-delay: calc(var(--row-index) * 100ms);
        }

        @keyframes fadeInTable {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            opacity: 0;
            transform: translateY(15px);
            transition: all 0.3s ease-out;
            animation: fadeInGrid 0.5s forwards;
            animation-delay: calc(var(--card-index) * 100ms);
        }

        @keyframes fadeInGrid {
            0% {
                opacity: 0;
                transform: translateY(15px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .image-thumbnail {
            transition: transform 0.3s ease;
            border-radius: 8px;
            object-fit: cover;
        }

        .image-thumbnail:hover {
            transform: scale(1.1);
        }

        .product-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .product-card .card-img-top {
            height: 120px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        /* Button Toggle Styles */
        .view-toggle .btn.active {
            background-color: #0d6efd;
            color: white;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .summary-card {
            flex: 1 1 250px;
            margin: 10px;
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .card-content {
            display: flex;
            padding: 20px;
            justify-content: space-between;
            align-items: center;
            min-height: 100px;
        }

        .icon-container {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .products-icon {
            background: linear-gradient(45deg, #eaf2ff, #d8e7ff);
            color: #4285f4;
        }

        .orders-icon {
            background: linear-gradient(45deg, #e6f7ef, #d1f0e5);
            color: #34a853;
        }

        .expense-icon {
            background: linear-gradient(45deg, #ffeaea, #ffd6d6);
            color: #ea4335;
        }

        .income-icon {
            background: linear-gradient(45deg, #fff8e6, #fff2d1);
            color: #fbbc05;
        }

        .icon {
            font-size: 28px;
        }

        .info-container {
            text-align: right;
            padding-left: 15px;
        }

        .value {
            font-size: 28px;
            font-weight: 600;
            margin: 0 0 5px 0;
            color: #333;
        }

        .label {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
            color: #666;
            margin: 0;
        }

        .card-footer {
            padding: 10px 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            border-top: 1px solid #f0f0f0;
        }

        .trend {
            display: flex;
            align-items: center;
        }

        .trend.up {
            color: #34a853;
        }

        .trend.down {
            color: #ea4335;
        }

        .trend i {
            margin-right: 5px;
        }

        /* For the preview functionality */
        .preview-controls {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .preview-input {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }

        .input-group {
            flex: 1;
            min-width: 200px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }

        .input-group input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .update-btn {
            background-color: #4285f4;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .update-btn:hover {
            background-color: #3367d6;
        }

        @media (max-width: 768px) {
            .summary-card {
                flex: 1 1 calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .summary-card {
                flex: 1 1 100%;
            }
        }
    </style>
    <div class="section-body">
        <div class="col-md-12">
            <div class="row mx-auto justify-content-center p-3 align-items-center">
                {{-- <div class="col-lg-3 col-sm-6">
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
                </div> --}}
                <!-- Products Card -->
                <div class="summary-card">
                    <div class="card-content">
                        <div class="icon-container products-icon">
                            <i class="icon fas fa-box"></i>
                        </div>
                        <div class="info-container">
                            <h3 class="value" id="productValue">{{ $products }}</h3>
                            <p class="label">{{ __('Total Products') }}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="trend" id="productTrend">
                            <i class="fas fa-arrow-up"></i>
                            <span>Loading...</span>
                        </div>
                    </div>
                </div>
                <!-- Orders Card -->
                <div class="summary-card">
                    <div class="card-content">
                        <div class="icon-container orders-icon">
                            <i class="icon fas fa-shopping-cart"></i>
                        </div>
                        <div class="info-container">
                            <h3 class="value" id="orderValue">{{ $totalorder }}</h3>
                            <p class="label">{{ __('Total Orders') }}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="trend" id="orderTrend">
                            <i class="fas fa-arrow-up"></i>
                            <span>Loading...</span>
                        </div>
                    </div>
                </div>
                <!-- Expense Card -->
                <div class="summary-card">
                    <div class="card-content">
                        <div class="icon-container expense-icon">
                            <i class="icon fas fa-credit-card"></i>
                        </div>
                        <div class="info-container">
                            <h3 class="value" id="expenseValue">${{ $totalexpense }}</h3>
                            <p class="label">{{ __('Total Expense') }}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="trend" id="expenseTrend">
                            <i class="fas fa-arrow-down"></i>
                            <span>Loading...</span>
                        </div>
                    </div>
                </div>
                <!-- Income Card -->
                <div class="summary-card">
                    <div class="card-content">
                        <div class="icon-container income-icon">
                            <i class="icon fas fa-dollar-sign"></i>
                        </div>
                        <div class="info-container">
                            <h3 class="value" id="incomeValue">${{ $totalincome }}</h3>
                            <p class="label">{{ __('Total Income') }}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="trend" id="incomeTrend">
                            <i class="fas fa-arrow-up"></i>
                            <span>Loading...</span>
                        </div>
                    </div>
                </div>

                <!-- Add a button to manually refresh the dashboard if needed -->
                <div class="refresh-container">
                    <button id="refreshDashboard" class="btn btn-primary">
                        <i class="fas fa-sync-alt"></i> Refresh Dashboard
                    </button>
                </div>

                <section class=" col-md-12 mt-3">
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
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="tableView" class="table-responsive">
                                        <table id="topProductsTable" class="table table-hover animate-table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>{{ __('Image') }}</th>
                                                    <th>{{ __('Product Name') }}</th>
                                                    <th>{{ __('Sales') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="topProductsTableBody">
                                            </tbody>
                                        </table>
                                    </div>
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
        // $(document).ready(function() {
        //     function loadTopProductsTable(filter = 'this_month') {
        //         $.ajax({
        //             url: "{{ route('admin.dashboard.topProductsChart') }}",
        //             data: {
        //                 filter: filter
        //             },
        //             success: function(response) {
        //                 const tableBody = $('#topProductsTable tbody');
        //                 tableBody.empty();

        //                 if (response.data.length === 0) {
        //                     const noDataMessage = `
    //                         <div class="text-center d-flex flex-column align-items-center ">
    //                             <img class="example-image image-thumbnail" src="{{ asset('uploads/not-found.png') }}" 
    //                                 alt="default-thumbnail" width="100px" height="100px" />
    //                             <p>{{ __('No data available') }}</p>
    //                         </div>
    //                     `;
        //                     tableBody.html(noDataMessage);
        //                     return;
        //                 }

        //                 response.data.forEach((sales, index) => {
        //                     const imageUrl = response.images[index] ||
        //                         "{{ asset('uploads/not-found.png') }}";
        //                     const productName = response.labels[index];

        //                     const row = `<tr>
    //                         <td>
    //                             <a class="example-image-link image-container" href="${imageUrl}" data-fancybox="gallery-${productName}">
    //                                 <img class="example-image image-thumbnail" src="${imageUrl}" 
    //                                     alt="product-thumbnail" width="55px" height="55px" style="cursor:pointer" />
    //                             </a>
    //                         </td>
    //                         <td>${productName}</td>
    //                         <td class="text-center">${sales}</td>
    //                     </tr>`;

        //                     tableBody.append(row);
        //                 });
        //             }
        //         });
        //     }

        //     loadTopProductsTable();

        //     $('#filterTopProducts').on('change', function() {
        //         const filter = $(this).val();
        //         loadTopProductsTable(filter);
        //     });
        // });
        // $(document).ready(function() {
        //     let profitChart;

        //     function loadProfitChart(filter = 'this_month') {
        //         $.ajax({
        //             url: "{{ route('admin.dashboard.profitChart') }}",
        //             data: {
        //                 filter: filter
        //             },
        //             success: function(response) {
        //                 const ctx = document.getElementById('line-chart').getContext('2d');

        //                 if (profitChart) {
        //                     profitChart.destroy();
        //                 }

        //                 profitChart = new Chart(ctx, {
        //                     type: 'line',
        //                     data: {
        //                         labels: response.labels,
        //                         datasets: [{
        //                             label: 'Profit',
        //                             data: response.data,
        //                             // borderColor: '#28a745',
        //                             // backgroundColor: 'rgba(40, 167, 69, 0.5)',
        //                             fill: true,
        //                             // tension: 0.3,
        //                             // borderWidth: 2,
        //                             // pointRadius: 3,
        //                             backgroundColor: 'rgba(66, 133, 244, 0.2)',
        //                             borderColor: 'rgba(66, 133, 244, 1)',
        //                             borderWidth: 3,
        //                             pointBackgroundColor: 'rgba(66, 133, 244, 1)',
        //                             pointBorderColor: '#fff',
        //                             pointRadius: 5,
        //                             tension: 0.4
        //                         }]
        //                     },
        //                     options: {
        //                         responsive: true,
        //                         scales: {
        //                             y: {
        //                                 beginAtZero: true,
        //                                 suggestedMax: Math.max(...response.data) +
        //                                     10
        //                             }
        //                         }
        //                     }
        //                 });
        //                 const originalLineDraw = Chart.controllers.line.prototype.draw;
        //                 Chart.controllers.line.prototype.draw = function() {
        //                     const chart = this.chart;
        //                     const ctx = chart.ctx;
        //                     const area = chart.chartArea;

        //                     if (this._data.length > 0) {
        //                         ctx.save();

        //                         const gradient = ctx.createLinearGradient(0, area.top, 0, area
        //                             .bottom);
        //                         gradient.addColorStop(0, 'rgba(66, 133, 244, 0.4)');
        //                         gradient.addColorStop(1, 'rgba(66, 133, 244, 0.05)');

        //                         this.getDataset().backgroundColor = gradient;
        //                     }

        //                     originalLineDraw.apply(this, arguments);

        //                     if (this._data.length > 0) {
        //                         ctx.restore();
        //                     }
        //                 };
        //             },
        //             error: function(xhr) {
        //                 console.log("Failed to load profit chart data", xhr.responseText);
        //             }
        //         });
        //     }

        //     $(document).ready(function() {
        //         loadProfitChart();

        //         $('#profitFilter').on('change', function() {
        //             loadProfitChart($(this).val());
        //         });
        //     });

        // });
        $(document).ready(function() {
            // ===== TOP PRODUCTS TABLE FUNCTIONALITY =====
            function loadTopProductsTable(filter = 'this_month') {
                const tableBody = $('#topProductsTableBody');
                tableBody.html(
                    '<tr><td colspan="3" class="text-center"><i class="fas fa-spinner fa-spin me-2"></i> Loading...</td></tr>'
                );

                $.ajax({
                    url: "{{ route('admin.dashboard.topProductsChart') }}",
                    data: {
                        filter: filter
                    },
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        tableBody.empty();

                        if (!response.data || response.data.length === 0) {
                            const noDataMessage = `
                        <tr>
                            <td colspan="3">
                                <div class="empty-state">
                                    <img src="{{ asset('uploads/not-found.png') }}" alt="No data" width="100px" height="100px" />
                                    <p>{{ __('No data available') }}</p>
                                </div>
                            </td>
                        </tr>
                    `;
                            tableBody.html(noDataMessage);
                            return;
                        }

                        response.data.forEach((sales, index) => {
                            const imageUrl = response.images && response.images[index] ?
                                response.images[index] :
                                "{{ asset('uploads/not-found.png') }}";
                            const productName = response.labels[index];
                            const animationDelay = index * 0.1;

                            const row = `<tr style="animation-delay: ${animationDelay}s">
                        <td>
                            <a class="example-image-link" href="${imageUrl}" data-fancybox="gallery-products">
                                <img class="image-thumbnail" src="${imageUrl}" 
                                    alt="product-thumbnail" width="55px" height="55px" />
                            </a>
                        </td>
                        <td>${productName}</td>
                        <td class="text-center fw-bold">${sales}</td>
                    </tr>`;

                            tableBody.append(row);
                        });

                        $('[data-fancybox]').fancybox({
                            buttons: ['close'],
                            loop: true,
                            protect: true
                        });
                    },
                    error: function(xhr, status, error) {
                        tableBody.html(`
                    <tr>
                        <td colspan="3">
                            <div class="empty-state">
                                <i class="fas fa-exclamation-circle text-danger mb-3" style="font-size: 2rem;"></i>
                                <p>{{ __('Error loading data. Please try again.') }}</p>
                            </div>
                        </td>
                    </tr>
                `);
                        console.error("Failed to load top products data:", error);
                    }
                });
            }

            // ===== PROFIT CHART FUNCTIONALITY =====
            let profitChart;

            function loadProfitChart(filter = 'this_month') {
                // Add loading indicator to chart container
                $('#profitChartBody').append(
                    '<div id="chart-loader" class="text-center py-5"><i class="fas fa-spinner fa-spin me-2"></i> Loading chart data...</div>'
                );

                $.ajax({
                    url: "{{ route('admin.dashboard.profitChart') }}",
                    data: {
                        filter: filter
                    },
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#chart-loader').remove();

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
                                    fill: true,
                                    backgroundColor: 'rgba(66, 133, 244, 0.2)', // Will be replaced with gradient
                                    borderColor: 'rgba(66, 133, 244, 1)',
                                    borderWidth: 3,
                                    pointBackgroundColor: 'rgba(66, 133, 244, 1)',
                                    pointBorderColor: '#fff',
                                    pointRadius: 5,
                                    pointHoverRadius: 7,
                                    tension: 0.4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                                        titleColor: '#333',
                                        bodyColor: '#666',
                                        bodyFont: {
                                            size: 14,
                                            weight: 'bold'
                                        },
                                        padding: 12,
                                        borderColor: '#eaeaea',
                                        borderWidth: 1,
                                        displayColors: false,
                                        callbacks: {
                                            label: function(context) {
                                                return `Profit: $${context.parsed.y}`;
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        suggestedMax: Math.max(...response.data) + 10,
                                        grid: {
                                            color: 'rgba(0, 0, 0, 0.05)',
                                            drawBorder: false
                                        },
                                        ticks: {
                                            callback: function(value) {
                                                return '$' + value;
                                            },
                                            font: {
                                                size: 12
                                            }
                                        }
                                    },
                                    x: {
                                        grid: {
                                            display: false
                                        },
                                        ticks: {
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                                interaction: {
                                    intersect: false,
                                    mode: 'index'
                                }
                            }
                        });

                        const chartArea = profitChart.chartArea;
                        const ctx2 = profitChart.ctx;
                        const gradient = ctx2.createLinearGradient(0, chartArea.top, 0, chartArea
                            .bottom);
                        gradient.addColorStop(0, 'rgba(66, 133, 244, 0.4)');
                        gradient.addColorStop(1, 'rgba(66, 133, 244, 0.05)');

                        profitChart.data.datasets[0].backgroundColor = gradient;
                        profitChart.update();
                    },
                    error: function(xhr, status, error) {
                        $('#chart-loader').remove();

                        $('#profitChartBody').html(`
                    <div class="empty-state">
                        <i class="fas fa-exclamation-circle text-danger mb-3" style="font-size: 2rem;"></i>
                        <p>{{ __('Error loading chart data. Please try again.') }}</p>
                    </div>
                `);
                        console.error("Failed to load profit chart data:", error);
                    }
                });
            }

            // ===== INITIALIZATION AND EVENT HANDLERS =====

            loadTopProductsTable();
            loadProfitChart();

            $('#filterTopProducts').on('change', function() {
                loadTopProductsTable($(this).val());
            });

            $('#profitFilter').on('change', function() {
                loadProfitChart($(this).val());
            });

            $('.btn-tool').on('click', function() {
                const icon = $(this).find('i');
                if (icon.hasClass('fa-minus')) {
                    icon.removeClass('fa-minus').addClass('fa-plus');
                } else {
                    icon.removeClass('fa-plus').addClass('fa-minus');
                }
            });

            $('#topProductsBody, #profitChartBody').on('shown.bs.collapse', function() {
                if ($(this).attr('id') === 'topProductsBody') {
                    loadTopProductsTable($('#filterTopProducts').val());
                } else {
                    loadProfitChart($('#profitFilter').val());
                }
            });
        });
        // $(document).ready(function() {
        //     fetchDashboardStats();

        //     $('#refreshDashboard').click(function() {
        //         $(this).find('i').addClass('fa-spin');
        //         fetchDashboardStats();
        //         setTimeout(function() {
        //             $('#refreshDashboard').find('i').removeClass('fa-spin');
        //         }, 1000);
        //     });

        //     setInterval(fetchDashboardStats, 300000);

        //     function fetchDashboardStats() {
        //         $.ajax({
        //             url: '{{ route('admin.dashboard.stats') }}',
        //             type: 'GET',
        //             dataType: 'json',
        //             success: function(data) {
        //                 updateValueWithAnimation('#productValue', data.productsCount);
        //                 updateValueWithAnimation('#orderValue', data.totalorder);
        //                 updateValueWithAnimation('#expenseValue', '$' + data.totalexpense);
        //                 updateValueWithAnimation('#incomeValue', '$' + data.totalincome);
        //                 // Update trends
        //                 updateTrend('productTrend', data.productTrend);
        //                 updateTrend('orderTrend', data.orderTrend);
        //                 updateTrend('expenseTrend', data.expenseTrend);
        //                 updateTrend('incomeTrend', data.incomeTrend);
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('Error fetching dashboard stats:', error);
        //             }
        //         });
        //     }

        //     function updateValueWithAnimation(selector, newValue) {
        //         const $element = $(selector);
        //         const currentValue = $element.text().replace('$', '');

        //         if (currentValue != newValue) {
        //             $element.addClass('updated');
        //             $element.text(newValue);
        //             setTimeout(function() {
        //                 $element.removeClass('updated');
        //             }, 1500);
        //         }
        //     }

        //     function updateTrend(elementId, trendValue) {
        //         const $trend = $('#' + elementId);

        //         if (trendValue > 0) {
        //             $trend.removeClass('down neutral').addClass('up');
        //             $trend.find('i').removeClass('fa-arrow-down fa-minus').addClass('fa-arrow-up');
        //             $trend.find('span').text(trendValue + '% from last month');
        //         } else if (trendValue < 0) {
        //             $trend.removeClass('up neutral').addClass('down');
        //             $trend.find('i').removeClass('fa-arrow-up fa-minus').addClass('fa-arrow-down');
        //             $trend.find('span').text(Math.abs(trendValue) + '% from last month');
        //         } else {
        //             $trend.removeClass('up down').addClass('neutral');
        //             $trend.find('i').removeClass('fa-arrow-up fa-arrow-down').addClass('fa-minus');
        //             $trend.find('span').text('No change from last month');
        //         }
        //     }
        // });
    </script>
@endpush
