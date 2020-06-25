@extends('layouts.app')
@push('css')
    <link href="{{ asset('css/owl/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl/owl.theme.default.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    @php
    /** @var Illuminate\Database\Eloquent\Collection $categories */
    /** @var Illuminate\Database\Eloquent\Collection $collectionsVideo */
    /** @var Illuminate\Database\Eloquent\Collection $collection */
    /** @var Illuminate\Database\Eloquent\Collection $videos */
    /** @var App\Models\Video\CategoriesVideo $category */
    /** @var Illuminate\Support\Collection $categories_list */
    /** @var App\Models\Video\Video $video */

    $collectionsVideo = $videos->chunk(6);
    $checkCategoryImg = [];

    $sort = function ($name) use ($request) {
        $params = [
            'sort' => $name
        ];
        return route('video', $params);
    };

    $active =  function ($name) use ($request) {
        if ($request->sort == $name)
            return "disabled text-dark";
    };

    @endphp
    <div class="card mb-4">
        <div class="card-body d-flex flex-column align-items-center">
            <h4 class="text-center">{{__('video/video.bdsm_video')}}</h4>
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
                                <a href="{{route('video.library', $video->id)}}">
                                    <img class="card-img-top" src="{{$video->s3_path_img}}" alt="Card image cap">
                                    <div class="col">
                                        <div class="row">{{$video->title}}</div>
                                        <div class="row ">{{$video->description}}</div>
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

    @include("video.includes.paginator")

    <div class="card">
        <div class="card-body pt-1">
            <h5 class="m-0">{{__('video/video.video_categories')}}:</h5>
            <div class="owl-carousel categories">
                @foreach($categories AS $category)
                    @php $img = NULL @endphp
                    @foreach($category->to_videos AS $video)
                        @if(in_array($video->to_video->path_img, $checkCategoryImg)) @continue
                        @else @php
                            $checkCategoryImg[] = $video->to_video->path_img;
                            $img = $video->to_video->s3_path_img;
                        @endphp @endif
                    @endforeach
                    @if(is_null($img)) @continue @endif
                    <a href="{{route('video.category', $category->slug)}}">
                            <img  src="{{$img}}" title="{{$category->title}}">
                    </a>
                @endforeach
            </div>
            <div class="text-center">
                @foreach($categories_list as $category)
                    <a href="{{route('video.category', $category->slug)}}">
                        <span class="badge badge-light">{{$category->title}}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>



@endsection
@push('script_files')
    <script src="{{asset('js/owl/owl.carousel.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/imagesLoaded/imagesloaded.pkgd.min.js')}}" type="text/javascript"></script>
@endpush
{{--<script>--}}
@push('script')
    let carousel = $('.owl-carousel');
    carousel.imagesLoaded(function () {
         carousel.owlCarousel({
            margin:5,
            autoWidth:true,
            loop:true,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            animateOut: 'fadeOut'
        });
    });
@endpush
