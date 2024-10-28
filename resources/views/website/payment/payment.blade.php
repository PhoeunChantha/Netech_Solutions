@extends('website.app')
@section('content')
    @include('website.payment.payment-style')
    <div class="content mt--3">
        <div class="container overflow-hidden">
            <div class="row mt-3">
                <div class="col-11">
                    <div class="card p-3"style="background: #CCFFFF;">
                        <h4>Check Out</h4>
                        <span>Item 1</span>
                    </div>
                </div>
                <div class="col-11">
                    <div class="card mt-4 p-3"style="background: white; margin-bottom: 150px;">
                        <form method="POST">
                            <div class="delivery-options">
                                <span>Delivery</span>
                                <h6 class="delivery">Select Delivery option To Proceed</h6>
                                <div class="frm-pay">
                                    <div class="p">
                                        <img src="/images/aba.png" class="pic" />
                                        <span class="s">Delivery by VET</span>
                                        <input type="radio" class="frm">
                                    </div>
                                    <div class="p">
                                        <img src="/images/about-img.jpg" class="pic" />
                                        <span class="s">Delivery by VET</span>
                                        <input type="radio" class="frm">
                                    </div>
                                </div>
                                <span >Payment</span>
                                <h6 class="delivery">Select Delivery option To Proceed</h6>
                                <div class="frm-pay">
                                    <div class="p">
                                        <img src="/images/aba.png" class="pic" />
                                        <span class="s">Delivery by VET</span>
                                        <input type="radio" class="frm">
                                    </div>
                                    <div class="p">
                                        <img src="/images/about-img.jpg" class="pic" />
                                        <span class="s">Delivery by VET</span>
                                        <input type="radio" class="frm">
                                    </div>
                                </div>
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
