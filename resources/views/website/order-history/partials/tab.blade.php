<ul class="nav nav-tabs custom-tabs" id="custom-tabs-four-tab" role="tablist">
    <li class="nav-item custom-nav-item">
        <a class="nav-link custom-nav-link @if (request()->routeIs('account.orderDetails')) active @endif" id="custom-tabs-four-home-tab"
            href="{{ route('account.orderDetails') }}">{{ __('Order Information') }}</a>
        <span class="tab-line"></span>
    </li>
    <li class="nav-item custom-nav-item">
        <a class="nav-link custom-nav-link @if (request()->routeIs('account.rateDetails')) active @endif"
            id="custom-tabs-for-language-tab" href="{{ route('account.rateDetails') }}"
            data-href="">{{ __('Rateing') }}</a>
        <span class="tab-line"></span>
    </li>
</ul>
