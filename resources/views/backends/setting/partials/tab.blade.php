<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link @if (request()->routeIs('admin.setting.index')) active @endif" id="custom-tabs-four-home-tab" href="{{ route('admin.setting.index') }}">{{ __('General Setting') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (request()->routeIs('admin.setting.language.index')) active @endif" id="custom-tabs-for-language-tab" href="{{ route('admin.setting.language.index') }}" data-href="">{{ __('Language') }}</a>
    </li>
</ul>
