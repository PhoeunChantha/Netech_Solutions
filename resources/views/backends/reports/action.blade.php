<td>
    <div class="btn-group dropleft">
        <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="actionDropdown{{ $orderReport->id }}"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('Actions') }}
        </button>
        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="actionDropdown{{ $orderReport->id }}">
            <a href="#" data-href="{{ route('admin.report.report-detail', $orderReport->id) }}"
                class="dropdown-item btn-view">
                <i class="fas fa-eye"></i> View
            </a>
            <a href="javascript:void(0)" data-id="{{ $orderReport->id }}" class="dropdown-item btn-print">
                <i class="fas fa-print"></i> {{ __('Print') }}
            </a>
            <form action="{{ route('admin.report.destroy', $orderReport->id) }}"
                class="d-inline-block form-delete-{{ $orderReport->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" data-id="{{ $orderReport->id }}"
                    data-href="{{ route('admin.report.destroy', $orderReport->id) }}" class="dropdown-item btn-delete">
                    <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>
</td>
