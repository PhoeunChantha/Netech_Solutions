<div class="modal fade" id="view-product{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-0 d-flex justify-content-center">
                            <img width="50%"
                                src="@if ($product->thumbnail && file_exists(public_path('uploads/products/' . $product->thumbnail))) {{ asset('uploads/products/' . $product->thumbnail) }} @else {{ asset('/uploads/defualt.png') }} @endif"
                                alt="" class="">
                        </div>
                        <div class="title text-center mt-1">
                            <h5 class="">{{ $product->name }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush pr-3 pl-3">
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Price:</strong>
                                    <span>$ {{ $product->price }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Quantity:</strong>
                                    <span>{{ $product->quantity }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Category:</strong>
                                    <span>{{ $product->category->name ?? 'null' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Brand:</strong>
                                    <span>{{ $product->brand->name ?? 'null' }}</span>
                                </li>
                                {{-- <li class="list-group-item d-flex justify-content-between">
                                    <strong>Platform:</strong>
                                    <span>{{ $product->operating_system }}</span>
                                </li> --}}
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Description:</strong><br>
                                    <span>{!! $product->description !!}</span>
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
