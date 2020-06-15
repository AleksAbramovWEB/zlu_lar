@extends('layouts.app')
@section('content')
    @php
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
        <form action="{{route("admin.video.categories.update", $category)}}" method="POST">
            @method("PATCH")
            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <h5 class="text-center mb-1 mt-4">Редактировать категорию:</h5>
                            <div class="card-body">
                                <div class="form-group mb-1">
                                    <label for="slug" class="mb-0">slug:</label>
                                    <input class="form-control {{MainHelper::is_valid_form('slug')}}"
                                           id="slug"
                                           name="slug"
                                           value="{{ (old('title_ru')) ? old('title_ru') : $category->slug }}">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="title_ru" class="mb-0">title_ru:</label>
                                    <input class="form-control {{MainHelper::is_valid_form('title_ru')}}"
                                           id="title_ru"
                                           name="title_ru"
                                           value="{{ (old('title_ru')) ? old('title_ru') : $category->title_ru }}">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="title_en" class="mb-0">title_en:</label>
                                    <input class="form-control {{MainHelper::is_valid_form('title_en')}}"
                                           id="title_en"
                                           name="title_en"
                                           value="{{ (old('title_en')) ? old('title_en') : $category->title_en }}">
                                </div>
                                <br>
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="published" value="0">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="published"
                                           name="published"
                                           value="1"
                                           {{( (bool)$category->published) ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="published">published</label>
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <a href="{{route("admin.video.categories.index")}}">вернуться к списку категорий</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="card-body ">
                                        <button type="submit" class="font-weight-bold btn btn-light btn-block">{{__('connexion/profiles.save')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Создано</label>
                                            <input type="text" value="{{$category->created_at_local}}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Изменено</label>
                                            <input type="text" value="{{$category->updated_at_local}}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Удалено</label>
                                            <input type="text" value="{{$category->deleted_at_local}}" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <a href="#" id="delete" class="text-center w-100">
                                            {{(is_null($category->deleted_at)? 'удалить' : "востановить")}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <form action="{{route("admin.video.categories.destroy", $category)}}" method="POST" class="d-none" id="delete_form">
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
