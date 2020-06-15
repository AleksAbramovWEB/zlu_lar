@extends('layouts.app')
@section('content')
    @if($errors->any())
        <div class="alert alert-danger offset-md-2 col-md-8" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
            {{$errors->first()}}
        </div>
    @endif
    <div class="card offset-md-1 col-md-10">
        <div class="card-body pl-5 pr-5">
            <h4>Добавить видео:</h4>
            <form action="{{route("admin.video.store")}}" method="POST" enctype="multipart/form-data">
                @method("POST")
                @csrf
                <div class="custom-file col mb-3">
                    <style>
                        .custom-file-label::after {content: '{{__('connexion/profiles.browse')}}';}
                    </style>
                    <input name="video" type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">выберите видео</label>
                    @error('video')
                    <span class="invalid-feedback " role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="custom-file col mb-2">
                    <style>
                        .custom-file-label::after {content: '{{__('connexion/profiles.browse')}}';}
                    </style>
                    <input name="img" type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">выберите изображение</label>
                    @error('img')
                    <span class="invalid-feedback " role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="mb-0" for="title_ru">title_ru</label>
                    <input type="text"
                           class="form-control {{MainHelper::is_valid_form('title_ru')}}"
                           id="title_ru"
                           value="{{old('title_ru')}}"
                           name="title_ru">
                    @error('title_ru')
                    <span class="invalid-feedback " role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="mb-0" for="title_en">title_en</label>
                    <input type="text"
                           class="form-control {{MainHelper::is_valid_form('title_en')}}"
                           id="title_en"
                           value="{{old('title_en')}}"
                           name="title_en">
                    @error('title_en')
                    <span class="invalid-feedback " role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="mb-0" for="description_ru">description_ru</label>
                    <textarea type="text"
                           class="form-control {{MainHelper::is_valid_form('description_ru')}}"
                           id="description_ru"
                           name="description_ru">{{old('description_ru')}}</textarea>
                    @error('description_ru')
                    <span class="invalid-feedback " role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="mb-0" for="description_ru">description_en</label>
                    <textarea type="text"
                           class="form-control {{MainHelper::is_valid_form('description_en')}}"
                           id="description_en"
                           name="description_en">{{old('description_en')}}</textarea>
                    @error('description_en')
                    <span class="invalid-feedback " role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div>
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
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               value="1"
                                               name="category_{{$category->id}}"
                                               id="category_{{$category->id}}">
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


                <div class="form-group row mb-4 mt-4">
                    <button type="submit" class="mr-3 ml-3 font-weight-bold btn btn-light btn-block">{{ __('connexion/profiles.load') }}</button>
                </div>
            </form>
        </div>
    </div>


@endsection
