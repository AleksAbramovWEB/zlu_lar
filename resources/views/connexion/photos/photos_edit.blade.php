@extends('layouts.app')
@section('content')
    @php /** @var App\Models\Connexion\Photos\Photos $photo */@endphp
    <div class="photos_edit col-md-8 offset-md-2">
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
                <img class="photo ml-auto mr-auto d-block" src="{{$photo->path_s3}}">
                <form class="" action="{{route('connexion.photos.update', $photo)}}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="form-group mt-4">
                        <label for="description" class="mb-0">@lang('connexion/photos.change_description'):</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{$photo->description}}</textarea>
                    </div>
                    <button type="submit" class="font-weight-bold btn btn-light btn-block mt-1 mb-3">
                        @lang('connexion/photos.save_description')
                    </button>
                </form>
                <form class="" action="{{route('connexion.photos.destroy', $photo)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="font-weight-bold btn btn-danger btn-block mt-1 mb-3">
                        @lang('connexion/photos.remove_photo')
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
