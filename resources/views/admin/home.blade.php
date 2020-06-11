@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col">

            @role('master_manager')
            <div class="card border-dark mb-4">
                <div class="card-body">
                    <h5 class="text-center">Мастер панель</h5>
                    <ul>
                        <li><a href="{{route("admin.master.roles.index")}}">роли администаторов</a></li>
                        <li><a href="{{route("admin.master.permissions.index")}}">права администаторов</a></li>
                    </ul>
                </div>
            </div>
            @endrole
            <div class="card border-dark mb-4">
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
