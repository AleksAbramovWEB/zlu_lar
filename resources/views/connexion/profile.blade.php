@extends('layouts.app')
@section('content')
    @php /** @var App\Models\User $user */ @endphp
    <div class="row profile">
        <div class="col-4">
            <div class="card border-light">
                <div class="card-body">
                    <div class="avatars profile_avatar ">
                        <img src="{{$user->getAvatar()}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-light mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">{{$user->name}}, {{$user->getAge()}}</div>
                        <div class="col-4 text-right">{{$user->getOnline()}}</div>
                    </div>
                    <div class="mt-2">{{$user->greeting}}</div>
                </div>
            </div>
            <div class="card border-light">
                <div class="card-body">
                    @foreach($user->getInfo() AS $key => $val)
                        <div class="m-2">
                            <span>{{$key}}: </span><span>{{$val}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
