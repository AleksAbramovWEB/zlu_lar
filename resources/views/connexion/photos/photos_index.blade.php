@extends('layouts.app')
@section('content')

    <div class="photos_index">

        <div class="card mb-4">
            <div class="card-body">
                <h3 class="text-center m-2">{{__('connexion/photos.my_photos')}}:</h3>
                <form class="col-md-6 offset-md-3" action="{{route('connexion.photos.create')}}" method="get" enctype="multipart/form-data">
                    @method('get')
                    @csrf
                    <button type="submit" class="font-weight-bold btn btn-light btn-block mt-1 ">{{__('connexion/photos.add_photo')}}</button>
                </form>
            </div>
        </div>

        @include('connexion.photos.includes.for_index_photo')

    </div>
@endsection
