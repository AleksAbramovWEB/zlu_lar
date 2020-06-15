@extends('layouts.app')
@section('content')
    @php
        /** @var App\Models\Video\Video $video */
        /** @var Illuminate\Database\Eloquent\Collection $categories */
        /** @var App\Models\Video\CategoriesVideo $category */

    @endphp

    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger offset-1 col-md-10" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                {{$errors->first()}}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success offset-1 col-md-10" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                Изменения успешно сохранены
            </div>
        @endif
        <form action="{{route("admin.video.update", $video)}}" method="POST">
            @method("PATCH")
            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card border-dark">
                            <h5 class="text-center mb-1 mt-4">Редактировать видео:</h5>
                            <div class="card-body">
                                <div class="form-group mb-1">
                                    <label for="title_ru" class="mb-0">title_ru:</label>
                                    <input class="form-control {{MainHelper::is_valid_form('title_ru')}}"
                                           id="title_ru"
                                           name="title_ru"
                                           value="{{ old('title_ru') ?? $video->title_ru }}">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="title_en" class="mb-0">title_en:</label>
                                    <input class="form-control {{MainHelper::is_valid_form('title_en')}}"
                                           id="title_en"
                                           name="title_en"
                                           value="{{ old('title_en') ?? $video->title_en }}">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="description_ru" class="mb-0">title_en:</label>
                                    <textarea class="form-control {{MainHelper::is_valid_form('description_ru')}}"
                                           id="description_ru"
                                           name="description_ru">{{ old('description_ru') ?? $video->description_ru }}
                                    </textarea>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="description_en" class="mb-0">title_en:</label>
                                    <textarea class="form-control {{MainHelper::is_valid_form('description_en')}}"
                                           id="description_en"
                                           name="description_en">{{ old('description_en') ?? $video->description_en }}
                                    </textarea>
                                </div>
                                <br>
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="published" value="0">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="published"
                                           name="published"
                                           value="1"
                                        {{( (bool)$video->published) ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="published">published</label>
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="card border-dark">
                            <div class="card-body">
                                Категории:
                                @php
                                        $int =  $categories->count() / 3;
                                        $categoriesCollections =  $categories->chunk(ceil($int));
                                @endphp
                                <div class="row ml-4">
                                    @foreach($categoriesCollections AS $categoriesQ)
                                        <div class="col">
                                            @foreach($categoriesQ as $category)
                                                <div class="custom-control custom-checkbox">
                                                    <input type="hidden" name="category_{{$category->id}}" value="0">
                                                    <input type="checkbox"
                                                           class="custom-control-input"
                                                           value="1"
                                                           name="category_{{$category->id}}"
                                                           id="category_{{$category->id}}"
                                                    @foreach($video->to_categories AS $to_category)
                                                    {{($to_category->to_category->id == $category->id) ? 'checked' : '' }}
                                                    @endforeach>
                                                    <label class="custom-control-label" for="category_{{$category->id}}">{{$category->title}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    @if($categoriesCollections->count() == 2)
                                        <div class="col"></div>
                                    @endif
                                    @if($categoriesCollections->count() == 1)
                                        <div class="col"></div>
                                        <div class="col"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card border-dark">
                                    <div class="card-body ">
                                        <button type="submit" class="font-weight-bold btn btn-light btn-block">{{__('connexion/profiles.save')}}</button>
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
                                            <label for="title">Создано</label>
                                            <input type="text" value="{{$video->created_at_local}}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Изменено</label>
                                            <input type="text" value="{{$video->updated_at_local}}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Удалено</label>
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
                                        <a href="#" id="delete" class="text-center w-100">
                                            {{(is_null($video->deleted_at)? 'удалить' : "востановить")}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card border-dark">
                            <div class="card-body text-center">
                                <a href="{{route("admin.video.show", $video)}}">смотеть видео</a>
                            </div>
                        </div>
                        <br>
                        <div class="card border-dark">
                            <div class="card-body text-center">
                                <a href="{{route("admin.video.index")}}">список видео</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <form action="{{route("admin.video.destroy", $video)}}" method="POST" class="d-none" id="delete_form">
        @method('DELETE')
        @csrf
    </form>
@endsection
{{--<script>--}}
@push('script')

    $('#delete').on('click', function () {
    $('#delete_form').submit();
    });
@endpush
