@extends('layouts.app')
@section('content')
    @php /** @var App\Models\User $user */ @endphp
    <div class="row profile">

        <div class="col-4">
            <div class="card border-light mb-4">
                <div class="card-body">
                    <div class="avatars profile_avatar ">
                        <img src="{{$user->getAvatar()}}">
                    </div>
                </div>
            </div>
            <div class="card border-light  mb-4">
                <div class="card-body d-flex flex-column text-center">
                    <a href="#" id="write_new_message">
                        @lang('connexion/profiles.write_message')
                    </a>
                    <a href="#" data-toggle="modal" data-target="#exampleModalLongGift">{{__('connexion/profiles.make_gift')}}</a>
                    <a href="#" data-toggle="modal" data-target="#exampleModalLongVip">{{__('connexion/profiles.make_vip')}}</a>
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

        @include('connexion.users.includes.gifts')
        @include('connexion.users.includes.vip_give')

    </div>

    <form class="d-none"
          action="{{route('connexion.messenger.new_contact')}}"
          method="POST"
          id ="write_new_message_form">
        @method('post')
        @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}">
    </form>

    <script type="text/javascript">

        $('#write_new_message').on('click', function () {
            $('#write_new_message_form').submit();
        });

        $("#give_gift").on("click", function () {
            let gift = $('input[name="gift_id"]:checked').val();
            if(!!gift) $("#form_give_gift").submit()
            else $("#error_give_gift").text("{{__('connexion/profiles.not_selected_gift')}}")
        });

        $("#give_vip").on("click", function () {
            $("#form_give_vip").submit();
        });

        $('textarea[name=comment]').keyup( function(){
            let $this = $(this);
            if($this.val().length > 190)
                $this.val($this.val().substr(0, 190));
        });
        $(function(){
            $('[data-toggle="popover"]').popover({
                trigger: 'focus',
                html: true
            })

        });

    </script>
@endsection
