@extends('layouts.app')
@section('content')

<div class="card border-dark mb-4">
    <div class="card-body">
        <a href="{{route("admin.connexion.gifts.create")}}">
            <div class="col-md-8 offset-md-2">
                <button type="submit" class="font-weight-bold btn btn-light btn-block">ДОБАВИТЬ ПОДАРОК</button>
            </div>
        </a>
    </div>
</div>

<div class="row">
    @php
        $int =  $gifts->count() / 5;
        $giftsCollections =  $gifts->chunk(ceil($int));
    @endphp
    @foreach($giftsCollections as $collection)
        <div class="col">
            @foreach($collection AS $gift)
                @php /** @var App\Models\Connexion\Gifts\Gifts  $gift*/@endphp
                <div class="card mb-4 {{($gift->deleted_at) ? 'border-danger' : 'border-dark'}}">
                    @if($gift->deleted_at)
                        <div class="text-danger text-center">
                            подарок удален
                        </div>
                    @endif
                    <img class="card-img-top pl-3 pr-3" src="{{ asset($gift->path) }}" alt="Card image cap">
                    <div class="pl-2">
                        <div class="row">
                            <div class="col-auto">title_ru:</div>
                            <div class="col">{{$gift->title_ru}}</div>
                        </div>
                        <div class="row">
                            <div class="col-auto">title_en</div>
                            <div class="col">{{$gift->title_en}}</div>
                        </div>
                        <div class="row">
                            <div class="col-auto">__цена:</div>
                            <div class="col">{{$gift->price}}</div>
                        </div>
                    </div>
                    <a class="text-center" href="{{route('admin.connexion.gifts.edit', $gift)}}">редактировать</a>
                </div>

            @endforeach
        </div>
    @endforeach
</div>



@endsection
