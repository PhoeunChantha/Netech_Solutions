@push('css')
@endpush
<div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('New Language') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="{{ route('admin.setting.language.store') }}" class="submit-form" method="post">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="code">{{ __('Country code') }}</label>
                            <select name="code" id="code" class="form-control country_code_select">
                                @foreach(\Illuminate\Support\Facades\File::files(base_path('public/backend/plugins/flag-icon-css/flags/4x3')) as $path)
                                    @if(pathinfo($path)['filename'] !='gb')
                                        <option value="{{ pathinfo($path)['filename'] }}" title="{{ asset('backend/plugins/flag-icon-css/flags/4x3/'.pathinfo($path)['filename'].'.svg') }}">
                                            {{ strtoupper(pathinfo($path)['filename']) }}
                                        </option>
                                    @else
                                        <option value="en" title="{{ asset('backend/plugins/flag-icon-css/flags/4x3/'.pathinfo($path)['filename'].'.svg') }}">
                                        {{ strtoupper('en') }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="submit" class="btn btn-primary submit">{{ __('Save') }}</button>
            </div>
        </form>
    </div>
</div>

{{-- @push('js') --}}
<script>
    $(document).ready(function () {
        $('.country_code_select').select2({
            dropdownParent: $('.modal_form')
        });

        // color select select2
        $('.country_code_select').select2({
            templateResult: codeSelect,
            templateSelection: codeSelect,
            escapeMarkup: function (m) {
                return m;
            }
        });

        function codeSelect(state) {
            var code = state.title;
            if (!code) return state.text;
            return "<img class='image-preview' src='" + code + "' style='height: 15px; margin-inline: 10px; transform: translateY(-1px)'>" + state.text;
        }
    });

</script>
{{-- @endpush --}}
