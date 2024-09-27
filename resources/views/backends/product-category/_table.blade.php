<div class="card-body p-0 table-wrapper">
    <table class="table">
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
            @foreach ($category as $cate)
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
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input switcher_input status"
                                id="status_{{ $cate->id }}" data-id="{{ $cate->id }}"
                                {{ $cate->status == 1 ? 'checked' : '' }} name="status">
                            <label class="custom-control-label" for="status_{{ $cate->id }}"></label>
                        </div>
                    </td>
                    <td>

                        @if (auth()->user()->can('pro_category.edit'))
                            <a href="#" data-href="{{ route('admin.product-category.edit', $cate->id) }}"
                                class="btn btn-info btn-sm btn-modal btn-edit" data-toggle="modal"
                                data-container=".modal_form">
                                <i class="fas fa-pencil-alt"></i>
                                {{ __('Edit') }}
                            </a>
                        @endif

                        @if (auth()->user()->can('pro_category.delete'))
                            <form action="{{ route('admin.product-category.destroy', $cate->id) }}"
                                class="d-inline-block form-delete-{{ $cate->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" data-id="{{ $cate->id }}"
                                    data-href="{{ route('admin.product-category.destroy', $cate->id) }}"
                                    class="btn btn-danger btn-sm btn-delete">
                                    <i class="fa fa-trash-alt"></i>
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        @endif

                        {{-- <a href="#" data-href="{{ route('admin.product-category.edit', $category->id) }}"
                            class="btn btn-info btn-sm btn-modal btn-edit" data-toggle="modal"
                            data-container=".modal_form">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>


                        <form action="{{ route('admin.product-category.destroy', $category->id) }}"
                            class="d-inline-block form-delete-{{ $category->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $category->id }}"
                                data-href="{{ route('admin.product-category.destroy', $category->id) }}"
                                class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-trash-alt"></i>
                                {{ __('Delete') }}
                            </button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $category->firstItem() }} {{ __('to') }} {{ $category->lastItem() }}
                    {{ __('of') }} {{ $category->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $category->links() }}</div>
            </div>
        </div>
    </div>


</div>
