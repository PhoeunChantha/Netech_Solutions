@extends('website.app')
@section('content')
    @include('website.maps.map-style')

    <div class="content mt--3">
        <div class="container overflow-hidden">
            <div class="row mt-3">
                <div class="col-11">
                    <div class="card p-3"style="background: #CCFFFF">
                        <h4>Check Out</h4>
                        <span>Item 1</span>
                    </div>
                </div>
                <div class="card mt-1" style="width: 91%;">
                    <h3>Address</h3>
                    <div class="h">
                        <a class="a" href="#">Home</a>
                    </div>
                    <div id="p" class="card-body">
                        <iframe class="map"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d31055.654703122374!2d103.85489919999999!3d13.35296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1skm!2skh!4v1729177683120!5m2!1skm!2skh"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div id="b">
                        <button class="btn btn-info" style="width: 18%; color:aliceblue;">Add Address</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
