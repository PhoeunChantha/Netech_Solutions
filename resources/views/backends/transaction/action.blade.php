<td>
    <div class="btn-group dropleft">
        <button class="btn btn-info btn-sm dropdown-toggle" type="button"
            id="actionDropdown{{ $transaction->id }}" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            {{ __('Actions') }}
        </button>
        <div class="dropdown-menu dropdown-menu-left"
            aria-labelledby="actionDropdown{{ $transaction->id }}">
            <a href="{{ route('admin.transactions.edit', $transaction->id) }}"
                class="dropdown-item btn-edit">
                <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
            </a>
            <form action="{{ route('admin.transactions.destroy', $transaction->id) }}"
                class="d-inline-block form-delete-{{ $transaction->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" data-id="{{ $transaction->id }}"
                    data-href="{{ route('admin.transactions.destroy', $transaction->id) }}"
                    class="dropdown-item btn-delete">
                    <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                </button>
            </form>
            @if (auth()->user()->can('transaction.delete'))
            @endif
        </div>
    </div>
</td>