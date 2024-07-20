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
                <h3>{{ __('Business Setting') }}</h3>
            </div>
            <div class="col-sm-6" style="text-align: right">
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                @include('backends.setting.partials.tab')
            </div>
            <div class="">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-for-webcontent" role="tabpanel" aria-labelledby="custom-tabs-for-webcontent-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h3 class="card-title">{{ __('Language') }}</h3>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-outline-secondary float-right" href="{{ route('admin.setting.language.index') }}">
                                                    <i class=" fa fa-arrow-alt-circle-left"></i>
                                                    {{ __('Back') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0 table-wrapper">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Key') }}</th>
                                                    <th>{{ __('Value') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lang_data as $count => $row)
                                                    <tr id="lang-{{$row['key']}}">
                                                        <td class="text-capitalize">
                                                            <input type="text" name="key[]" value="{{$row['key']}}" hidden>
                                                            {{ $row["key"] }}
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="value[]" id="value-{{$count+1}}" value="{{$row['value']}}">
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-success btn-sm btn-modal" href="#" onclick="update_lang('{{$row['key']}}',$('#value-{{$count+1}}').val())">
                                                                <i class=" fa fa-pencil-alt"></i>
                                                                {{ __('Edit') }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<div class="modal fade modal_form" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

@endsection
@push('js')
<script>
    function update_lang(key, value) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('admin.setting.language.translate.submit',[$lang]) }}",
            method: 'POST',
            data: {
                key: key,
                value: value
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (response) {
                toastr.success('{{__('text_updated_successfully')}}');
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }

</script>
@endpush
