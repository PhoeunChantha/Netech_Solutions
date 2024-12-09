<div class="owl-carousel owl-theme p-2">
    @forelse ($videos as $singleVideo)
        <div class="item">
            <div class="card home-desktop border-0 shadow-lg">
                <div class="card-header head-video justify-content-center">
                    <img src="@if ($singleVideo->thumbnail && file_exists(public_path('uploads/videos/' . $singleVideo->thumbnail))) {{ asset('uploads/videos/' . $singleVideo->thumbnail) }}
                                                            @else
                                                                {{ asset('uploads/image/default.png') }} @endif"
                        alt="not found" class="img-fluid">
                    <a href="https://www.youtube.com/embed/{{ $singleVideo->video_id }}" data-fancybox="gallery"
                        data-caption="{{ $singleVideo->name }}" class="playvideo btn-video">
                        <i class="fa-solid fa-play fa-lg" style="color: white"></i>
                    </a>
                </div>
                <div class="card-body desktop-body">
                    <h5 class="card-title fw-bold" style="color: #1077B8;">
                        {{ $singleVideo->name }}
                    </h5>
                    <div class="description fs-6">
                        {{ $singleVideo->description }}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>{{ __('No videos available') }}</p>
    @endforelse
</div>
