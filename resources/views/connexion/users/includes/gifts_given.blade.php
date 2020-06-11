
@php
    /**
     * @var Illuminate\Database\Eloquent\Collection $giftsGiven
     * @var App\Models\Connexion\Gifts\GiftsGiven $giftGiven
     */
@endphp
@if($giftsGiven->isNotEmpty())
    <div class="card border-light mb-4">
        <div class="card-body">
            <h5>{{__("connexion/profiles.gifts")}}:</h5>
            <div class="gifts_given">
                @foreach($giftsGiven AS $giftGiven)
    @php

        if($giftGiven->not_visible == 1 AND $giftGiven->whom_user_id != \Auth::id() AND $giftGiven->from_user_id != \Auth::id()){
             $avatar = '<img class="question_user d-flex align-self-center mr-3"  src="'.asset('img/svg/question_user.svg').'">';
             $name = '<span>'.__('connexion/profiles.hidden').'</span>';
             $comment = __('connexion/profiles.sender_decided');
        }else{
             $avatar = '<div class="d-flex align-self-center mr-3 avatars popover_avatar" >
                            <img src="'. $giftGiven->to_from_user_id->getAvatar().'">
                        </div>';
             $name = '<a href="'.route("connexion.profile", $giftGiven->to_from_user_id->id).'">'.$giftGiven->to_from_user_id->name.'</a>';
             $comment = $giftGiven->comment;
        }

        $popover = '
            <div class="media">
                 '.$avatar.'
                 <div class="media-body">
                     '.$name.'
                     <p>'.$comment.'</p>
                  </div>
            </div>
        ';
    @endphp
                    <div class="gift_given"
                         role="button"
                         data-trigger="focus"
                         tabindex="0"
                         data-container="body"
                         data-toggle="popover"
                         data-placement="top"
                         data-content='{{$popover}}'>
                        <img src="{{asset($giftGiven->to_gift_id->path)}}" title="{{$giftGiven->to_gift_id->title}}">
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endif
