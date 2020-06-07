@extends('layouts.app')
@section('content')

    <div class="user_photos col-md-8 offset-md-2">
        @if($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
            {{$errors->first()}}
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h3 class="text-center m-2">Добавить подарок:</h3>
                <form class="col-md-10 offset-md-1" action="{{route('admin.connexion.gifts.store')}}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="custom-file col mb-2 ">
                        <style>
                            .custom-file-label::after {content: '{{__('connexion/profiles.browse')}}';}
                        </style>
                        <input name="picture"
                               type="file"
                               class="custom-file-input {{MainHelper::is_valid_form('picture')}}"
                               id="customFile">
                        <label class="custom-file-label" for="customFile">{{__('connexion/profiles.choose_file')}}</label>
                    </div>
                    <div class="form-group mb-1">
                        <label for="title_ru" class="mb-0">title_ru:</label>
                        <input class="form-control {{MainHelper::is_valid_form('title_ru')}}"
                               id="title_ru"
                               name="title_ru"
                               value="{{old('title_ru')}}">
                    </div>
                    <div class="form-group mb-1">
                        <label for="title_en" class="mb-0">title_en:</label>
                        <input class="form-control {{MainHelper::is_valid_form('title_en')}}"
                               id="title_en"
                               name="title_en"
                               value="{{old('title_en')}}">
                    </div>
                    <div class="form-group">
                        <label for="price" class="mb-0">цена:</label>
                        <select name="price"
                                class="custom-select {{MainHelper::is_valid_form('price')}}"
                                id="price">
                            <option></option>
                        @for($i = 1; $i <= 50; $i++)
                            <option value="{{$i}}" {{(old('price') == $i) ? 'selected':''}}>{{$i}}</option>
                        @endfor
                        </select>
                    </div>
                    <button type="submit" class="font-weight-bold btn btn-light btn-block mt-1 mb-3">{{__('connexion/profiles.load')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
