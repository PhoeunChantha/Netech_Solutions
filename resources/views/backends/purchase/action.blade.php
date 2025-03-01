<div class="btn-group dropleft">
    <button class="btn btn-info btn-sm dropdown-toggle" type="button"
        id="actionDropdown{{ $purchase->id }}" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        {{ __('Actions') }}
    </button>
    <div class="dropdown-menu dropdown-menu-left"
        aria-labelledby="actionDropdown{{ $purchase->id }}">
        <a href="#" class="dropdown-item btn-view" data-toggle="modal"
            data-target="#view-product{{ $purchase->id }}">
            <i class="fas fa-eye"></i> {{ __('View') }}
        </a>

        <a href="{{ route('admin.purchases.edit', $purchase->id) }}"
            class="dropdown-item btn-edit">
            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
        </a>

        <form action="{{ route('admin.purchases.destroy', $purchase->id) }}"
            class="d-inline-block form-delete-{{ $purchase->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" data-id="{{ $purchase->id }}"
                data-href="{{ route('admin.purchases.destroy', $purchase->id) }}"
                class="dropdown-item btn-delete">
                <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
            </button>
        </form>
        @if (auth()->user()->can('product.delete'))
        @endif
    </div>
</div>