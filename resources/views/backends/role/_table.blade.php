<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead class="text-uppercase">
            <tr>
                <th>#</th>
                <th>{{ __('Name') }} </th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($roles)
                @foreach ($roles as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-capitalize">{{ $row->name }}</td>
                        <td>
                            @if (auth()->user()->can('role.edit'))
                                <a href="{{ route('admin.role.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-pencil"></i> {{ __('Edit') }}
                                </a>
                            @endif
                            @if (auth()->user()->can('role.delete'))
                                <form action="{{ route('admin.role.destroy', $row->id) }}"
                                    class="d-inline-block form-delete-{{ $row->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-id="{{ $row->id }}"
                                        data-href="{{ route('admin.role.destroy', $row->id) }}"
                                        class="btn btn-danger btn-sm btn-delete">
                                        <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach

            @endif
        </tbody>
    </table>

    @if (count($roles) != 0)
        <div class="row">
            <div class="col-12 d-flex flex-row flex-wrap">
                <div class="row" style="width: -webkit-fill-available;">
                    <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                        {{ __('Showing') }} {{ $roles->firstItem() }} {{ __('to') }} {{ $roles->lastItem() }}
                        {{ __('of') }} {{ $roles->total() }} {{ __('entries') }}
                    </div>
                    <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $roles->links() }}</div>
                </div>
            </div>
        </div>
    @endif
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
