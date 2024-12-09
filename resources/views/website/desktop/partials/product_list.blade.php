 @forelse ($products as $item)
     <div class="col-sm-6 col-md-4 col-lg-3 product-item" data-brand-name="{{ $item->brand->name }}">
         <div class="card home-desktop mt-5 border-0 shadow-lg">
             <div class="card-header head-img border-1 justify-content-center">
                  @if (
                         $item->discount &&
                             $item->discount->start_date &&
                             $item->discount->end_date &&
                             now()->toDateString() >= \Carbon\Carbon::parse($item->discount->start_date)->toDateString() &&
                             now()->toDateString() <= \Carbon\Carbon::parse($item->discount->end_date)->toDateString())
                         <span class="discount-amount text-white bg-danger">
                             {{ $item->discount->discount_value }}% OFF
                         </span>
                     @endif

                 @if (!empty($item->thumbnail) && is_array($item->thumbnail) && isset($item->thumbnail[0]))
                     <img src="{{ asset('uploads/products/' . $item->thumbnail[0]) }}" alt="not found">
                 @else
                     <img src="{{ asset('uploads/defualt.png') }}" alt="not found">
                 @endif
             </div>
             <div class="card-body desktop-body">
                 <h5 class="card-title fw-bold" style="color: #1077B8;">
                     <a href="{{ route('product-detail', $item->id) }}">
                         {{ $item->name }}
                     </a>
                 </h5>
                 @php
                     $discountValue = $item->discount ? $item->discount->discount_value : 0;

                     // If discount exists, apply it
                     $discountedPrice = $item->price;

                     if ($discountValue > 0) {
                         $discountedPrice = $item->price - $item->price * ($discountValue / 100); // Apply discount
                     }
                 @endphp

                 <p class="card-text fw-bold" style="margin-bottom: 0; color: #008E06">
                     @if ($discountedPrice < $item->price)
                         ${{ number_format($discountedPrice, 2) }}
                         <span class="text-decoration-line-through text-secondary text-opacity-50">
                             ${{ number_format($item->price, 2) }}
                         </span>
                     @else
                         ${{ number_format($item->price, 2) }}
                     @endif
                 </p>
                 @if ($item->quantity <= 0)
                     <span class="stock badge bg-danger">{{ __('Out of stock') }}</span>
                 @else
                     <span class="stock badge bg-success">{{ __('In stock') }}</span>
                 @endif
                 {{-- Ratings and Add to Cart --}}
                 <div class="rate">
                     {{-- @for ($i = 1; $i <= 5; $i++)
                         <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                     @endfor
                     <span>(5)</span> --}}
                     <div class="addcard float-end">
                         {{-- <a href="#"><i class="fa-solid fa-cart-shopping"></i></a> --}}
                         <a href="{{ route('product-detail', $item->id) }}">
                             <i class="fas fa-eye"></i>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @empty
     <p class="no-products-message">{{ __('No products available') }}</p>
 @endforelse
