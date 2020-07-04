@php
    /** @var Illuminate\Database\Eloquent\Collection $videos */
    /** @var App\Models\Video\Video $video */
@endphp

@if($videos->isNotEmpty())
    <div class="card mb-4 border-light">
        <div class="card-body pt-1 pb-0 m-0">
            <a href="{{route('video.likes.user', $user->id)}}" class="mb-0">{{__("video/video.liked_videos")}}:</a>
            <div class="owl-carousel categories m-0">
                @foreach($videos AS $video)
                    <a href="{{route('video.library', $video->id)}}">
                        <img src="{{$video->s3_path_img}}" title="{{$video->title}}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif
