@extends('layouts.app')
@section('content')
    @php /** @var App\Models\Connexion\Photos\Photos $photo */@endphp
    <div class="photos_show col-md-8 offset-md-2">

        <div class="card mb-4">
            <div class="card-body">
                <img class="photo ml-auto mr-auto d-block" src="{{$photo->path_s3}}">
                <div class="row mt-3">
                    <div class="col">@lang('connexion/photos.added') {{$photo->returnLocalDate()}}</div>
                    <div class="col text-right">
                        @auth
                             @include('connexion.photos.includes.like') <span id="count_likes">{{$likes_count}}</span>
                        @endauth
                    </div>
                </div>
                <div class="text-justify">{{$photo->description}}</div>
                @if(\Auth::id() === $photo->user_id)
                <div class="text-right w-100">
                    <a href="{{route('connexion.photos.edit', $photo)}}">@lang('connexion/photos.edit')</a>
                </div>
                @endif
            </div>
        </div>

        @auth
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{route('connexion.photos.comment.store')}}" method="POST">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="photo_id" value="{{$photo->id}}">
                        <div class="form-group">
                            <label for="description" class="mb-0">@lang('connexion/photos.left_comment'):</label>
                            <textarea class="form-control" id="description" name="comment" rows="2"></textarea>
                        </div>
                        <button type="submit" class="font-weight-bold btn btn-light btn-block mt-1 mb-3">
                            @lang('connexion/photos.send')
                        </button>
                    </form>
                </div>
            </div>
        @endauth

        @foreach($comments AS $comment)
            @php /** @var App\Models\Connexion\Photos\PhotosComment  $comment */ @endphp

            <div class="card mb-4">
                <div class="card-body row">
                    <div class="col-2 flex-column">
                        <a href="{{route("connexion.profile", $comment->to_user_id->id)}}">
                            <div class="avatars">
                                <img src="{{$comment->to_user_id->getAvatar()}}">
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <div class="row mb-1">
                            <div class="col">
                                <a href="{{route("connexion.profile", $comment->to_user_id->id)}}">
                                    {{$comment->to_user_id->name}}
                                </a>,
                                {{$comment->to_user_id->getAge()}}
                            </div>
                            <div class="col text-right">{{$comment->to_user_id->getOnline()}}</div>
                        </div>
                        <div class="text-justify comment">{{$comment->comment}}</div>
                        <div class="row mt-auto mb-0" >
                            <div class="col" >@lang('connexion/photos.left'): {{$comment->left_time()}}</div>
                            @if($comment->to_user_id->id == \Auth::id() OR $photo->user_id == \Auth::id())
                                <div class="col text-right">
                                    <a href="{{route('connexion.photos.comment.destroy', $comment->id)}}"
                                       class="remove_comment">
                                       @lang('connexion/photos.remove_comment')
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{$comments->links('blades.my_paginator')}}

        <form action="" method="POST" id="remove_comment">
            @method('DELETE')
            @csrf
        </form>

        <script type="text/javascript">
            $('.remove_comment').on('click', function (e) {
                e.preventDefault();
                let href = $(this).attr('href');
                $('#remove_comment').attr('action', href);
                $('#remove_comment').submit();
            });

            $('#like').on('click', function () {
                console.log('ddd')
                $.ajax({
                    url: '{{route('connexion.photos.like')}}',
                    type: 'POST',
                    data: ({photo_id:'{{$photo->id}}'}),
                    beforeSend: function(request) {
                        return request.setRequestHeader('X-CSRF-Token',
                            $("meta[name='csrf-token']").attr('content')
                        );
                    },
                })
                .done(function(data) {
                    let last = Number($('#count_likes').text());
                    let now = data.count;
                    if(last < now){
                        $('#like').removeClass('no_like');
                        $('#like').addClass('is_like');
                    }else {
                        $('#like').removeClass('is_like');
                        $('#like').addClass('no_like');
                    }
                    $('#count_likes').text(now);
                });
            });


        </script>

    </div>
@endsection
