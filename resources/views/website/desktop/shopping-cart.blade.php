@extends('website.app')
@section('contents')
    @include('website.desktop.shopping-cart-style')
    <div class="container p-0">
        <div class="col-12 p-4 shopping-card shadow-sm mt-5">
            <h3 class="fw-bold">Shopping Cart</h3>
            <span class="text-muted fs-5 shopping-card-item">11 items</span>
        </div>
        <div class="col-12">
            <div class="d-flex gap-3 justify-content-center">
                <div class="w-100 card">
                    <div class="card">
                        <div class="card-header card-header-right border-0">
                            <a class="d-flex align-items-center gap-2  float-end text-decoration-none" href="#">
                                <i class="fa-solid fa-trash-can" style="color: red;"></i>
                                Delete from cart
                            </a>
                        </div>
                        <div class="card-body ">
                            <div class="col-12">
                                <div class="row d-flex align-items-center p-3">
                                    {{-- <div class="product-card d-flex align-items-center"> --}}
                                    <div class="col-1 fload-end">
                                        <div class="form-check float-end top-0">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                        </div>
                                    </div>
                                    <div class="col-8 d-flex align-items-center">
                                        <div class="thumnail">
                                            <img src="\website\upload\image1.png" alt="">
                                        </div>
                                        <div class="product-info">
                                            <span class="text-muted">Apple</span>
                                            <h5 class="fw-bold">Acer desktop Series 5</h5>
                                            <a class="d-flex align-items-center gap-2 text-decoration-none" href="#">
                                                <i class="fa-solid fa-trash-can" style="color: red;"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="product-price text-end">
                                            <p class="text-muted text-decoration-line-through mb-0">$1200.00</p>
                                            <p class="fw-bold text-danger fs-4">$1200.00</p>
                                            <div class="counter float-end mt-1">
                                                <button class="button" id="decrement">-</button>
                                                <span class="count" id="count">1</span>
                                                <button class="button" id="increment">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card w-50 p-3">
                    <div class="container-proceed ">
                        <div class="div d-flex justify-content-between">
                            <p class="fw-bold fs-5">Sub Total:</p>
                            <p class="fw-bold fs-5">$1200.00</p>
                        </div>
                        <div class="div d-flex justify-content-between">

                            <p class="fw-bold fs-5">Dilivery Fee:</p>
                            <p class="fw-bold fs-5">$1200.00</p>
                        </div>
                        <div class="div d-flex justify-content-between">

                            <p class="fw-bold fs-5">Discount:</p>
                            <p class="fw-bold fs-5">$1200.00</p>
                        </div>
                        <hr>
                        <div class="div d-flex justify-content-between">

                            <p class="fw-bold fs-5">Total:</p>
                            <p  class="fw-bold text-danger fs-5">$1200.00</p>
                        </div>
                        <div  class="btn btn-primary btn-lg w-100 proceed-card">Proceed to Next</div>
                        <div class="div d-flex align-items-center justify-content-center gap-2 text-center p-2">
                            <i class="fa-solid fa-angle-left"></i>
                            <a style="color: #1077B8" href="#" class="text-decoration-none  fs-5 ">continue shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            let count = 1;

            $('#increment').on('click', function() {
                count++;
                $('#count').text(count);
            });

            $('#decrement').on('click', function() {
                if (count > 1) {
                    count--;
                    $('#count').text(count);
                }
            });
        });
    </script>
@endpush
