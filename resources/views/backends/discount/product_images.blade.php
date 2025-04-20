@if (!empty($discount->product_ids) && isset($discountProducts[$discount->id]) && is_array($discountProducts[$discount->id]))
    @foreach ($discountProducts[$discount->id] as $product)
        <a data-fancybox="gallery-{{ $discount->id }}" href="{{ asset('uploads/products/' . $product->thumbnail) }}"
            data-caption="{{ $product->name }}" style="cursor:pointer; font-weight: bold;">
            <li class="list-item text-dark list-none"> {{ $product->name }}</li>
        </a>
    @endforeach
@else
    <span>No products available</span>
@endif

