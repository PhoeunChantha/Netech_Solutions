<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
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

                        <span class="ml-2">
                            {{ $brand->name }}
                        </span>
                    </td>
                    <td>{{ $brand->description }}</td>
                    <td>
                        <a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>

                        <form action="{{ route('admin.brand.destroy', $brand->id) }}"
                            class="d-inline-block form-delete-{{ $brand->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $brand->id }}"
                                data-href="{{ route('admin.brand.destroy', $brand->id) }}"
                                class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-trash-alt"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>
                       
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $brands->firstItem() }} {{ __('to') }} {{ $brands->lastItem() }}
                    {{ __('of') }} {{ $brands->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $brands->links() }}</div>
            </div>
        </div>
    </div>
</div>
