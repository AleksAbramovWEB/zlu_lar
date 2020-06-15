@extends('layouts.app')
@section('content')
    @php
        /** @var App\Models\Video\Video $video */
    @endphp

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success offset-1 col-md-10" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                Изменения успешно сохранены
            </div>
        @endif

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-dark">
                        <div class="card-body">
                            <div style="height:350px" class="players" id ="player"></div>
                        </div>
                    </div>
                    <br>
                    <div class="card border-dark">
                        <div class="card-body">
                            @foreach($video->to_categories AS $categoryUnite)
                                <span class="badge badge-light">{{$categoryUnite->to_category->title}}</span>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="card border-dark">
                        <div class="card-body">
                            <div class="col">
                                <div class="row">title_ru:</div>
                                <div class="row">{{$video->title_ru}}</div>
                            </div>
                            <div class="col">
                                <div class="row">title_en:</div>
                                <div class="row">{{$video->title_en}}</div>
                            </div>
                            <div class="col">
                                <div class="row">description_ru:</div>
                                <div class="row">{{$video->description_ru}}</div>
                            </div>
                            <div class="col">
                                <div class="row">description_en:</div>
                                <div class="row">{{$video->description_en}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card border-dark">
                                <div class="card-body">
                                    ID: {{$video->id}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card border-dark">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="mb-0" for="title">Опубликовано:</label>
                                        <input type="text" value="{{( (bool)$video->published ) ? 'ДА' : 'НЕТ'}}" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0" for="title">Создано</label>
                                        <input type="text" value="{{$video->created_at_local}}" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0" for="title">Изменено</label>
                                        <input type="text" value="{{$video->updated_at_local}}" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0" for="title">Удалено</label>
                                        <input type="text" value="{{$video->deleted_at_local}}" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card border-dark">
                                <div class="card-body text-center">
                                    <a href="{{route('admin.video.edit', $video)}}" class="text-center w-100">
                                        Редактировать
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card border-dark">
                                <div class="card-body text-center">
                                    <a href="#" id="delete" class="text-center w-100">
                                        {{(is_null($video->deleted_at)? 'Удалить' : "Востановить")}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card border-dark">
                                <div class="card-body text-center">
                                    <a href="{{route('admin.video.create')}}" class="text-center w-100">
                                        Добавить новое
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card border-dark">
                        <div class="card-body text-center">
                            <a href="{{route('admin.video.index')}}">к списку видео</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

          <span id="path_video" class="d-none">{{$video->s3_path_video}}</span>
          <span id="path_img" class="d-none">{{$video->s3_path_img}}</span>

    <form action="{{route("admin.video.destroy", $video)}}" method="POST" class="d-none" id="delete_form">
        @method('DELETE')
        @csrf
    </form>
@endsection
@push('script_files')
    <script src="{{asset("js/players/player_1.js")}}"></script>
@endpush
{{--<script>--}}
@push('script')


    $('#delete').on('click', function () {
        $('#delete_form').submit();
    });

    let video_href = $('#path_video').text();
    let img_href = $('#path_img').text();
    new Playerjs({
        id:"player",
        file: video_href,
        poster: img_href
    });
@endpush
