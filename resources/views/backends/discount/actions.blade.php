<div class="btn-group dropleft">
    <button style="z-index: 1000;" class="btn btn-info btn-sm dropdown-toggle" type="button"
        id="actionDropdown{{ $discount->id }}" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        {{ __('Actions') }}
    </button>
    <div class="dropdown-menu dropdown-menu-left"
        aria-labelledby="actionDropdown{{ $discount->id }}">
        @if (auth()->user()->can('discount.edit'))
        <a href="{{ route('admin.discount.edit', $discount->id) }}"
            class="dropdown-item btn-edit">
            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
        </a>
        @endif
        @if (auth()->user()->can('discount.delete'))
            <form action="{{ route('admin.discount.destroy', $discount->id) }}"
                class="d-inline-block form-delete-{{ $discount->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" data-id="{{ $discount->id }}"
                    data-href="{{ route('admin.discount.destroy', $discount->id) }}"
                    class="dropdown-item btn-delete">
                    <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                </button>
            </form>
        @endif

    </div>
</div>