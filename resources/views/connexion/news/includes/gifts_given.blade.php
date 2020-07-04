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


@endphp
<a href="{{route('connexion.profile', $user->id)}}">
    <div class="d-flex align-self-center mr-3 avatars">
        <img src="{{$user->getAvatar()}}">
    </div>
</a>

<div class="media-body">
    <h5 class="mt-0">{{__('connexion/news.new_gift_h5')}}:</h5>
    <p>{{__('connexion/news.new_gift_p')}} "{{$parameters->gifts_title}}" {{__('connexion/news.user_from')}}
        <a href="{{route('connexion.profile', $user->id)}}">{{$user->name}}</a> :
    </p>
    @if(!empty($parameters->gifts_comment))
        <p>"{{$parameters->gifts_comment}}"</p>
    @endif
    <div class="d-flex justify-content-center">
        <img class="w-25" src="{{asset($parameters->gifts_path)}}">
    </div>
</div>
