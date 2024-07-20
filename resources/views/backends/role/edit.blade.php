@extends('backends.master')
@push('css')
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 22px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(18px);
            -ms-transform: translateX(18px);
            transform: translateX(18px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 22px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .checkIP {
            width: 20px;
        }
    </style>
@endpush
@section('contents')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit Role') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-material form-horizontal" action="{{ route('admin.role.update', $role->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- @if ($role->name == 'customer' || $role->name == 'partner')
                                            <Label class="border p-2">{{ $role->name }}</Label>
                                        @endif --}}
                                        {{-- @if ($role->name != 'customer' && $role->name != 'partner') --}}
                                        <div class="form-group">
                                            <label for="name">@lang('Name Position')</label>
                                            <div class="input-group mb-3">
                                                <input type="text" value="{{ $role->name }}" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="@lang('Type name permission')">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- @endif --}}
                                    </div>
                                </div>

                                <label style="font-size: 16px;" for="">{{ __('Select Permission') }}</label>
                                <hr>
                                <br>
                                <div class="col-12 mb-3">
                                    <button type="button" id="check-all"
                                        class="btn btn-primary">{{ __('Check All') }}</button>
                                </div>
                                <div class="User">
                                    <div class="d-flex">
                                        <label for="" class="mr-2 mb-3">{{ __('User Set up') }}</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="view_user" name="permissions[]"
                                                                @if (in_array('user.view', $role_permissions)) checked @endif
                                                                value="user.view">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2" for="view_user">{{ __('View User') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="user_create" name="permissions[]"
                                                                @if (in_array('user.create', $role_permissions)) checked @endif
                                                                value="user.create">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="user_create">{{ __('Create User') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <!-- Rounded switch -->

                                                        <label class="switch">
                                                            <input type="checkbox" id="user_edit" name="permissions[]"
                                                                @if (in_array('user.edit', $role_permissions)) checked @endif
                                                                value="user.edit">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2" for="user_edit">{{ __('Edit User') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="user_delete" name="permissions[]"
                                                                @if (in_array('user.delete', $role_permissions)) checked @endif
                                                                value="user.delete">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="user_delete">{{ __('Delete User') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="Role">
                                    <div class="d-flex">
                                        <label for="" class="mr-2 mb-3">{{ __('Role Set up') }}</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="role_view" name="permissions[]"
                                                                @if (in_array('role.view', $role_permissions)) checked @endif
                                                                value="role.view">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2" for="view_role">{{ __('View Role') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="role_create" name="permissions[]"
                                                                @if (in_array('role.create', $role_permissions)) checked @endif
                                                                value="role.create">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="role_create">{{ __('Create Role') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <!-- Rounded switch -->

                                                        <label class="switch">
                                                            <input type="checkbox" id="role_edit" name="permissions[]"
                                                                @if (in_array('role.edit', $role_permissions)) checked @endif
                                                                value="role.edit">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="role_edit">{{ __('Edit Role') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="role_delete" name="permissions[]"
                                                                @if (in_array('role.delete', $role_permissions)) checked @endif
                                                                value="role.delete">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="role_delete">{{ __('Delete Role') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="Product">
                                    <div class="d-flex">
                                        <label for="" class="mr-2 mb-3">{{ __('Product Setup') }}</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="view_product" name="permissions[]"
                                                                @if (in_array('product.view', $role_permissions)) checked @endif
                                                                value="product.view">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="view_product">{{ __('View Product') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="product_create"
                                                                name="permissions[]"
                                                                @if (in_array('product.create', $role_permissions)) checked @endif
                                                                value="product.create">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="product_create">{{ __('Create Product') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <!-- Rounded switch -->

                                                        <label class="switch">
                                                            <input type="checkbox" id="product_edit" name="permissions[]"
                                                                @if (in_array('product.edit', $role_permissions)) checked @endif
                                                                value="product.edit">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="product_edit">{{ __('Edit Product') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="product_delete"
                                                                @if (in_array('product.delete', $role_permissions)) checked @endif
                                                                name="permissions[]" value="product.delete">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="product_delete">{{ __('Delete Product') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="Categories">
                                    <div class="d-flex">
                                        <label for="" class="mr-2 mb-3">{{ __('Category Setup') }}</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="view_pro_category"
                                                                @if (in_array('pro_category.view', $role_permissions)) checked @endif
                                                                name="permissions[]" value="pro_category.view">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="view_pro_category">{{ __('View Category') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="pro_category_create"
                                                                @if (in_array('pro_category.create', $role_permissions)) checked @endif
                                                                name="permissions[]" value="pro_category.create">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="pro_category_create">{{ __('Create Category') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <!-- Rounded switch -->

                                                        <label class="switch">
                                                            <input type="checkbox" id="pro_category_edit"
                                                                @if (in_array('pro_category.edit', $role_permissions)) checked @endif
                                                                name="permissions[]" value="pro_category.edit">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="pro_category_edit">{{ __('Edit Category') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="pro_category_delete"
                                                                @if (in_array('pro_category.delete', $role_permissions)) checked @endif
                                                                name="permissions[]" value="pro_category.delete">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="pro_category_delete">{{ __('Delete Category') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="Setting">
                                    <div class="d-flex">
                                        <label for="" class="mr-2 mb-3">{{ __('Setting Setup') }}</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="setting_view"
                                                                @if (in_array('setting.view', $role_permissions)) checked @endif
                                                                name="permissions[]" value="setting.view">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="setting_view">{{ __('View Setting') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="setting_update"
                                                                @if (in_array('setting.update', $role_permissions)) checked @endif
                                                                name="permissions[]" value="setting.update">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="setting_update">{{ __('Update Setting') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="language_create"
                                                                @if (in_array('language.create', $role_permissions)) checked @endif
                                                                name="permissions[]" value="language.create">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="language_create">{{ __('Create Language') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="language_edit"
                                                                @if (in_array('language.edit', $role_permissions)) checked @endif
                                                                name="permissions[]" value="language.edit">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="language_edit">{{ __('Edit Language') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="language_translate"
                                                                @if (in_array('language.translate', $role_permissions)) checked @endif
                                                                name="permissions[]" value="language.translate">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="language_translate">{{ __('Translate Language') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label class="switch">
                                                            <input type="checkbox" id="language_delete"
                                                                @if (in_array('language.delete', $role_permissions)) checked @endif
                                                                name="permissions[]" value="language.delete">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <label class="ml-2"
                                                            for="language_delete">{{ __('Delete Language') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 col-form-label"></label>
                                            <div class="col-md-8">
                                                <input type="submit" value="{{ __('Submit') }}"
                                                    class="btn btn-outline btn-primary btn-lg" />
                                                <a href="{{ route('admin.role.index') }}"
                                                    class="btn btn-outline btn-danger btn-lg">{{ __('Cancel') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#check-all').on('click', function() {
                let checkboxes = $('input[type="checkbox"][name="permissions[]"]');
                let allChecked = checkboxes.length === checkboxes.filter(':checked').length;
                checkboxes.prop('checked', !allChecked);
            });
        });
    </script>
@endpush
