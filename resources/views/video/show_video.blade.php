@extends('layouts.app')
@push('css')
    <link href="{{ asset('css/owl/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl/owl.theme.default.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    @php
        /** @var App\Models\Video\Video $video */
    $my_like = '';
    @endphp
    <div class="col-md-8 offset-md-2 video">

        <div class="card border-dark mb-4">
            <div class="card-body">
                <div style="height:350px" class="players" id ="player"></div>
                <div class="d-flex justify-content-end flex-wrap mt-2">
                    <div class="d-flex align-items-center mr-4">
                        <div class="views_eye mr-2"></div>
                        <div style="font-size: 1rem">{{$video->views}}</div>
                    </div>
                    <div class="d-flex">
                        <div>@include('video.includes.like')</div>
                        <div id="count_likes" style="font-size: 1rem">{{$countLikes}}</div>
                    </div>
                </div>
                <h5 class="mb-0">{{$video->title}}</h5>
                <p class="mb-0">{{$video->description}}</p>
            </div>
        </div>

        <div class="card border-dark mb-4">
            <div class="card-body pt-1">
                <div class="m-0">{{__('video/video.refers_to_categories')}}:</div>
                <div class="text-center">
                    @foreach($video->to_categories AS $categoryUnite)
                        <a href="{{route("video.category", $categoryUnite->to_category->slug)}}">
                            <span class="badge badge-light">{{$categoryUnite->to_category->title}}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card border-dark mb-4">
            <div class="card-body pb-0 pt-1">
                <div class="m-0">{{__('video/video.related_video')}}:</div>
                <div class="owl-carousel categories ">
                    @php $img = []; @endphp
                    @foreach($video->to_categories AS $category)
                        @foreach($category->to_category->to_videos as $video_similar)
                            @if(empty($video_similar)) @continue
                            @elseif(in_array($video_similar->to_video->path_img, $img)) @continue
                            @else   @php $img[] = $video_similar->to_video->path_img; @endphp
                            @endif
                            <a href="{{route('video.library', $video_similar->to_video->id)}}">
                                <img  src="{{$video_similar->to_video->s3_path_img}}" title="{{$video_similar->to_video->title}}">
                            </a>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <span id="path_video" class="d-none">{{$video->s3_path_video}}</span>
    <span id="path_img" class="d-none">{{$video->s3_path_img}}</span>

@endsection
@push('script_files')
    <script src="{{asset("js/players/player_1.js")}}"></script>
    <script src="{{asset('js/owl/owl.carousel.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/imagesLoaded/imagesloaded.pkgd.min.js')}}" type="text/javascript"></script>
@endpush
{{--<script>--}}
@push('script')
    let video_href = $('#path_video').text();
    let img_href = $('#path_img').text();
    new Playerjs({
        id:"player",
        file: video_href,
        poster: img_href
    });

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


    window.addEventListener("message", function (event) {
        if (event.data.event === 'started') {
            console.log('ddd')
            $.ajax({
                url: "{{route('video.views', $video->id)}}",
                type: 'POST',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token',
                        $("meta[name='csrf-token']").attr('content')
                    );
                },
                data: ({video_views: true}),
            })
        }
    });

    $('#like').on('click', function () {
        $.ajax({
            url: '{{route('video.like', $video->id)}}',
            type: 'POST',
            data: ({like: true}),
            beforeSend: function(request) {
                @guest
                    window.location.replace('{{route('login')}}');
                @else
                    if ($('#like').hasClass('no_like')){
                        $('#like').removeClass('no_like');
                        $('#like').addClass('is_like');
                    }else {
                        $('#like').removeClass('is_like');
                        $('#like').addClass('no_like');
                    }

                    return request.setRequestHeader('X-CSRF-Token',
                        $("meta[name='csrf-token']").attr('content')
                    );
                @endguest
            },
        })
            .done(function(data) {
                let now = data.count;
                $('#count_likes').text(now);
            });
    });
@endpush

