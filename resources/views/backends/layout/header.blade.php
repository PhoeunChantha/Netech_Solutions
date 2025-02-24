<style>
    .img-circle {
        object-fit: cover;
    }
    .pos-style{
        padding: 3px 5px !important;
        background-color: green !important;
        color: white !important;
        /* font-size: 16px; */
    }
</style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.contact.index') }}" class="nav-link">Contact</a>
        </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" href="{{ route('home') }}" target="_blank">

                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">

                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>

                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                    <g id="SVGRepo_iconCarrier">
                        <path d="M4 15L20 15" stroke="#579eff" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M4 9L20 9" stroke="#579eff" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <circle cx="12" cy="12" r="9" stroke="#579eff" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"></circle>
                        <path
                            d="M12.0004 20.8182L11.2862 21.5181C11.4742 21.7101 11.7317 21.8182 12.0004 21.8182C12.2691 21.8182 12.5265 21.7101 12.7146 21.5181L12.0004 20.8182ZM12.0004 3.18188L12.7146 2.48198C12.5265 2.29005 12.2691 2.18188 12.0004 2.18188C11.7317 2.18188 11.4742 2.29005 11.2861 2.48198L12.0004 3.18188ZM14.6004 12.0001C14.6004 15.1611 13.3373 18.0251 11.2862 20.1183L12.7146 21.5181C15.1173 19.0662 16.6004 15.7053 16.6004 12.0001H14.6004ZM11.2861 3.88178C13.3373 5.97501 14.6004 8.83903 14.6004 12.0001H16.6004C16.6004 8.29478 15.1173 4.93389 12.7146 2.48198L11.2861 3.88178ZM9.40039 12.0001C9.40039 8.83903 10.6634 5.97501 12.7146 3.88178L11.2861 2.48198C8.88347 4.93389 7.40039 8.29478 7.40039 12.0001H9.40039ZM12.7146 20.1183C10.6634 18.0251 9.40039 15.1611 9.40039 12.0001H7.40039C7.40039 15.7053 8.88348 19.0662 11.2862 21.5181L12.7146 20.1183Z"
                            fill="#579eff"></path>
                    </g>

                </svg>
                {{ __('Go to website') }}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pos.index') }}" target="_blank"
                class="nav-link pos-style d-flex align-items-center justify-content-center @if (request()->routeIs('admin.pos')) active @endif">
                <i class="nav-icon fas fa-shopping-cart mr-1"></i>
                <p class="m-0">
                    {{ __('POS') }}
                </p>
            </a>
        </li>
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-headset"></i>
                <span style="right: 7px;top: 5px;" class="badge badge-warning navbar-badge">{{ $contactmail }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Message</span>
                <div class="dropdown-divider"></div>
                @foreach ($contacts as $mail)
                    <a href="{{ route('admin.contact.index') }}" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{ $mail->name }}
                        <span class="float-right text-muted text-sm">{{ $mail->created_at->format('D-M-Y H:i') }}</span>
                    </a>
                @endforeach
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.contact.index') }}" class="dropdown-item dropdown-footer">See All
                    Notifications</a>
            </div>
        </li> --}}
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="flag-icon flag-icon-{{ $current_locale == 'en' ? 'gb' : $current_locale }}"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                @foreach ($available_locales as $locale_name => $available_locale)
                    @if ($available_locale === $current_locale)
                        <a href="{{ route('change_language', $available_locale) }}"
                            class="dropdown-item text-capitalize active">
                            <i
                                class="flag-icon flag-icon-{{ $available_locale == 'en' ? 'gb' : $available_locale }} mr-2"></i>
                            {{ $locale_name }}
                        </a>
                    @else
                        <a href="{{ route('change_language', $available_locale) }}"
                            class="dropdown-item text-capitalize">
                            <i
                                class="flag-icon flag-icon-{{ $available_locale == 'en' ? 'gb' : $available_locale }} mr-2"></i>
                            {{ $locale_name }}
                        </a>
                    @endif
                @endforeach
            </div>
        </li>

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{-- <img src="{{ asset('uploads/default-profile.png') }}" class="user-image img-circle elevation-2"
                    alt="User Image"> --}}
                {{-- @if (Auth::user()->image)
                    <img class="user-image img-circle elevation-2 object-fit-cover "
                        src="{{ asset('uploads/users/' . Auth::user()->image) }}" alt="User Image">
                @else
                    <img class=" user-image img-circle elevation-2 object-fit-cover "
                        src="{{ asset('uploads/default-profile.png') }}" alt="Default Profile Image">
                @endif --}}
                @if (auth()->check() && auth()->user()->image)
                    <img class="user-image img-circle elevation-2 object-fit-cover"
                        src="{{ asset('uploads/users/' . auth()->user()->image) }}" alt="User Image">
                @else
                    <img class="user-image img-circle elevation-2 object-fit-cover"
                        src="{{ asset('uploads/default-profile.png') }}" alt="Default Profile Image">
                @endif

                {{-- <span class="d-none d-md-inline">veha</span> --}}
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <!-- User image -->
                <li class="user-header bg-primary">
                    {{-- <img src="{{ asset('uploads/default-profile.png') }}" class="img-circle elevation-2"
                        alt="User Image"> --}}
                    {{-- @if (Auth::user()->image)
                        <img class="img-circle elevation-2 object-fit-cover"
                            src="{{ asset('uploads/users/' . Auth::user()->image) }}" alt="User Image">
                    @else
                        <img class="img-circle elevation-2" src="{{ asset('uploads/default-profile.png') }}"
                            alt="Default Profile Image">
                    @endif --}}
                    @if (auth()->check() && auth()->user()->image)
                        <img class="user-image img-circle elevation-2 object-fit-cover"
                            src="{{ asset('uploads/users/' . auth()->user()->image) }}" alt="User Image">
                    @elseif (auth()->check())
                        <img class="user-image img-circle elevation-2 object-fit-cover"
                            src="{{ asset('uploads/default-profile.png') }}" alt="Default Profile Image">
                    @else
                        <img class="user-image img-circle elevation-2 object-fit-cover"
                            src="{{ asset('uploads/default-profile.png') }}" alt="Default Profile Image">
                    @endif


                    <p class="justify-content-center">
                        {{-- {{ Session::get('current_user')->name }} --}}
                        {{-- <h6>{{ Auth::user()->name }} | <small>Role :
                            {{ implode(', ', Auth::user()->roles()->pluck('name')->toArray()) }}</small></h6> --}}
                        {{-- <small>Member since {{ Auth::user()->created_at->format('d-M-Y') }}</small> --}}
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ auth('user')->check() ? route('admin.header.edit', auth('user')->user()->id) : route('admin.login') }}"
                        class="btn btn-primary btn-flat float-left">
                        <i class="fas fa-pencil-alt"></i>
                        {{ __('Edit') }}
                    </a>
                    {{-- @if (auth()->user() && auth()->user()->can('user.edit'))
                    @endif --}}
                    <a href="{{ route('admin.admin-logout') }}"
                        class="btn btn-default btn-flat float-right">{{ __('Sign out') }}</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
@push('js')
    {{-- <script>
        $(document).ready(function() {
            // Function to update unread count
            function updateUnreadCount() {
                $.ajax({
                    url: "{{ route('admin.unread.messages.count') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        // Update the unread count in the badge
                        $('.navbar-badge').text(response.unread_count);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching unread count:", error);
                    }
                });
            }

            // Initially fetch and update unread count with a delay
            setTimeout(function() {
                updateUnreadCount();
            }, 3000); // 3 seconds delay

            // Set interval to update unread count every 30 seconds (adjust as needed)
            setInterval(function() {
                updateUnreadCount();
            }, 15000); // 30 seconds interval
        });
    </script> --}}
@endpush
