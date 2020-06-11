@php
    /** @var App\Models\User $user */
    $min_price = null;
@endphp
<div class="modal fade" id="exampleModalLongVip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('connexion/profiles.make_vip')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex flex-column align-items-center">
                <form action="{{route('connexion.profile.give.vip')}}" method="POST" id="form_give_vip">
                    @method("POST")
                    @csrf
                    @foreach(config('bz.bay_vip') as $coins => $days)
                    @php if (is_null($min_price)) $min_price = $coins @endphp
                        <div class="form-check w-auto">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <input class="form-check-input"
                                   type="radio"
                                   name="vip"
                                   id="vip_{{$days}}"
                                   value="{{$coins}}"
                                {{($coins !== 1) ?:  'checked'}}
                                {{($coins <= Auth::user()->coins) ?: 'disabled'}}
                            >
                            <label class="form-check-label" for="vip_{{$days}}">
                                {{__("connexion/profiles.give_vip_on")}}: {{Declination::days($days)}}
                                ({{Declination::coins($coins)}})
                            </label>
                        </div>
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('connexion/profiles.close')}}</button>
                @if(Auth::user()->coins >= $min_price)
                    <button type="button" class="btn btn-light" id="give_vip">{{__('connexion/profiles.give')}}</button>
                @endif
            </div>
        </div>
    </div>
</div>
