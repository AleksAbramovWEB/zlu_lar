@extends('layouts.app')
@section('content')

    <div class="photos_index">
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="text-center m-2">{{__('connexion/photos.user_photo')}}: {{$name}}</h3>
            </div>
        </div>


        @include('connexion.photos.includes.for_index_photo')


    </div>
@endsection
