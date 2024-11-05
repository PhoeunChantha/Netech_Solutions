@extends('website.profile.index')
@section('content')
    <div class="container order-detail-container card-outline card-outline-tabs">
        <div class="card p-4">
            <h4 class="fw-bold text-dark fs-5 mb-2">Order ID #100216 <span class="order-status">Processing</span></h4>
            <small>17th Jan, 2023 03:01 PM</small>
            @include('website.order-history.partials.tab')
            <div class="tab-content mt-3" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                    aria-labelledby="custom-tabs-four-home-tab">
                    <div class="mt-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="payment-info">
                                    <h6 class="label-text">Payment info</h6>
                                    <p>Payment status: <span class="payment-status">Not yet paid</span></p>
                                    <p>Payment Method: <span class="payment-method">Cash On Delivery</span></p>
                                    <p>Delivery type: <span class="delivery-type">Netcash solution shop</span></p>
                                </div>
                                <div class="address-info w-100">
                                    <h6 class="label-text">Address</h6>
                                    <div>
                                        <p>Name</p>
                                        <span class="float-right">: Micky Stilla</span>
                                    </div>
                                    <div>
                                        <p>Phone Number </p>
                                        <span class="float-right">: 092290584</span>
                                    </div>
                                    <div>
                                        <p>Address </p>
                                        <span class="float-right">: Siem Reap</span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-8">
                                <div class="product-info d-flex justify-content-between">
                                    <div class="col-md-6 d-flex align-items-center">
                                        <img src="https://via.placeholder.com/80" alt="Product Image"
                                            class="img-fluid rounded">
                                        <div>
                                            <span class="ml-3 fs-5">Acer desktop</span>
                                            <button class="btn btn-primary btn-rate mt-2" type="button" data-toggle="modal"
                                                data-target="#rating"><i
                                                    class="fa-regular fa-star-half-stroke mr-5"></i>{{ __('Rating') }}</button>
                                        </div>
                                    </div>
                                    <div class="d-flex text-center justify-content-center align-items-center col-md-2">
                                        Qty:<span class="text-primary" style="margin-left: 15px">1</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end col-md-4">
                                        <div class="price">$20.00</div>
                                    </div>
                                </div>
                                <div class="summary-info">
                                    <div>
                                        <p>Product </p><span>1</span>
                                    </div>
                                    <div>
                                        <p>Sub Total </p><span>$20.00</span>
                                    </div>
                                    <div>
                                        <p>Delivery Fee </p><span>$2.00</span>
                                    </div>
                                    <div>
                                        <p>Discount </p><span>$0.00</span>
                                    </div>
                                    <div>
                                        <h6 class="total">Total </h6><span class="price">$22.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('website.order-history.rating')
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.stars i').on('click', function() {
                let rating = $(this).data('value'); // Get the value of the clicked star
                $('.stars i').each(function() {
                    if ($(this).data('value') <= rating) {
                        $(this).removeClass('fa-regular').addClass('fa-solid filled');
                    } else {
                        $(this).removeClass('fa-solid filled').addClass('fa-regular');
                    }
                });
                $('#rating-value').text('Rating: ' + rating);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // When the icon is clicked, trigger the file input click
            $('.upload-placeholder').on('click', function() {
                $('#fileInput').click();
            });

            // When files are selected, compress and display each image
            $('#fileInput').on('change', function(event) {
                let files = event.target.files;
                for (let i = 0; i < files.length; i++) {
                    compressImage(files[i], 0.5, 100, function(compressedDataUrl) {
                        const imgElement = $('<img>').attr('src', compressedDataUrl).addClass(
                            'uploaded-image');
                        $('#imageContainer').append(imgElement); // Append each compressed image
                    });
                }
            });

            // Function to compress the image
            function compressImage(file, quality, maxSize, callback) {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(event) {
                    const img = new Image();
                    img.src = event.target.result;
                    img.onload = function() {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');

                        // Set canvas dimensions (resized to fit maxSize)
                        let width = img.width;
                        let height = img.height;
                        if (width > height) {
                            if (width > maxSize) {
                                height *= maxSize / width;
                                width = maxSize;
                            }
                        } else {
                            if (height > maxSize) {
                                width *= maxSize / height;
                                height = maxSize;
                            }
                        }
                        canvas.width = width;
                        canvas.height = height;

                        // Draw the image on the canvas
                        ctx.drawImage(img, 0, 0, width, height);

                        // Compress and get data URL
                        const compressedDataUrl = canvas.toDataURL('image/jpeg', quality);
                        callback(compressedDataUrl);
                    };
                };
            }
        });
    </script>
@endpush
