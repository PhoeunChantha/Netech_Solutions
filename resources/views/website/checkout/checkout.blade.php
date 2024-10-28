@extends('website.app')
@section('content')
    @include('website.checkout.checkout-style')

    <div class="content mt--3">
        <div class="container overflow-hidden">
            <div class="row mt-3">
                <div class="col-11">
                    <div class="card p-3"style="background: #CCFFFF">
                        <h4>Check Out</h4>
                        <span>Item 1</span>

                    </div>
                </div>
                <div class="col-11 mt-3">
                    <div class="card p-3">
                        <div class="card-body">
                            <p class="card-title"> Customer Information</p>
                            <div class="form mt-4">
                                <form>
                                    <div class="row">
                                        <div class="form-group col-sm-6" style="width: 50%">
                                            <label class="control-label">First Name</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="First Name" />
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Last Name" />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="form-group col-md-2">
                                            <label class="control-label">Phone Number</label>
                                            <input type="tel"class="form-control form-control-lg" placeholder="+855" />
                                        </div>
                                        <div class="form-group col-md-10">
                                            <label class="control-label"></label>
                                            <input style="width: 39%" type="text" class="form-control form-control-lg"
                                                placeholder="Enter moblie Phone" />
                                        </div>

                                    </div>
                                    <div class="row mt-5">
                                        <div class="form-group col-md-8">
                                            <h6> Delivery Address</h6>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <button type="submit" class="btn btn-danger float-right"> <i
                                                    class="fa-solid fa-plus"></i> Add Address
                                            </button>

                                            <a href="#" class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                Save Changes
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton1">
                                                <div class="card">
                                                    <li><a class="dropdown-item text-capitalize active dropdown-item-primary"
                                                            href="#"><i class="fa-brands fa-telegram"></i> Home</a>
                                                    </li>
                                                </div>
                                                <div class="card">
                                                    <li><a class="dropdown-item text-capitalize dropdown-item-primary"
                                                            href="#"><i class="fa-brands fa-telegram"></i> Office</a>
                                                    </li>
                                                </div>
                                            </ul>

                                        </div>
                                    </div>
                                    <div class="check-out mt-2">
                                        <i class="fa-brands fa-telegram"></i>
                                            <a class="check-btn">
                                                <p>Home</p>
                                                <h5>Siem Reap</h5>
                                            </a>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
