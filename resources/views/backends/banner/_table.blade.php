<div class="card-body p-0 table-wrapper">
    <table class="table dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posters as $banner)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $banner->name }}</td>
                    <td>
                        <img src="
                        @if ($banner->image_url && file_exists(public_path('uploads/banner/' . $banner->image_url))) {{ asset('uploads/banner/' . $banner->image_url) }}
                        @else
                            {{ asset('uploads/defualt.png') }} @endif
                        "
                            alt="" class="profile_img_table">

                        {{-- <span class="ml-2">
                            {{ $banner->name }}
                        </span> --}}
                    </td>
                    <td>{{ $banner->description }}</td>
                    <td>
                        @if (auth()->user()->can('banner.edit'))
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input switcher_input status"
                                    id="status_{{ $banner->id }}" data-id="{{ $banner->id }}"
                                    {{ $banner->status == 1 ? 'checked' : '' }} name="status">
                                <label class="custom-control-label" for="status_{{ $banner->id }}"></label>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group dropleft">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                id="actionDropdown{{ $banner->id }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('Actions') }}
                            </button>
                            <!-- Add dropdown-menu-left to align the menu to the left side -->
                            <div class="dropdown-menu dropdown-menu-left"
                                aria-labelledby="actionDropdown{{ $banner->id }}">

                                @if (auth()->user()->can('banner.edit'))
                                    <a href="{{ route('admin.banner.edit', $banner->id) }}"
                                        class="dropdown-item btn-edit">
                                        <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                    </a>
                                @endif
                                @if (auth()->user()->can('banner.delete'))
                                    <form action="{{ route('admin.banner.destroy', $banner->id) }}"
                                        class="d-inline-block form-delete-{{ $banner->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-id="{{ $banner->id }}"
                                            data-href="{{ route('admin.banner.destroy', $banner->id) }}"
                                            class="dropdown-item btn-delete">
                                            <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
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
    {{-- <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $posters->firstItem() }} {{ __('to') }} {{ $posters->lastItem() }}
                    {{ __('of') }} {{ $posters->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $posters->links() }}</div>
            </div>
        </div>
    </div> --}}
</div>
