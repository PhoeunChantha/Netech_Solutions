<div class="card-body p-0 table-wrapper">
    <table class="table dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Thumbnail') }}</th>
                <th>{{ __('Name') }}</th>
                {{-- <th>{{ __('Description') }}</th> --}}
                <th>{{ __('Category') }}</th>
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
                    <td>{{ $service->category->name ?? 'null' }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input switcher_input status"
                                id="status_{{ $service->id }}" data-id="{{ $service->id }}"
                                {{ $service->status == 1 ? 'checked' : '' }} name="status">
                            <label class="custom-control-label" for="status_{{ $service->id }}"></label>
                        </div>
                    </td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-view" data-toggle="modal"
                            data-target="#view-service{{ $service->id }}">
                            <i class="fas fa-eye"></i>
                            {{ __('View') }}
                        </a>
                        <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                        @if (auth()->user()->can('service.edit'))
                        @endif
                        @if (auth()->user()->can('service.delete'))
                        @endif
                        <form action="{{ route('admin.service.destroy', $service->id) }}"
                            class="d-inline-block form-delete-{{ $service->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $service->id }}"
                                data-href="{{ route('admin.service.destroy', $service->id) }}"
                                class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-trash-alt"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>

                    </td>
                </tr>
                @include('backends.servicepage.view-service')
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $services->firstItem() }} {{ __('to') }} {{ $services->lastItem() }}
                    {{ __('of') }} {{ $services->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $services->links() }}</div>
            </div>
        </div>
    </div>
</div>
