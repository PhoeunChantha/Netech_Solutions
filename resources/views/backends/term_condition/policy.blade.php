@extends('backends.master')
@section('contents')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Policy Privacy') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.update-policy') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <textarea class="form-control summernote-policy" name="policy" id="policy" cols="30" rows="10">{{ old('policy', $policy) }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row p-2 ml-2">
                            <button type="submit" class="btn btn-primary float-start">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.summernote-policy').summernote({
                height: 400,
            });
        });
    </script>
@endpush
