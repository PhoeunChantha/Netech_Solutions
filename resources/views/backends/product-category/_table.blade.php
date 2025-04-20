<div class="card-body p-0 table-wrapper">
    <table class="table dataTable table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Thumbnail') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Created By') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $cate)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img width="30%"
                            src="
                        @if ($cate->thumbnails && file_exists(public_path('uploads/category/' . $cate->thumbnails))) {{ asset('uploads/category/' . $cate->thumbnails) }}
                        @else
                            {{ asset('uploads/defualt.png') }} @endif
                        "
                            alt="" class="profile_img_table">


                    </td>
                    <td>{{ $cate->name }}</td>
                    <td>{{ $cate->createdBy->name }}</td>
                    <td>
                        @if (auth()->user()->can('product_category.edit'))
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input switcher_input status"
                                    id="status_{{ $cate->id }}" data-id="{{ $cate->id }}"
                                    {{ $cate->status == 1 ? 'checked' : '' }} name="status">
                                <label class="custom-control-label" for="status_{{ $cate->id }}"></label>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group dropleft">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                id="actionDropdown{{ $cate->id }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('Actions') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-left"
                                aria-labelledby="actionDropdown{{ $cate->id }}">
                                @if (auth()->user()->can('product_category.edit'))
                                    <a href="#" data-href="{{ route('admin.product-category.edit', $cate->id) }}"
                                        class="btn btn-info dropdown-item btn-sm btn-modal btn-edit" data-toggle="modal"
                                        data-container=".modal_form">
                                        <i class="fas fa-pencil-alt"></i>
                                        {{ __('Edit') }}
                                    </a>
                                @endif
                                @if (auth()->user()->can('product_category.delete'))
                                    <form action="{{ route('admin.product-category.destroy', $cate->id) }}"
                                        class="d-inline-block form-delete-{{ $cate->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-id="{{ $cate->id }}"
                                            data-href="{{ route('admin.product-category.destroy', $cate->id) }}"
                                            class="btn btn-danger dropdown-item btn-sm btn-delete">
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
