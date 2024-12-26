<div class="card-body p-0 table-wrapper">
    <table class="table dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Phone') }}</th>
                <th>{{ __('Address') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $cust)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img width="30%"
                            src="
                        @if ($cust->image && file_exists(public_path('uploads/customer/' . $cust->image))) {{ asset('uploads/customer/' . $cust->image) }}
                        @else
                            {{ asset('uploads/defualt.png') }} @endif
                        "
                            alt="" class="profile_img_table">
                    </td>
                    <td>{{ $cust->first_name }} {{ $cust->last_name }}</td>
                    <td>{{ $cust->email }}</td>
                    <td>{{ $cust->phone }}</td>
                    <td>{{ $cust->address }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input switcher_input status"
                                id="status_{{ $cust->id }}" data-id="{{ $cust->id }}"
                                {{ $cust->status == 1 ? 'checked' : '' }} name="status">
                            <label class="custom-control-label" for="status_{{ $cust->id }}"></label>
                        </div>
                    </td>
                    <td>
                        {{-- <a href="#" class="btn btn-info btn-sm btn-view" data-toggle="modal"
                            data-target="#view-custloyee{{ $cust->id }}">
                            <i class="fas fa-eye"></i>
                            {{ __('View') }}
                        </a> --}}
                        <a href="{{ route('admin.customer.edit', $cust->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                       
                        <form action="{{ route('admin.customer.destroy', $cust->id) }}"
                            class="d-inline-block form-delete-{{ $cust->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $cust->id }}"
                                data-href="{{ route('admin.customer.destroy', $cust->id) }}"
                                class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-trash-alt"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>

                    </td>
                </tr>
                {{-- @include('backends.servicepage.view-service') --}}
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $customers->firstItem() }} {{ __('to') }} {{ $customers->lastItem() }}
                    {{ __('of') }} {{ $customers->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $customers->links() }}</div>
            </div>
        </div>
    </div>
</div>
