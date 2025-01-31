<style>
    .discount-status {
        position: absolute;
        margin-right: 10px;
    }
</style>
<div class="card-body p-0 table-wrapper">
    <table class="table dataTable">
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
                            @if (is_array($product->thumbnail) && !empty($product->thumbnail))
                                <!-- Display the first image as the visible thumbnail -->
                                <a class="example-image-link"
                                    href="{{ asset('uploads/products/' . $product->thumbnail[0]) }}"
                                    data-fancybox="gallery-{{ $product->id }}">
                                    <img class="example-image image-thumbnail"
                                        src="{{ asset('uploads/products/' . $product->thumbnail[0]) }}" alt="profile"
                                        width="50px" height="50px" style="cursor:pointer" />
                                </a>

                                <!-- Add all other images to the Fancybox gallery as hidden links -->
                                @foreach ($product->thumbnail as $key => $thumbnail)
                                    @if ($key > 0)
                                        <a href="{{ asset('uploads/products/' . $thumbnail) }}"
                                            data-fancybox="gallery-{{ $product->id }}" style="display: none;"></a>
                                    @endif
                                @endforeach
                            @else
                                <!-- Fallback if $product->thumbnail is a single image path -->
                                <a class="example-image-link" href="{{ asset('uploads/products/defualt.png') }}"
                                    data-fancybox="gallery-{{ $product->id }}">
                                    <img class="example-image image-thumbnail" src="{{ asset('uploads/defualt.png') }}"
                                        alt="profile" width="50px" height="50px" style="cursor:pointer" />
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
                    <td>{{ $product->createdBy->name }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input switcher_input status"
                                id="status_{{ $product->id }}" data-id="{{ $product->id }}"
                                {{ $product->status == 1 ? 'checked' : '' }} name="status">
                            <label class="custom-control-label" for="status_{{ $product->id }}"></label>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group dropleft">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                id="actionDropdown{{ $product->id }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('Actions') }}
                            </button>
                            <!-- Add dropdown-menu-left to align the menu to the left side -->
                            <div class="dropdown-menu dropdown-menu-left"
                                aria-labelledby="actionDropdown{{ $product->id }}">
                                <a href="#" class="dropdown-item btn-view" data-toggle="modal"
                                    data-target="#view-product{{ $product->id }}">
                                    <i class="fas fa-eye"></i> {{ __('View') }}
                                </a>
                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                    class="dropdown-item btn-edit">
                                    <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                </a>

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
                            </div>
                        </div>
                    </td>
                </tr>
                @include('backends.product.view-product')
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $products->firstItem() }} {{ __('to') }} {{ $products->lastItem() }}
                    {{ __('of') }} {{ $products->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $products->links() }}</div>
            </div>
        </div>
    </div>


</div>
