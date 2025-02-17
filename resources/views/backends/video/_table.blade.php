<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Video Type') }}</th>
                <th>{{ __('Video') }}</th>
                <th>{{ __('Created By') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videos as $video)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $video->name }}</td>
                    <td>{{ substr($video->description, 0, 50) }}{{ strlen($video->description) > 50 ? '...' : '' }}
                    </td>
                    <td>{{ $video->video_type }}</td>
                    <td>
                        @if (!empty($video->video_id))
                            <div>
                                <iframe width="150" height="100"
                                    src="https://www.youtube.com/embed/{{ $video->video_id }}"
                                    style="pointer-events: none;">
                                </iframe>
                            </div>
                        @endif
                    </td>
                    <td>{{ $video->createdBy->name ?? 'null' }}</td>
                    <td>
                        @if (auth()->user()->can('video.edit'))
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input switcher_input status"
                                id="status_{{ $video->id }}" data-id="{{ $video->id }}"
                                {{ $video->status == 1 ? 'checked' : '' }} name="status">
                            <label class="custom-control-label" for="status_{{ $video->id }}"></label>
                        </div>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group dropleft">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                id="actionDropdown{{ $video->id }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ __('Actions') }}
                            </button>
                            <!-- Add dropdown-menu-left to align the menu to the left side -->
                            <div class="dropdown-menu dropdown-menu-left"
                                aria-labelledby="actionDropdown{{ $video->id }}">
                                @if (auth()->user()->can('video.edit'))
                                    <a href="{{ route('admin.video.edit', $video->id) }}"
                                        class="dropdown-item btn-edit">
                                        <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                    </a>
                                @endif
                                @if (auth()->user()->can('video.delete'))
                                    <form action="{{ route('admin.video.destroy', $video->id) }}"
                                        class="d-inline-block form-delete-{{ $video->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-id="{{ $video->id }}"
                                            data-href="{{ route('admin.video.destroy', $video->id) }}"
                                            class="dropdown-item btn-delete">
                                            <i class="fa fa-trash-alt"></i> {{ __('Delete') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $videos->firstItem() }} {{ __('to') }} {{ $videos->lastItem() }}
                    {{ __('of') }} {{ $videos->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $videos->links() }}</div>
            </div>
        </div>
    </div>
</div>
