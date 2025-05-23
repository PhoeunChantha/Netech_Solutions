
<div class="card-body p-0 table-wrapper">
    <table class="table dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Position') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $emp)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img width="30%"
                            src="
                        @if ($emp->image && file_exists(public_path('uploads/employee/' . $emp->image))) {{ asset('uploads/employee/' . $emp->image) }}
                        @else
                            {{ asset('uploads/defualt.png') }} @endif
                        "
                            alt="" class="profile_img_table">
                    </td>
                    <td>{{ $emp->name }}</td>
                    <td>{{ $emp->email }}</td>
                    <td>{{ $emp->position }}</td>
                    <td>
                        @if (auth()->user()->can('employee.edit'))
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input switcher_input status"
                                    id="status_{{ $emp->id }}" data-id="{{ $emp->id }}"
                                    {{ $emp->status == 1 ? 'checked' : '' }} name="status">
                                <label class="custom-control-label" for="status_{{ $emp->id }}"></label>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group dropleft">
                            <button style="z-index: 1000;" class="btn btn-info btn-sm dropdown-toggle" type="button"
                                id="actionDropdown{{ $emp->id }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('Actions') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-left"
                                aria-labelledby="actionDropdown{{ $emp->id }}">
                                {{-- <a href="#" class="dropdown-item btn-view" data-toggle="modal"
                                    data-target="#view-product{{ $purchase->id }}">
                                    <i class="fas fa-eye"></i> {{ __('View') }}
                                </a> --}}

                                @if (auth()->user()->can('employee.edit'))
                                    <a href="{{ route('admin.employee.edit', $emp->id) }}"
                                        class="dropdown-item btn-edit">
                                        <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                    </a>
                                @endif
                                @if (auth()->user()->can('employee.delete'))
                                    <form action="{{ route('admin.employee.destroy', $emp->id) }}"
                                        class="d-inline-block form-delete-{{ $emp->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-id="{{ $emp->id }}"
                                            data-href="{{ route('admin.employee.destroy', $emp->id) }}"
                                            class="dropdown-item btn-delete">
                                            <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                                        </button>
                                    </form>
                                @endif
                                @if (auth()->user()->can('product.delete'))
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
                    {{ __('Showing') }} {{ $employees->firstItem() }} {{ __('to') }}
                    {{ $employees->lastItem() }}
                    {{ __('of') }} {{ $employees->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $employees->links() }}</div>
            </div>
        </div>
    </div> --}}
</div>
