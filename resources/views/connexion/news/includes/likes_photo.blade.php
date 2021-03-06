@php

    /**
     * @var App\Models\User $user
     * @var App\Models\Connexion\Photos\Photos $photo
    */

    $parameters = json_decode($new->parameters);
    $user->id = $parameters->user_id;
    $user->name = $parameters->user_name;
    $user->avatar = $parameters->user_avatar;
    $user->position = $parameters->user_position;
    $user->gender = $parameters->user_gender;
    $photo->path = $parameters->photos_path;
    $photo->id = $parameters->photos_id;

@endphp
<a href="{{route('connexion.profile', $user->id)}}">
    <div class="d-flex align-self-center mr-3 avatars">
        <img src="{{$user->getAvatar()}}">
    </div>
</a>

<div class="media-body">
    <h5 class="mt-0">{{__('connexion/news.new_like_h5')}}:</h5>
    <p>{{__('connexion/news.user')}}
        <a href="{{route('connexion.profile', $user->id)}}">{{$user->name}}</a>
        {{__('connexion/news.new_like_p')}}:
    </p>
    <a href="{{route('connexion.photos.show', $photo->id)}}">
        <div>
            <img class="w-100" src="{{$photo->path_s3}}">
        </div>
    </a>
</div>
