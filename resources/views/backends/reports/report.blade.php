@extends('backends.master')
@include('backends.reports.report_style')
@section('contents')
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
    <section class="content">
        <div class="container-fluid mt-4">
            <!-- Filters Section -->
            <div class="card p-3">
                <div class="card-title">
                    <h5 class="card-title mt-2 mb-2 text-primary">
                        <i class="fa-solid fa-filter"></i>
                        Filters
                    </h5>
                </div>
                <form>
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <label class="visually-hidden" for="specificSizeInputName">Search Product</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                                <input type="text" class="form-control" id="specificSizeInputName"
                                    placeholder="Search Product">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="visually-hidden" for="specificSizeSelect">Customer</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <select class="custom-select" id="specificSizeSelect">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label class="visually-hidden" for="specificSizeInputGroupDatetime">Date and Time</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <input type="datetime-local" class="form-control" id="specificSizeInputGroupDatetime">
                            </div>
                        </div>

                </form>
            </div>

            <!-- Tabs and Table Section -->
            <div class="card-body">
                <div class="mt-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Report List</a>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <!-- Show / Entries section -->
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mt-2 mb-0">Show</p>
                            <select class="custom-select ml-2 mr-2" id="specificSizeSelect">
                                <option selected>Choose...</option>
                                <option value="1">23</option>
                                <option value="2">34</option>
                                <option value="3">50</option>
                            </select>
                            <span class="mt-2">Entries</span>
                        </div>

                        <!-- Centered buttons -->
                        <div class="mx-auto">
                            <button class="btn btn-outline-secondary">
                                <i class="fa-solid fa-file-excel me-2"></i> Export to Excel
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa-solid fa-print me-2"></i> Print
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa-solid fa-file-pdf me-2"></i> Export to PDF
                            </button>
                        </div>

                        <!-- Search input -->
                        <div>
                            <form>
                                <div class="d-flex">
                                    <button class="btn btn-primary mr-2">Search</button>
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        style="width: 200px" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No.</th>
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Discount Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>Example Product</td>
                                        <td>{{ $report->customer_id}}</td>
                                        <td>{{ $report->order_number }}</td>
                                        <td>{{ $report->created_at->format('Y-m-d') }}</td>
                                        <td>10</td>
                                        <td>$50</td>
                                        <td>$45</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
