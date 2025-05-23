@extends('backends.master')

@push('css')
    <style>
        .preview {
            margin-block: 12px;
            text-align: center;
        }

        .tab-pane {
            margin-top: 20px
        }
    </style>
@endpush
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Customer') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{-- <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="card-title"> <i class="fa fa-filter" aria-hidden="true"></i>
                                        {{ __('Filter') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="row">
                                        <div class="col-sm-6 filter">
                                            <select name="category_id" id="category_id" class="form-control select2">
                                                <option value=""
                                                    {{ !request()->filled('categories') ? 'selected' : '' }}>
                                                    {{ __('Please Select Category') }}
                                                </option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ $cat->id == request('category_id') ? 'selected' : '' }}>
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="{{ route('admin.service.index') }}" class="btn btn-danger btn-lg">
                                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                                {{ __('Reset') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card p-2">
                        <div class="card-header px-0">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="card-title">{{ __('Employee List') }}</h3>
                                </div>
                                <div class="col-sm-6">
                                    @if (auth()->user()->can('customer.create'))
                                        <a class="btn btn-primary float-right" href="{{ route('admin.customer.create') }}">
                                            <i class=" fa fa-plus-circle"></i>
                                            {{ __('Add New') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @include('backends.customer._table')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade modal_form" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
@endsection
@push('js')
    <script>

        $(document).on('click', '.btn-edit', function() {
            $("div.modal_form").load($(this).data('href'), function() {

                $(this).modal('show');

            });
        });

        $('.custom-file-input').change(function(e) {
            var reader = new FileReader();
            var preview = $(this).closest('.form-group').find('.preview img');
            console.log(preview);
            reader.onload = function(e) {
                preview.attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            const Confirmation = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            Confirmation.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    console.log(`.form-delete-${$(this).data('id')}`);
                    var data = $(`.form-delete-${$(this).data('id')}`).serialize();
                    // console.log(data);
                    $.ajax({
                        type: "post",
                        url: $(this).data('href'),
                        data: data,
                        // dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.status == 1) {
                                $('.table-wrapper').replaceWith(response.view);
                                toastr.success(response.msg);
                            } else {
                                toastr.error(response.msg)

                            }
                        }
                    });
                }
            });
        });

        $('input.status').on('change', function() {
            console.log($(this).data('id'));
            $.ajax({
                type: "get",
                url: "{{ route('admin.customer.update_status') }}",
                data: {
                    "id": $(this).data('id')
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.status == 1) {
                        toastr.success(response.msg);
                    } else {
                        toastr.error(response.msg);
                    }
                }
            });
        });
    </script>
@endpush
