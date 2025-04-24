@extends('backends.master')
@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit User') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <form method="POST" action="{{ route('admin.user.update', $user->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable">{{ __('First Name') }}</label>
                                        <input type="name" class="form-control @error('first_name') is-invalid @enderror"
                                            value="{{ old('first_name', $user->first_name) }}" name="first_name"
                                            placeholder="{{ __('Enter First Name') }}">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_lable">{{ __('Last Name') }}</label>
                                        <input type="name" class="form-control @error('last_name') is-invalid @enderror"
                                            value="{{ old('last_name', $user->last_name) }}" name="last_name"
                                            placeholder="{{ __('Enter Last Name') }}">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_lable">{{ __('Username') }}</label>
                                        <input type="name" class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username', $user->name) }}" name="username"
                                            placeholder="{{ __('Enter Username') }}">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="required_lable">{{ __('Phone Number') }}</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $user->phone) }}" name="phone"
                                            placeholder="{{ __('Enter Phone Number') }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="required_lable">{{ __('Email') }}</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $user->email) }}" name="email"
                                            placeholder="{{ __('Enter Email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_lable">{{ __('Password') }}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            value="" name="password" placeholder="{{ __('Enter Password') }}"
                                            minlength="8">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small class="text-danger d-none"
                                            id="password_error">{{ __('Password must be at least 8 characters long.') }}</small>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="required_lable" for="role">{{ __('Role') }}</label>
                                        <select name="role" id="role"
                                            class="form-control select2 @error('password') is-invalid @enderror">
                                            <option value="">{{ __('Please select role') }}</option>
                                            @foreach ($roles as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ optional($user->roles->first())->id == $id ? 'selected' : '' }}>
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>

                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                            <label>{{__('Address')}}</label>
                                            <input type="text" class="form-control" value="{{ old('address') }}"
                                                name="address" placeholder="{{__('Enter Address')}}" >
                                        </div> --}}

                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">{{ __('Image') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="image">
                                                    <label class="custom-file-label"
                                                        for="exampleInputFile">{{ $user->image ?? __('Choose file') }}</label>
                                                </div>
                                            </div>
                                            <div class="preview text-center border rounded mt-2" style="height: 150px">
                                                <img src="
                                                    @if ($user->image && file_exists(public_path('uploads/users/' . $user->image))) {{ asset('uploads/users/' . $user->image) }}
                                                    @else
                                                        {{ asset('uploads/default-profile.png') }} @endif
                                                    "
                                                    alt="" height="100%">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#password').on('input', function() {
                var password = $(this).val();
                if (password.length < 8) {
                    $('#password_error').removeClass('d-none');
                } else {
                    $('#password_error').addClass('d-none');
                }
                if (password == '') {
                    $('#password_error').addClass('d-none');
                }
            }); 
            $('.custom-file-input').change(function(e) {
                var reader = new FileReader();
                var preview = $(this).closest('.form-group').find('.preview img');
                reader.onload = function(e) {
                    preview.attr('src', e.target.result).show();
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
