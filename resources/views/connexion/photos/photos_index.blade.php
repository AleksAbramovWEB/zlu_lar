@extends('layouts.app')
@section('content')

    <div class="photos_index">

        <div class="card mb-4">
            <div class="card-body">
                <h3 class="text-center m-2">Moи фото:</h3>
                <form class="col-md-6 offset-md-3" action="{{route('connexion.photos.create')}}" method="get" enctype="multipart/form-data">
                    @method('get')
                    @csrf
                    <button type="submit" class="font-weight-bold btn btn-light btn-block mt-1 ">Добавить фото</button>
                </form>
            </div>
        </div>

        <div class="row">
            @php
                $int =  $photos->count() / 3;
                $photoCollections =  $photos->chunk(ceil($int));
            @endphp
            @foreach($photoCollections as $collection)
                <div class="col">
                    @foreach($collection AS $photo)
                        @php /** @var App\Models\Connexion\Photos\Photos $photo */@endphp
                            <div class="card mb-4">
                                <a href="{{route('connexion.photos.show', $photo)}}">
                                    <div class="card-body">
                                        <img src="{{$photo->path_s3}}">
                                    </div>
                                </a>
                            </div>
                        </label>
                    @endforeach
                </div>
            @endforeach
        </div>
        {{$photos->links('blades.my_paginator')}}
    </div>
@endsection
