@extends('layouts.app')
@push('css')

@endpush
@section('content')
    @php
        /** @var App\Models\Video\VideoLikes $like */
        /** @var Illuminate\Database\Eloquent\Collection $likes */

        $collectionsLikes = $likes->chunk(6);
    @endphp

    <div class="card mb-4">
        <div class="card-body d-flex flex-column align-items-center">
            <h4>{{__('video/video.liked_videos')}}</h4>
        </div>
    </div>

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

    @include('video.includes.paginator', ['videos' => $likes])


@endsection
@push('script_files')

@endpush
{{--<script>--}}
@push('script')

@endpush
