<div class="card-body p-0 table-wrapper">
    <table class="table dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Product') }}</th>
                <th>{{ __('Discount Value') }}</th>
                <th>{{ __('Start Date') }}</th>
                <th>{{ __('End Date') }}</th>
                <th>{{ __('QTY Limit') }}</th>
                <th>{{ __('Created By') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $discount->name }}</td>
                    {{-- <td>{{ $discount->product->name ?? 'null' }}</td> --}}
                    @foreach ($discounts as $discount)
                        <td>
                            @if (!empty($discount->product_ids))
                                @php
                                    // Fetch the products based on the product IDs
                                    $products = \App\Models\Product::whereIn('id', $discount->product_ids)->get();
                                    $firstProduct = $products->first(); // Get the first product for initial display
                                @endphp
                                @if ($firstProduct)
                                    <!-- Display only the first product initially -->
                                    <span>
                                        <a data-fancybox="gallery-{{ $discount->id }}"
                                            href="{{ asset('uploads/products/' . $firstProduct->thumbnail) }}">
                                            <img class="image-thumbnail"
                                                src="{{ asset('uploads/products/' . $firstProduct->thumbnail) }}"
                                                alt="product-thumbnail" width="50px" height="50px"
                                                style="cursor:pointer" />
                                        </a>
                                    </span>
                                    <span>{{ $firstProduct->name }}</span>
                                @endif

                                <!-- Display all the products in the gallery, this will be used by Fancybox -->
                                @foreach ($products as $product)
                                    <a data-fancybox="gallery-{{ $discount->id }}"
                                        href="{{ asset('uploads/products/' . $product->thumbnail) }}">
                                        <img class="image-thumbnail"
                                            src="{{ asset('uploads/products/' . $product->thumbnail) }}"
                                            alt="product-thumbnail" width="50px" height="50px"
                                            style="cursor:pointer" />
                                    </a>
                                @endforeach
                            @else
                                <span>No products available</span>
                            @endif
                        </td>
                    @endforeach



                    <td>{{ $discount->discount_value }}</td>
                    <td>{{ $discount->start_date }}</td>
                    <td>{{ $discount->end_date }}</td>
                    <td>{{ $discount->quantity_limited }}</td>
                    <td>{{ $discount->createdBy->name ?? 'null' }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input switcher_input status"
                                id="status_{{ $discount->id }}" data-id="{{ $discount->id }}"
                                {{ $discount->status == 1 ? 'checked' : '' }} name="status">
                            <label class="custom-control-label" for="status_{{ $discount->id }}"></label>
                        </div>
                    </td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-view" data-toggle="modal"
                            data-target="#view-discount{{ $discount->id }}">
                            <i class="fas fa-eye"></i>
                            {{ __('View') }}
                        </a>
                        @if (auth()->user()->can('discount.edit'))
                            <a href="{{ route('admin.discount.edit', $discount->id) }}"
                                class="btn btn-info btn-sm btn-edit">
                                <i class="fas fa-pencil-alt"></i>
                                {{ __('Edit') }}
                            </a>
                        @endif
                        @if (auth()->user()->can('discount.delete'))
                            <form action="{{ route('admin.discount.destroy', $discount->id) }}"
                                class="d-inline-block form-delete-{{ $discount->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" data-id="{{ $discount->id }}"
                                    data-href="{{ route('admin.discount.destroy', $discount->id) }}"
                                    class="btn btn-danger btn-sm btn-delete">
                                    <i class="fa fa-trash-alt"></i>
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        @endif

                    </td>
                </tr>
                {{-- @include('backends.product.view-product') --}}
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $discounts->firstItem() }} {{ __('to') }}
                    {{ $discounts->lastItem() }}
                    {{ __('of') }} {{ $discounts->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $discounts->links() }}</div>
            </div>
        </div>
    </div>


</div>
