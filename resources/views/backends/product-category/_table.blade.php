<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Created By') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->createdBy->name }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input switcher_input status"
                                id="status_{{ $category->id }}" data-id="{{ $category->id }}"
                                {{ $category->status == 1 ? 'checked' : '' }} name="status">
                            <label class="custom-control-label" for="status_{{ $category->id }}"></label>
                        </div>
                    </td>
                    <td>

                        @if (auth()->user()->can('pro_category.edit'))
                            <a href="#" data-href="{{ route('admin.product-category.edit', $category->id) }}"
                                class="btn btn-info btn-sm btn-modal btn-edit" data-toggle="modal"
                                data-container=".modal_form">
                                <i class="fas fa-pencil-alt"></i>
                                {{ __('Edit') }}
                            </a>
                        @endif

                        @if (auth()->user()->can('pro_category.delete'))
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

    {{-- <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $grades->firstItem() }} {{ __('to') }} {{ $grades->lastItem() }} {{ __('of') }} {{ $grades->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $grades->links() }}</div>
            </div>
        </div>
    </div> --}}


</div>
