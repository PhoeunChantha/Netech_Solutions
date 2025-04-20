@if (auth()->user()->can('discount.edit'))
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input switcher_input status" id="status_{{ $discount->id }}"
            data-id="{{ $discount->id }}" {{ $discount->status == 1 ? 'checked' : '' }} name="status">
        <label class="custom-control-label" for="status_{{ $discount->id }}"></label>
    </div>
@endif
