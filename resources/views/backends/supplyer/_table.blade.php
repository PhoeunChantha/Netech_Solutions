<style>
    .discount-status {
        position: absolute;
        margin-right: 10px;
    }
</style>
<div class="card-body p-0 table-wrapper">
    <table class="table dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Contact') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Address') }}</th>
                {{-- <th>{{ __('Status') }}</th> --}}
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $sup)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sup->name }}</td>
                    <td>{{ $sup->contact }}</td>
                    <td>{{ $sup->email ?? 'N/A' }}</td>
                    <td>{{ $sup->address ?? 'N/A' }}</td>
                    {{-- <td>{{ $sup->status }}</td> --}}
                    <td>
                        <div class="btn-group dropleft">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                id="actionDropdown{{ $sup->id }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('Actions') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-left"
                                aria-labelledby="actionDropdown{{ $sup->id }}">
                                @if (auth()->user()->can('supplier.edit'))
                                    <a href="{{ route('admin.supplier.edit', $sup->id) }}"
                                        class="dropdown-item btn-edit">
                                        <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                    </a>
                                @endif

                                @if (auth()->user()->can('supplier.delete'))
                                    <form action="{{ route('admin.supplier.destroy', $sup->id) }}"
                                        class="d-inline-block form-delete-{{ $sup->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-id="{{ $sup->id }}"
                                            data-href="{{ route('admin.supplier.destroy', $sup->id) }}"
                                            class="dropdown-item btn-delete">
                                            <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center text-danger" colspan="7">{{ __('No data available in table') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $suppliers->firstItem() }} {{ __('to') }}
                    {{ $suppliers->lastItem() }}
                    {{ __('of') }} {{ $suppliers->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $suppliers->links() }}</div>
            </div>
        </div>
    </div> --}}
</div>
