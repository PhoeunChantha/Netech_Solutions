<div class="card-body p-0 table-wrapper">
    <table class="table dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Code') }}</th>
                <th>{{ __('Thumbnail') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Brand') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('QTY') }}</th>
                {{-- <th>{{ __('Operating System') }}</th> --}}
                <th>{{ __('Category') }}</th>
                <th>{{ __('Created By') }}</th>
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
                            <a class="example-image-link" href="{{ asset('uploads/products/' . $product->thumbnail) }}"
                                data-lightbox="lightbox-' . $product->id . '">
                                <img class="example-image image-thumbnail"
                                    src="{{ asset('uploads/products/' . $product->thumbnail) }}" alt="profile"
                                    width="50px" height="50px" style="cursor:pointer" />
                            </a>
                        </span>
                        {{-- <span class="ml-2">
                            {{ $product->name }}
                        </span> --}}
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->brand->name ?? 'null' }}</td>
                    <td>{{ $product->price}}</td>
                    <td>{{ $product->quantity }}</td>
                    {{-- <td>{{ $product->operating_system }}</td> --}}
                    <td>{{ $product->category->name ?? 'null' }}</td>
                    <td>{{ $product->createdBy->name }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-view" data-toggle="modal"
                            data-target="#view-product{{ $product->id }}">
                            <i class="fas fa-eye"></i>
                            {{ __('View') }}
                        </a>
                        @if (auth()->user()->can('product.edit'))
                            <a href="{{ route('admin.product.edit', $product->id) }}"
                                class="btn btn-info btn-sm btn-edit">
                                <i class="fas fa-pencil-alt"></i>
                                {{ __('Edit') }}
                            </a>
                        @endif
                        @if (auth()->user()->can('product.delete'))
                            <form action="{{ route('admin.product.destroy', $product->id) }}"
                                class="d-inline-block form-delete-{{ $product->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" data-id="{{ $product->id }}"
                                    data-href="{{ route('admin.product.destroy', $product->id) }}"
                                    class="btn btn-danger btn-sm btn-delete">
                                    <i class="fa fa-trash-alt"></i>
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        @endif

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
