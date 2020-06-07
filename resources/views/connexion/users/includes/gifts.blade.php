@php
    /** @var \App\Models\Connexion\Gifts\Gifts $gift */
@endphp
<div class="modal fade" id="exampleModalLongGift" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('connexion/profiles.make_gift')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route("connexion.profile.give.gift")}}" method="POST" id="form_give_gift">
                    @method("POST")
                    @csrf
                    <div class="text-danger text-center mb-1 mt-1" id="error_give_gift"></div>
                    <div class="gifts">
                        @foreach($gifts as $gift)
                            <input class="d-none"
                                   type="radio"
                                   name="gift_id"
                                   value="{{$gift->id}}"
                                   id="gift_{{$gift->id}}"
                                   {{($gift->price > Auth::user()->coins)? "disabled" : "" }}
                            >
                            <label class="gift d-block" for="gift_{{$gift->id}}">
                                <img src="{{asset($gift->path)}}" title="{{$gift->title}}">
                                <span class="price">{{$gift->price}}</span>
                            </label>
                        @endforeach
                    </div>
                    @if(Auth::user()->coins < $gifts[0]->price)
                        <div class="text-center text-danger">
                            <a href="{{route("kassa.index")}}">{{__("connexion/profiles.not_enough_coins")}}</a>
                        </div>
                    @else
                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="not_visible" value="1" name="not_visible">
                            <label class="custom-control-label" for="not_visible">{{__("connexion/profiles.sender_is_visible")}}</label>
                        </div>

                        <div class="form-group">
                            <label class="mb-0" for="gift_comment">{{__("connexion/profiles.gift_comment")}}:</label>
                            <textarea class="form-control" id="gift_comment" name="comment" rows="2"></textarea>
                        </div>

                        <input type="hidden" name="whom_user_id" value="{{$user->id}}">
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('connexion/profiles.close')}}</button>
                @if(Auth::user()->coins >= $gifts[0]->price)
                <button type="button" class="btn btn-light" id="give_gift">{{__('connexion/profiles.give')}}</button>
                @endif
            </div>
        </div>
    </div>
</div>

