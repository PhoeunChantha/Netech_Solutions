<div class="modal fade" id="view-service{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Service Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-0 d-flex justify-content-center">
                            <img width="50%"
                                src="@if ($service->thumbnails && file_exists(public_path('uploads/serviceimg/' . $service->thumbnails))) {{ asset('uploads/serviceimg/' . $service->thumbnails) }} @else {{ asset('/uploads/defualt.png') }} @endif"
                                alt="" class="">
                        </div>
                        <div class="title text-center mt-1">
                            <h5 class="">{{ $service->name }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush pr-3 pl-3">
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Category:</strong>
                                    <span>{{ $service->category->name ?? 'null' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Description:</strong><br>
                                    <span>{!! $service->description !!}</span>
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-info btn-sm btn-edit">
                    <i class="fas fa-pencil-alt"></i>
                    {{ __('Edit') }}
                </a>
               
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
