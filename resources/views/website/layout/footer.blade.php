<style>
    /* @media (min-width: 1279px) {
        .main-footer {
            bottom: auto;
        }
    } */

    /* .main-footer {
        padding: .7rem;
    } */
</style>

<footer class="main-footer text-start position-absolute bottom-auto w-100 px-5 pt-5 pb-3">
    {{-- <strong>{{ session()->get('copy_right_text') }}</strong> --}}
    <div class="col-12">
        <div class="row  justify-content-center">
            <div class="col-3 logo-circle">
                <div class="logo-container">
                    <img src="\website\upload\image 307.png" alt="not found" class="logo-footer">
                </div>
                <strong>NETTECH SOLUTION STORE</strong>
            </div>
            <div class="col-2">
                <strong class="footer-title">{{ __('Contact Us') }}</strong>
                <div class="icon d-flex gap-2">
                    <a href="http://">
                        <img src="\website\upload\telegram.png" alt="not found">
                    </a>
                    <a href="http://">
                        <img src="\website\upload\facebook.png" alt="not found">
                    </a>
                    <a href="http://">
                        <img src="\website\upload\call.png" alt="not found">
                    </a>
                </div>
                <div class="conversation">
                    <span>{{ __('Start Conversation') }}</span>
                    <p>
                        <i class="fa fa-phone" style="color: #FFFFFF"></i>
                        +85592290584
                    </p>
                </div>
            </div>
            <div class="col-4 text-center">
                <strong class="footer-title">{{ __('SPECIAL') }}</strong>
                <div class="col-3 px-1 text-special text-start mt-2 mx-auto">
                    <a href="">{{ __('Best selling') }}</a><br>
                    <a href="">{{ __('Latest Product') }}</a>
                </div>
                <div class="email">
                    <hr style="border: 1.2px solid;">
                    <span>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        {{ __('phoeunchantha@gmail.com') }}
                    </span>
                </div>
            </div>

            <div class="col-3 text-center">
                <strong class="footer-title">{{ __('Categories') }}</strong>
                <div class="col-3 px-1 text-category text-start  mt-2 mx-auto">
                    <a href="">{{ __('Desktop') }}</a><br>
                    <a href="">{{ __('Laptop') }}</a><br>
                    <a href="">{{ __('Accessories') }}</a><br>
                    <a href="">{{ __('Services') }}</a>
                </div>
                <div class="address">
                    <div class="flex-row">
                        <span>{{ __('Address') }}</span>
                        <hr class="styled-hr">
                    </div>
                    <i class="fas fa-location    "></i>
                    <span>Phum Prey Pring Khang Tboung 2, Sangkat Chom Chao 3, Khan, Pou Senchey, Phnom Penh</span>
                </div>
            </div>
        </div>
        <hr style="border: 1.2px solid;">
        <div class="col-12 copy_right_text text-center">
            {{-- <strong>{{ session()->get('copy_right_text') }}</strong> --}}
            <strong style="font-weight: 400">Copyright 2024 by NETTECH SOLUTION STORE.</strong>
        </div>
    </div>
</footer>
