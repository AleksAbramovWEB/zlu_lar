@extends('layouts.app')
@section('content')

    <div class="card border-dark mb-4">
        <div class="card-body">
            <a href="{{route("admin.video.create")}}">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="font-weight-bold btn btn-light btn-block">ДОБАВИТЬ ВИДЕО</button>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        @php
            /** @var Illuminate\Database\Eloquent\Collection  $films */
                $int =  $films->count() / 3;
                $filmsCollections =  $films->chunk(ceil($int));
        @endphp
        @foreach($filmsCollections as $collection)
            <div class="col">
                @foreach($collection AS $video)
                    @php /** @var App\Models\Video\Video  $video */@endphp
                    <div class="card mb-4 {{($video->deleted_at) ? 'border-danger' : 'border-dark'}}">
                        <div class="card-body">
                            @if($video->deleted_at)
                                <div class="text-danger text-center">
                                    видео удалено
                                </div>
                            @endif
                            <img class="card-img-top" src="{{$video->s3_path_img}}" alt="Card image cap">
                            <div class="col">
                                <a href="{{route('admin.video.show', $video)}}">
                                    <div class="row">{{$video->title}}</div>
                                    <div class="row ">{{$video->description}}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        @if($filmsCollections->count() == 2)
            <div class="col"></div>
        @endif
        @if($filmsCollections->count() == 1)
            <div class="col"></div>
            <div class="col"></div>
        @endif
    </div>

    {{$films->links('blades.my_paginator')}}
@endsection
