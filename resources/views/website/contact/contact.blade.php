@extends('website.app')
@section('content')
    @include('website.contact.contact-style')
    <div class="content">
        <div class="col-9 mx-auto card p-4 my-4">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-6 container-form">
                    <div class="container-title">
                        <h3 class="fw-bold mb-0">We’d love to help</h3>
                        <p class="text-muted mt-0">We’d a full service agency with experts ready to help. We’ll get in touch
                            within 24 hours.</p>
                    </div>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="first_name">{{ __('First name') }}</label>
                            <input type="text" name="first_name" id="contact_first_name" class="form-control"
                                placeholder="Enter your first name">
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{ __('Last name') }}</label>
                            <input type="text" name="last_name" id="contact_last_name" class="form-control"
                                placeholder="Enter your last name">
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" name="email" id="contact_email" class="form-control"
                                placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input type="text" name="phone" id="contact_phone" class="form-control"
                                placeholder="Enter your phone number">
                        </div>
                        <div class="form-group">
                            <label for="message">{{ __('Message') }}</label>
                            <textarea name="message" id="contact_message" rows="3" class="form-control" placeholder="Enter your message"></textarea>
                        </div>
                        <div class="row px-3 mt-2">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </form>

                </div>
                <div class="col-6 container-image">
                    <img src="{{ asset('/website/upload/img4.png') }}" alt="not found">
                </div>
            </div>
        </div>
    </div>
@endsection
