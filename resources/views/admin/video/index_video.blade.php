@extends('layouts.app')
@section('content')

    <div class="card border-dark mb-4">
        <div class="card-body">

            <div class="row">
                <div class="col">
                    @include('admin.video.includes.stats_video', ['stats' => $stats])
                </div>
                <div class="col d-flex flex-column justify-content-center align-items-center">
                    <h4>Сортировать по:</h4>
                    @php
                        $rez = function ($column) use ($request){
                            $columnRequest = $request->input('column');
                            if ($column === 'created_at' AND empty($request->input('direction')))
                                $direction = 'desk';
                            elseif ($column === $columnRequest)
                                    $direction = ($request->input('direction') === 'desk') ? 'asc' : 'desk' ;
                            else    $direction = 'asc';
                            return [
                                'column' => $column,
                                'direction' => $direction,
                                'page' => $request->input('page')
                            ];
                        }
                    @endphp
                    <a href="{{route("admin.video.index", $rez('created_at'))}}">дате добавления</a>
                    <a href="{{route("admin.video.index", $rez('updated_at'))}}">дате изменения</a>
                    <a href="{{route("admin.video.index", $rez('deleted_at'))}}">дате удаления</a>
                    <a href="{{route("admin.video.index", $rez('published'))}}">опубликованности</a>
                    <a href="{{route("admin.video.index", $rez('views'))}}">количеству просмотров</a>
                    <a href="{{route("admin.video.index", $rez('likes'))}}">количеству лайков</a>
                    <div class="w-100 mt-3">{{$films->links('blades.my_paginator_simple')}}</div>
                </div>

                <div class="col d-flex flex-column justify-content-center align-items-center">
                    <a href="{{route("admin")}}">На главную админки</a>
                    <a href="{{route("admin.video.create")}}">Добавить видео</a>
                    <a href="{{route("admin.video.categories.index")}}">Список категорий</a>
                    <a href="{{route("admin.video.categories.create")}}">Добавить категорию</a>
                </div>
            </div>
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
