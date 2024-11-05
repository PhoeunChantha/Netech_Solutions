@extends('website.profile.index')
@section('content')
    <style>
        .map-container,
        .container-ifram {
            height: 300px;
            border: 1px solid #ddd;
            position: relative;
        }

        .map-search-bar {
            position: absolute;
            width: 28rem;
            top: 10px;
            left: 14rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            padding: 4px 12px;
            z-index: 1;

        }
        .map-search-bar:hover {
            transform: scaleY(1.05);
            transition: transform 0.3s ease;
        }

        .map-search-bar i {
            color: #007bff;
            margin-right: 8px;
        }

        .map-search-bar input {
            flex-grow: 1;
            border: none;
            outline: none;
            padding: 8px;
            height: 30px;
        }

        .map-search-bar input::placeholder {
            color: #888;
        }

        .map-search-bar .search-icon {
            color: #888;
        }
    </style>
    <div class="container">
        <div class="card col-12">
            <div class="card-body col-12">
                <div class="mb-3">
                    <label for="addressSelect" class="form-label">Address</label>
                    <input disabled type="text" name="address" class="form-control" id="addressInput" placeholder="Home">
                </div>

                <div class="map-container mb-3 col-12">
                    <div class="map-search-bar">
                        <i class="bi bi-geo-alt-fill"></i>
                        <input type="text" id="addressInput" placeholder="Siem Reap Post Office, Pokambor Avenue, Siem Reap">
                        <i class="fa fa-search search-icon"></i>
                    </div>
                    <div class="container-ifram">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31523.899637106437!2d103.84665602102993!3d13.356252000000007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311016ebc52b930f%3A0xe0a55f157d3bbd0a!2sSiem%20Reap%20Post%20Office!5e0!3m2!1sen!2skh!4v1690567769655!5m2!1sen!2skh"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-primary float-end">update Address</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
