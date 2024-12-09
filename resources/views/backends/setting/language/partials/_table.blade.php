<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Code') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Default') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($language)
                @foreach (json_decode($language) as $row)
                    <tr>
                        <td class="text-capitalize">{{ $row->name }}</td>
                        <td>{{ $row->code }}</td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input switcher_input status"
                                    id="status_{{ $row->id }}" data-id="{{ $row->id }}"
                                    {{ $row->status == 1 ? 'checked' : '' }} name="status">
                                <label class="custom-control-label" for="status_{{ $row->id }}"></label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input switcher_input default_status"
                                    id="default_{{ $row->id }}" data-id="{{ $row->id }}"
                                    {{ $row->default == 1 ? 'checked' : '' }} name="default_status">
                                <label class="custom-control-label" for="default_{{ $row->id }}"></label>
                            </div>
                        </td>
                        <td>
                            @if ($row->code != 'en')
                            <a class="btn btn-success btn-sm btn-modal" href="#"
                                data-href="{{ route('admin.setting.language.edit', ['id' => $row->id]) }}"
                                data-toggle="modal" data-container=".modal_form">
                                <i class=" fa fa-pencil-alt"></i>
                                {{ __('Edit') }}
                            </a>
                              
                                <a class="btn btn-info btn-sm"
                                    href="{{ route('admin.setting.language.translate', ['code' => $row->code]) }}">
                                    {{-- <i class=" fa fa-tr"></i> --}}
                                    {{ __('Translate') }}
                                </a>

                                <form
                                    action="{{ route('admin.setting.language.delete', ['id' => $row->id, 'code' => $row->code]) }}"
                                    class="d-inline-block form-delete-{{ $row->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-id="{{ $row->id }}"
                                        data-href="{{ route('admin.setting.language.delete', ['id' => $row->id, 'code' => $row->code]) }}"
                                        class="btn btn-danger btn-sm btn-delete">
                                        <i class="fas fa-trash-alt"></i>
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">{{ __('No languages found.') }}</td>
                </tr>
            @endif

        </tbody>
    </table>
</div>

@push('js')
    <script>
        $('input.status').on('change', function() {
            $.ajax({
                type: "get",
                url: "{{ route('admin.setting.language.update-status') }}",
                data: {
                    "id": $(this).data('id')
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 1) {
                        toastr.success(response.msg);
                    } else {
                        toastr.error(response.msg);
                    }
                }
            });
        });

        $('input.default_status').on('change', function() {
            $.ajax({
                type: "get",
                url: "{{ route('admin.setting.language.update-default-status') }}",
                data: {
                    "id": $(this).data('id')
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 1) {
                        toastr.success(response.msg);
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        toastr.error(response.msg);
                    }
                }
            });
        });
    </script>
@endpush
