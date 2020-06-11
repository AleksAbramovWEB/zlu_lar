@extends('layouts.app')
@section('content')
    @php
        /**
         * @var \Illuminate\Database\Eloquent\Collection $permissions
         * @var \App\Models\Admins\Access\Permissions $permission
         */
    @endphp
    <div class="card offset-2 col-md-8">
        <div class="card-body">
            <h4>Права админстраторов:</h4>
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
                @foreach($permissions as $permission)
                    <tr>
                        <th scope="row">{{$permission->id}}</th>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->slug}}</td>
                        <td><a href="{{route("admin.master.permissions.edit", $permission)}}">редактировать</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{route("admin.master.permissions.create")}}">добавить право</a>
        </div>
    </div>


@endsection
