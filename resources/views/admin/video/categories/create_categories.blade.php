@extends('layouts.app')
@section('content')

    <div class="card offset-2 col-md-8">
        <div class="card-body">
            <h4>Добавить категорию видео:</h4>
            <form action="{{route("admin.video.categories.store")}}" method="POST">
                @method("POST")
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">slug</label>
                    <div class="col-md-6">
                        <input id="name"
                               type="text"
                               class="form-control {{MainHelper::is_valid_form('slug')}}"
                               name="slug"
                               value="{{ old('slug') }}"
                               required autocomplete="slug" autofocus>
                        @error('slug')
                        <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title_ru" class="col-md-4 col-form-label text-md-right">title_ru</label>
                    <div class="col-md-6">
                        <input id="title_ru"
                               type="text"
                               class="form-control {{MainHelper::is_valid_form('title_ru')}}"
                               name="title_ru"
                               value="{{ old('title_ru') }}"
                               required autocomplete="name" autofocus>
                        @error('title_ru')
                        <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title_en" class="col-md-4 col-form-label text-md-right">title_en</label>
                    <div class="col-md-6">
                        <input id="title_en"
                               type="text"
                               class="form-control {{MainHelper::is_valid_form('title_en')}}"
                               name="title_en"
                               value="{{ old('title_en') }}"
                               required autocomplete="name" autofocus>
                        @error('title_en')
                        <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" class="font-weight-bold btn btn-light btn-block">{{ __('connexion/profiles.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
