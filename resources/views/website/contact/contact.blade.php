@extends('website.app')
@section('contents')
    @include('website.contact.contact-style')
    <div class="content d-flex justify-content-center" style="min-height: 80vh;">
        <div class="col-9 card container-card border-0 px-4 mt-5 mb-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-5 container-form">
                    <div class="container-title">
                        <h3 class="fw-bold mb-0">We’d love to help</h3>
                        <p class="text-muted mt-0">We’re a full service agency with experts ready to help. We’ll get in touch
                            within 24 hours.</p>
                    </div>
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="first_name">{{ __('First name') }}</label>
                                <input type="text" name="first_name" id="contact_first_name" class="form-control"
                                    placeholder="First name">
                            </div>
                            <div class="form-group col-6 mt-1">
                                <label for="last_name">{{ __('Last name') }}</label>
                                <input type="text" name="last_name" id="contact_last_name" class="form-control"
                                    placeholder="Last name">
                            </div>
                            <div class="form-group col-12 mt-1">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="contact_email" class="form-control"
                                    placeholder="Email" required>
                            </div>
                            <div class="form-group col-12 mt-1">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="text" name="phone" id="contact_phone" class="form-control"
                                    placeholder="Phone number">
                            </div>
                            <div class="form-group col-12 mt-1">
                                <label for="message">{{ __('Message') }}</label>
                                <textarea name="message" id="contact_message" rows="3" class="form-control" placeholder="Message" required></textarea>
                            </div>
                            <div class="form-group sent-message mt-2 col-12">
                                <button type="submit" class="btn py-3 fw-bold text-white w-100"
                                    style="background-color: #1077B8;">{{ __('Send message') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-7 container-image">
                    <img src="{{ asset('/website/upload/img4.png') }}" alt="Contact Us Image">
                    <div class="text-image">
                        <div class="start">
                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                        </div>
                        <p class="mt-0 mb-0">
                            We’re starting off this list with our very own page. Help Scout's contact page shows how contact
                            us forms can help you provide an effortless support experience. The clean design and
                            well-organized layout of the page make it easy for visitors to find the help they need.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
