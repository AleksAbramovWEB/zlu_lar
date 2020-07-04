@php

    /**
     * @var App\Models\User $user
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
    <h5 class="mt-0">{{__('connexion/news.new_view_h5')}}:</h5>
    <p>{{__('connexion/news.user')}}
        <a href="{{route('connexion.profile', $user->id)}}">{{$user->name}}</a>
        {{__('connexion/news.new_view_p')}}.
    </p>
    <div class="d-flex justify-content-center">
        <img class="w-25" src="{{asset("img/svg/news_look_my_profile.svg")}}">
    </div>
</div>
