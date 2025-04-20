<style>
    .discount-status {
        position: absolute;
        margin-right: 10px;
    }
</style>
<div class="card-body p-0 table-wrapper">
    <table class="table dataTable table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Code') }}</th>
                <th>{{ __('Thumbnail') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('QTY') }}</th>
                <th>{{ __('Brand') }}</th>
                <th>{{ __('Category') }}</th>
                <th>{{ __('Created By') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->code }}</td>
                    <td>
                        <span>
                            @php
                                $thumbnails = is_array($product->thumbnail)
                                    ? $product->thumbnail
                                    : [$product->thumbnail];
                            @endphp

                            @if (!empty($thumbnails) && $thumbnails[0] != null)
                                <a class="example-image-link" href="{{ asset('uploads/products/' . $thumbnails[0]) }}"
                                    data-fancybox="gallery-{{ $product->id }}">
                                    <img class="example-image image-thumbnail"
                                        src="{{ asset('uploads/products/' . $thumbnails[0]) }}" alt="product-thumbnail"
                                        width="50px" height="50px" style="cursor:pointer" />
                                </a>

                                @foreach ($thumbnails as $key => $thumbnail)
                                    @if ($key > 0)
                                        <a href="{{ asset('uploads/products/' . $thumbnail) }}"
                                            data-fancybox="gallery-{{ $product->id }}" style="display: none;"></a>
                                    @endif
                                @endforeach
                            @else
                                <a class="example-image-link" href="{{ asset('uploads/products/default.png') }}"
                                    data-fancybox="gallery-{{ $product->id }}">
                                    <img class="example-image image-thumbnail"
                                        src="{{ asset('uploads/products/default.png') }}" alt="default-thumbnail"
                                        width="50px" height="50px" style="cursor:pointer" />
                                </a>
                            @endif
                        </span>
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @if ($product->quantity > 0)
                            {{ $product->quantity }}
                        @else
                            <span class="badge badge-danger">{{ __('Out of Stock') }}</span>
                        @endif
                    </td>
                    <td>{{ $product->brand->name ?? 'null' }}</td>
                    <td>{{ $product->category->name ?? 'null' }}</td>
                    <td>{{ $product->createdBy->name ?? 'null' }}</td>
                    <td>
                        @if (auth()->user()->can('product.edit'))
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input switcher_input status"
                                    id="status_{{ $product->id }}" data-id="{{ $product->id }}"
                                    {{ $product->status == 1 ? 'checked' : '' }} name="status">
                                <label class="custom-control-label" for="status_{{ $product->id }}"></label>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group dropleft">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                id="actionDropdown{{ $product->id }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('Actions') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-left"
                                aria-labelledby="actionDropdown{{ $product->id }}">
                                @if (auth()->user()->can('product.edit'))
                                    <a href="#" class="dropdown-item btn-view" data-toggle="modal"
                                        data-target="#view-product{{ $product->id }}">
                                        <i class="fas fa-eye"></i> {{ __('View') }}
                                    </a>
                                @endif
                                @if (auth()->user()->can('product.edit'))
                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                        class="dropdown-item btn-edit">
                                        <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                    </a>
                                @endif
                                @if (auth()->user()->can('product.delete'))
                                    <form action="{{ route('admin.product.destroy', $product->id) }}"
                                        class="d-inline-block form-delete-{{ $product->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-id="{{ $product->id }}"
                                            data-href="{{ route('admin.product.destroy', $product->id) }}"
                                            class="dropdown-item btn-delete">
                                            <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @include('backends.product.view-product')
            @endforeach
        </tbody>
    </table>

    {{-- <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $products->firstItem() }} {{ __('to') }} {{ $products->lastItem() }}
                    {{ __('of') }} {{ $products->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $products->links() }}</div>
            </div>
        </div>
    </div> --}}
</div>
