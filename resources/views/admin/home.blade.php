@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-body">
                    <h5 class="text-center">Знакомства</h5>
                    <ul>
                        <li><a href="{{route("admin.connexion.gifts.index")}}">подарки</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
    </div>

@endsection
