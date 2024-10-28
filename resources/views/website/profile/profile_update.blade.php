@extends('website.profile.index')
@section('content')
    <div class="profile-card-detail">
        <h2 class="profile-title">Profile</h2>
        <form id="profileForm" class="profile-form" action="{{ route('account.profile.update', auth()->user()->id) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="profile-pic-container">
                <img src="@if ($user->image && file_exists(public_path('uploads/users/' . $user->image))) {{ asset('uploads/users/' . $user->image) }}
                                              @else
                                                  {{ asset('uploads/default-profile.png') }} @endif"
                    alt="Profile" class="profile-pic">
                <input type="file" id="profile-image" name="image" style="display: none;"
                    accept="image/png, image/jpeg">
                <div class="upload-icon">
                    <i class="fas fa-camera"></i>
                </div>
                <h3>{{ $user->name }}</h3>
            </div>
            <div class="form-row">
                <div class="form-group ">
                    <label for="first-name">First Name</label>
                    <input name="first_name" type="text" id="first-name" class="form-control"
                        value="{{ $user->first_name }}">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input name="last_name" type="text" class="form-control" id="last-name"
                        value="{{ $user->last_name }}">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <div class="phone-input">
                        {{-- <img src="cambodia-flag.png" alt="Cambodia" class="flag">
                                        <span>+855</span> --}}
                        <input name="phone" type="tel" class="form-control" id="phone_input"
                            value="{{ $user->phone }}">
                    </div>
                    <input type="hidden" name="full_mobile" id="full_mobile">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email_input" value="{{ $user->email }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-input">
                        <input name="password" type="password" class="form-control" id="password_input" value="">
                        <i class="fas fa-eye"></i>
                        <i class="fas fa-eye-slash"></i>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="password-input">
                        <input name="password_confirmation" type="password" class="form-control" id="confirm-password"
                            value="">
                        <i class="fas fa-eye"></i>
                        <i class="fas fa-eye-slash"></i>
                    </div>
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <button type="submit" class="submit-btn float-end">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
