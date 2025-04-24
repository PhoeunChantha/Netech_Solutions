<div class="card-body p-0 table-wrapper">
    <table class="table dataTable table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Thumbnail') }}</th>
                <th>{{ __('Name') }}</th>
                {{-- <th>{{ __('Description') }}</th> --}}
                {{-- <th>{{ __('Category') }}</th> --}}
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img width="30%"
                            src="
                        @if ($service->thumbnails && file_exists(public_path('uploads/serviceimg/' . $service->thumbnails))) {{ asset('uploads/serviceimg/' . $service->thumbnails) }}
                        @else
                            {{ asset('uploads/defualt.png') }} @endif
                        "
                            alt="" class="profile_img_table">
                    </td>
                    <td>{{ $service->name }}</td>
                    {{-- <td>{{ $service->category->name ?? 'null' }}</td> --}}
                    <td>
                        @if (auth()->user()->can('service.edit'))
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input switcher_input status"
                                    id="status_{{ $service->id }}" data-id="{{ $service->id }}"
                                    {{ $service->status == 1 ? 'checked' : '' }} name="status">
                                <label class="custom-control-label" for="status_{{ $service->id }}"></label>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group dropleft">
                            <button style="z-index: 1000;" class="btn btn-info btn-sm dropdown-toggle" type="button"
                                id="actionDropdown{{ $service->id }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('Actions') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-left"
                                aria-labelledby="actionDropdown{{ $service->id }}">
                                @if (auth()->user()->can('service.edit'))
                                    <a href="#" class="btn btn-info btn-sm btn-view dropdown-item" data-toggle="modal"
                                        data-target="#view-service{{ $service->id }}">
                                        <i class="fas fa-eye"></i>
                                        {{ __('View') }}
                                    </a>
                                @endif
                                @if (auth()->user()->can('service.edit'))
                                    <a href="{{ route('admin.service.edit', $service->id) }}"
                                        class="btn btn-info btn-sm btn-edit dropdown-item">
                                        <i class="fas fa-pencil-alt"></i>
                                        {{ __('Edit') }}
                                    </a>
                                @endif
                                @if (auth()->user()->can('service.delete'))
                                    <form action="{{ route('admin.service.destroy', $service->id) }}"
                                        class="d-inline-block form-delete-{{ $service->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-id="{{ $service->id }}"
                                            data-href="{{ route('admin.service.destroy', $service->id) }}"
                                            class="btn btn-danger btn-sm btn-delete dropdown-item">
                                            <i class="fa fa-trash-alt"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @include('backends.servicepage.view-service')
            @endforeach
        </tbody>
    </table>
</div>
