@extends('layouts.app')
@section('content')
    @php /** @var App\Models\User $user */ @endphp
{{--    {{dd($user->avatar)}}--}}
    <div class="row profile">
        <div class="col-4">
            <div class="card border-light mb-4">
                <div class="card-body">
                    <div class="avatars profile_avatar ">
                        <img src="{{$user->getAvatar()}}">
                    </div>
                    @isset($user->avatar)
                        <form class="mt-3" method="post" enctype="multipart/form-data" action="{{route('connexion.my_profile.avatar.remove')}}">
                            @method('POST')
                            @csrf
                            <button type="submit" class="font-weight-bold btn btn-light btn-block mt-1 ">{{__('connexion/profiles.remove')}}</button>
                        </form>
                    @else
                    <form class="mt-3" method="post" enctype="multipart/form-data" action="{{route('connexion.my_profile.avatar')}}">
                        @method('POST')
                        @csrf
                        @error('avatar')
                        <div class="text-danger text-center" >{{$message}}</div>
                        @enderror
                        <div class="custom-file">
                            <style>
                                .custom-file-label::after {content: '{{__('connexion/profiles.browse')}}';}
                            </style>
                            <input name="avatar" type="file" class="custom-file-input" id="customFile" value="ss">
                            <label class="custom-file-label" for="customFile">{{__('connexion/profiles.choose_file')}}</label>
                        </div>
                        <button type="submit" class="font-weight-bold btn btn-light btn-block mt-1 ">{{__('connexion/profiles.load')}}</button>
                    </form>
                    @endisset
                </div>
            </div>

            @include('connexion.users.includes.gifts_given')

        </div>
        <div class="col-8">
            <div class="card border-light mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">{{$user->name}}, {{$user->getAge()}} @if($user->hasVip()) @include("connexion.users.includes.vip") @endif</div>
                        <div class="col-4 text-right">{{$user->getOnline()}}</div>
                    </div>
                    <div class="mt-2" id="greeting_view">{{$user->greeting}}</div>
                    @error('greeting')
                    <div class="text-danger text-center" >{{$message}}</div>
                    @enderror
                    <form class="form-inline d-none mt-2" id="greeting_form" method="post" action="{{route('connexion.my_profile.greeting')}}" >
                        @method('POST')
                        @csrf
                        <input type="text" class="form-control col-8 mb-2" name="greeting" value="{{$user->greeting}}">
                        <button type="submit" class="col-3 btn btn-light mb-2 ml-auto">{{__('connexion/profiles.save')}}</button>
                    </form>
                    <div class="row float-right" id="hrefs_greeting">
                        @isset($user->greeting)
                            <div class="mr-4"><a href="#" id="change_greeting">{{__('connexion/profiles.change')}}</a></div>
                            <div class="mr-4"><a href="#" id="remove_greeting">{{__('connexion/profiles.remove')}}</a></div>
                            <form id="greeting_remove_form" action="{{ route('connexion.my_profile.greeting.remove') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <div class="mr-4"><a href="#" id="change_greeting">{{__('connexion/profiles.write_greeting')}}</a></div>
                        @endisset
                    </div>
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

    <script type="text/javascript">
        $('#change_greeting').on('click', function () {
            $('#greeting_form').removeClass('d-none');
            $('#hrefs_greeting').addClass('d-none')
            $('#greeting_view').addClass('d-none')
        })
        $('#remove_greeting').on('click', function () {
            $('#greeting_remove_form').submit();
        })

        $(function(){
            $('[data-toggle="popover"]').popover({
                trigger: 'focus',
                html: true
            })
        });
    </script>

@endsection
