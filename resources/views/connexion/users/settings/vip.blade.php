@extends('layouts.app')
@section('content')

    <div class="settings_profile col-md-10 offset-md-1 kassa">

        @include('connexion.users.settings.includes.menu_settings')

        @if(session('success'))
            <div class="alert alert-success mb-4 border-light text-center" role="alert">
                @lang('connexion/profiles.successfully_acquired_wine_status_on') {{Declination::days(session('success'))}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
        @endif

        <div class="card border-light">
            <div class="card-body d-flex flex-column align-items-center">
                <h3>VIP</h3>
                @if(Auth::user()->vip > \Carbon\Carbon::now())
                @php
                    $days = Auth::user()->vip->diff(\Carbon\Carbon::now());
                @endphp
                    <h5 class="mb-3">@lang('connexion/profiles.vip_will_be_still_active')
                        @if($days->days > 0)
                             {{Declination::days($days->days)}}
                        @elseif($days->h > 0)
                             {{Declination::hours($days->h)}}
                        @else
                             {{Declination::minutes($days->i)}}
                        @endif
                    </h5>
                @endif
                <form action="{{route("connexion.my_profile.update.vip")}}" method="POST" class="mb-3">
                    @method('patch')
                    @csrf
                    @foreach(config('bz.bay_vip') as $coins => $days)
                        <div class="form-check w-auto">
                            <input class="form-check-input"
                                   type="radio"
                                   name="vip"
                                   id="vip_{{$days}}"
                                   value="{{$coins}}"
                                {{($coins !== 1) ?:  'checked'}}
                                {{($coins <= Auth::user()->coins) ?: 'disabled'}}
                            >
                            <label class="form-check-label" for="vip_{{$days}}">
                                {{(\Auth::user()->vip > \Carbon\Carbon::now())
                                ? __("connexion/profiles.prolong_vip_on")
                                : __("connexion/profiles.buy_vip_on")}}: {{Declination::days($days)}}
                                ({{Declination::coins($coins)}})
                            </label>
                        </div>
                    @endforeach
                    @if(Auth::user()->coins > 0)
                        <div class="form-group row mb-3 mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="font-weight-bold btn btn-light btn-block">{{ (\Auth::user()->vip > \Carbon\Carbon::now()) ? __('connexion/profiles.prolong_vip') : __('connexion/profiles.buy_vip') }}</button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
