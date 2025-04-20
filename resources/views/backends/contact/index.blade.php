@extends('backends.master')
@push('css')
@endpush
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Message List') }}</h3>
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
                    <div class="card">
                        <!-- /.card-header -->
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
                                    <form method="GET" action="{{ route('admin.contact.index') }}">
                                        <div class="row">
                                            <div class=" col-9 d-flex">
                                                <div class="col-sm-6 filter">
                                                    <label for="start_date"> {{ __('Start Date') }}</label>
                                                    <input type="text" id="start_date" class="form-control datepicker"
                                                        name="start_date" value="{{ request('start_date') }}">
                                                </div>
                                                <div class="col-sm-6 filter">
                                                    <label for="end_date"> {{ __('End Date') }}</label>
                                                    <input type="text" id="end_date" class="form-control datepicker"
                                                        name="end_date" value="{{ request('end_date') }}">
                                                </div>
                                            </div>
                                            <div class=" col-3 mt-3">
                                                <div class="col-sm-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-filter" aria-hidden="true"></i>
                                                        {{ __('Filter') }}
                                                    </button>
                                                    <a href="{{ route('admin.contact.index') }}" class=" btn btn-danger">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                        {{ __('Reset') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-2">
                        <div class="card-header px-0">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="card-title">{{ __('Contact List') }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        {{-- table --}}
                        @include('backends.contact._table')

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <div class="modal fade modal_form" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div> --}}
    <div class="modal fade modal_form" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endsection
@push('js')
    <script>
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
        // $(document).on('click', '.btn-delete', function(e) {
        //     e.preventDefault();

        //     const Confirmation = Swal.mixin({
        //         customClass: {
        //             confirmButton: 'btn btn-success',
        //             cancelButton: 'btn btn-danger'
        //         },
        //         buttonsStyling: false
        //     });

        //     Confirmation.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, delete it!',
        //         cancelButtonText: 'No, cancel!',
        //         reverseButtons: true
        //     }).then((result) => {
        //         if (result.isConfirmed) {

        //             console.log(`.form-delete-${$(this).data('id')}`);
        //             var data = $(`.form-delete-${$(this).data('id')}`).serialize();
        //             // console.log(data);
        //             $.ajax({
        //                 type: "post",
        //                 url: $(this).data('href'),
        //                 data: data,
        //                 // dataType: "json",
        //                 success: function(response) {
        //                     console.log(response);
        //                     if (response.status == 1) {
        //                         $('.table-wrapper').replaceWith(response.view);
        //                         toastr.success(response.msg);
        //                     } else {
        //                         toastr.error(response.msg)

        //                     }
        //                 }
        //             });
        //         }
        //     });
        // });
    </script>
@endpush
