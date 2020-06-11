@extends('layouts.app')
@section('content')
@php
    /**
     * @var \Illuminate\Database\Eloquent\Collection $roles
     * @var \App\Models\Admins\Access\Roles $role
     */
@endphp
    <div class="card offset-2 col-md-8">
        <div class="card-body">
            <h4>Роли админстраторов:</h4>
            <table class="table">
                <thead>
                <tr>
                    <th>#id</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <th scope="row">{{$role->id}}</th>
                        <td>{{$role->name}}</td>
                        <td>{{$role->slug}}</td>
                        <td><a href="{{route("admin.master.roles.edit", $role)}}">редактировать</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{route("admin.master.roles.create")}}">добавить роль</a>
        </div>
    </div>


@endsection
