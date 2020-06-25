@extends('layouts.app')
@push('css')

@endpush
@section('content')
    @php
        /** @var App\Models\Video\CategoriesVideo $category */
        /** @var App\Models\Video\VideoCategoryUnite $video */
        $collectionsVideo = $category->to_videos->chunk(6);

        $pagination = $category->paginate(30);
        $pagination->appends($request->toArray())->links();

        $sort = function ($name) use ($request, $category) {
            $params = [
                'slug' => $category->slug,
                'sort' => $name
            ];
            return route('video.category', $params);
        };

        $active =  function ($name) use ($request) {
            if ($request->sort == $name)
                return "disabled text-dark";
        };
    @endphp
    <div class="card mb-4">
        <div class="card-body d-flex flex-column align-items-center">
            <h4>{{__('video/video.video_category')}}: {{$category->title}}</h4>
            <ul class="nav justify-content-center w-75">
                <li class="nav-item w-25 text-center">
                    <a class="nav-link disabled " href="#">{{__('video/video.sort')}}:</a>
                </li>
                <li class="nav-item w-25 text-center">
                    <a class="nav-link {{$active('views')}}" href="{{$sort('views')}}">{{__('video/video.number_of_views')}}</a>
                </li>
                <li class="nav-item w-25 text-center">
                    <a class="nav-link {{$active('likes')}}" href="{{$sort('likes')}}">{{__('video/video.number_of_likes')}}</a>
                </li>
                <li class="nav-item w-25 text-center">
                    <a class="nav-link {{$active('created_at')}}" href="{{$sort('created_at')}}">{{__('video/video.date_added')}}</a>
                </li>
            </ul>
        </div>
    </div>


@foreach($collectionsVideo as $collection)
    <div class="card mb-4">
        <div class="card-body">
            @foreach($collection as $video)
                @if($loop->first)
                    <div class="row">
                @elseif(($loop->index % 3) === 0)
                    </div>
                    <div class="row">
                @endif
                         <div class="col">
                            <a href="{{route('video.library', $video->to_video->id)}}">
                                <img class="card-img-top" src="{{$video->to_video->s3_path_img}}" alt="Card image cap">
                                <div class="col">
                                     <div class="row">{{$video->to_video->title}}</div>
                                     <div class="row ">{{$video->to_video->description}}</div>
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

@include('video.includes.paginator', ['videos' => $pagination])


@endsection
@push('script_files')

@endpush
{{--<script>--}}
@push('script')

@endpush

