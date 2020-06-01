@extends('layouts.app')
@section('content')

    <div class="user_photos col-md-8 offset-md-2">
        @error('photo')
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
            {{$message}}
        </div>
        @enderror
        <div class="card">
            <div class="card-body">
                <h3 class="text-center m-2">Добавить фото:</h3>
                <form class="col-md-10 offset-md-1" action="{{route('connexion.photos.store')}}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="custom-file col mb-2 ">
                        <style>
                            .custom-file-label::after {content: '{{__('connexion/profiles.browse')}}';}
                        </style>
                        <input name="photo" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">{{__('connexion/profiles.choose_file')}}</label>
                    </div>
                    <div class="form-group">
                        <label for="description" class="mb-0">Добавить описание:</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="font-weight-bold btn btn-light btn-block mt-1 mb-3">{{__('connexion/profiles.load')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
