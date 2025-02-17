<style>
    .main-footer strong{
        font-weight: 500 !important;
    }
</style>
<footer class="main-footer text-start position-absolute bottom-auto w-100 px-5 pt-5 pb-3">
    {{-- <strong>{{ session()->get('copy_right_text') }}</strong> --}}
    <div class="col-12">
        <div class="row  justify-content-center">
            <div class="col-3 logo-circle">
                <div class="logo-container">
                    <img src="@if (session()->has('app_icon') && file_exists('uploads/business_settings/' . session()->get('app_icon'))) {{ asset('uploads/business_settings/' . session()->get('app_icon')) }} @else {{ asset('uploads/image/default.png') }} @endif"
                        alt="" width="60%" class="logo-footer">
                </div>
                <strong>{{ session()->get('app_name') }}</strong>
            </div>
            <div class="col-2">
                <strong class="footer-title">{{ __('Contact Us') }}</strong>
                <div class="icon d-flex flex-wrap">
                  
                    @foreach (json_decode($data['social_media'], true) as $social_media)
                        @if ($social_media['status'] == 1)
                            <a href="{{ $social_media['link'] }}" target="_blank" class="m-2">
                                <img src="{{ asset('uploads/social_media/' . $social_media['icon']) }}" alt="not found"
                                    width="45px">
                            </a>
                        @endif
                    @endforeach
                </div>
                <div class="conversation">
                    <span>{{ __('Start Conversation') }}</span>
                    <p>
                        <i class="fa fa-phone" style="color: #FFFFFF"></i>
                        <strong>+{{ session()->get('phone') }}</strong>
                    </p>
                </div>
            </div>
            <div class="col-4 text-center">
                <strong class="footer-title">{{ __('SPECIAL') }}</strong>
                <div class="col-3  text-special text-start mt-2 mx-auto">
                    <a href="">{{ __('Best selling') }}</a><br>
                    <a href="{{ route('category.show', ['slug' => 'desktop']) }}">{{ __('Latest Product') }}</a>
                    <a href="{{ route('privacy_policy') }}">{{ __('Privacy Policy') }}</a>
                    <a href="{{ route('term_condition') }}">{{ __('TermsCondition') }}</a>
                </div>
                <div class="email">
                    <hr style="border: 1.2px solid;">
                    <span>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <strong>{{ session()->get('email') }}</strong>
                    </span>
                </div>
            </div>

            <div class="col-3 text-center">
                <strong class="footer-title">{{ __('Categories') }}</strong>
                <div class="col-3 text-category text-start  mt-2 mx-auto">
                    @forelse ($categories as $category)
                        <a
                            href="{{ route('allcategory.show', ['slug' => $category->slug]) }}">{{ $category->name }}</a><br>
                    @empty
                        <p>{{ __('No categories available') }}</p>
                    @endforelse
                </div>
                <div class="address">
                    <div class="flex-row">
                        <span>{{ __('Address') }}</span>
                        <hr class="styled-hr">
                    </div>
                    <i class="fas fa-location    "></i>
                    <strong>{{ session()->get('company_address') }}</strong>
                    {{-- <span>Phum Prey Pring Khang Tboung 2, Sangkat Chom Chao 3, Khan, Pou Senchey, Phnom Penh</span> --}}
                </div>
            </div>
        </div>
        <hr style="border: 1.2px solid;">
        <div class="col-12 copy_right_text text-center">
            <strong>{{ session()->get('copy_right_text') }}</strong>
            {{-- <strong style="font-weight: 400">Copyright 2024 by NETTECH SOLUTION STORE.</strong> --}}
        </div>
    </div>
</footer>
