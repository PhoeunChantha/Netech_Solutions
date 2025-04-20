<div class="card-body p-0 table-wrapper">
    <table class="table table-hover dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Thumbnail') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img width="15%"
                            src="
                        @if ($brand->thumbnail && file_exists(public_path('uploads/brands/' . $brand->thumbnail))) {{ asset('uploads/brands/' . $brand->thumbnail) }}
                        @else
                            {{ asset('uploads/defualt.png') }} @endif
                        "
                            alt="" class="profile_img_table">

                    </td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ Str::limit($brand->description, 50) }}</td>
                  
                    <td>
                        <div class="btn-group dropleft">
                            <button style="z-index: 1000;" class="btn btn-info btn-sm dropdown-toggle" type="button"
                                id="actionDropdown{{ $brand->id }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('Actions') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-left"
                                aria-labelledby="actionDropdown{{ $brand->id }}">
                                @if (auth()->user()->can('brand.edit'))
                                    <a href="{{ route('admin.brand.edit', $brand->id) }}"
                                        class="btn btn-info btn-sm btn-edit dropdown-item">
                                        <i class="fas fa-pencil-alt"></i>
                                        {{ __('Edit') }}
                                    </a>
                                @endif
                                @if (auth()->user()->can('brand.delete'))
                                    <form action="{{ route('admin.brand.destroy', $brand->id) }}"
                                        class="d-inline-block form-delete-{{ $brand->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-id="{{ $brand->id }}"
                                            data-href="{{ route('admin.brand.destroy', $brand->id) }}"
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
            @endforeach
        </tbody>
    </table>
</div>
