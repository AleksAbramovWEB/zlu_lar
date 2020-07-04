
@php
    /** @var App\Models\Video\VideoLikes $like */
@endphp


@foreach($collectionsLikes as $collection)
    <div class="card mb-4">
        <div class="card-body">
            @foreach($collection as $like)
                @if($loop->first)
                    <div class="row">
                        @elseif(($loop->index % 3) === 0)
                    </div>
                    <div class="row">
                        @endif
                        <div class="col">
                            <a href="{{route('video.library', $like->to_video->id)}}">
                                <img class="card-img-top" src="{{$like->to_video->s3_path_img}}" alt="Card image cap">
                                <div class="col">
                                    <div class="row">{{$like->to_video->title}}</div>
                                    <div class="row ">{{$like->to_video->description}}</div>
                                </div>
                            </a>
                        </div>
                        @if($loop->last)
                            @if(($loop->index % 3) === 0 OR $loop->index === 0)
                                <div class="col"></div>
                                <div class="col"></div>
                            @elseif(($loop->index % 4) === 0 OR $loop->index === 1)
                                <div class="col"></div>
                            @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endforeach
