{{-- <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
    @foreach (json_decode($language, true) as $lang)
        @if ($lang['status'] == 1)
            <li class="nav-item">
                <a class="nav-link text-capitalize {{ $lang['code'] == $default_lang ? 'active' : '' }}"
                    id="lang_{{ $lang['code'] }}-tab" data-lang="{{ $lang['code'] }}" data-toggle="pill"
                    href="#{{ @$tab_id }}_lang_{{ $lang['code'] }}" role="tab"
                    aria-controls="lang_{{ $lang['code'] }}"
                    aria-selected="false">{{ \App\helpers\AppHelper::get_language_name($lang['code']) . '(' . strtoupper($lang['code']) . ')' }}</a>
            </li>
        @endif
    @endforeach
</ul> --}}
