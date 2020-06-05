@extends('layouts.app')
@section('content')

    <div class="settings_profile col-md-10 offset-md-1 kassa">

        @include('connexion.users.settings.includes.menu_settings')

        @if(session('success') === true)
            <div class="alert alert-success mb-4 border-light text-center" role="alert">
                @lang('kassa.success')
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
        @elseif(session('success') === false)
            <div class="alert alert-danger mb-4 border-light text-center" role="alert">
                @lang('kassa.error')
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
        @endif

        <div class="card border-light">
            <div class="card-body">
                <h4 class="text-center mb-2">@lang('kassa.replenish_account')</h4>
                <h5 class="text-center mb-4">{{__('kassa.you_have')}}: {{Declination::coins(Auth::user()->coins)}}!</h5>
                <form action="{{route("kassa.send")}}" method="POST" class="offset-md-3 col-md-7">
                    @method('post')
                    @csrf
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label  col-sm-2 pt-0">@lang('kassa.coins')</legend>
                            <div class="col-sm-10">
                            @foreach($prise['prise'] as $key => $val)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="coins"
                                           id="coins_{{$key}}"
                                           value="{{$key}}" {{($key !== 1) ?:  'checked'}}>
                                    <label class="form-check-label" for="coins_{{$key}}">
                                        {{__("kassa.replenish_account_on")}} {{Declination::coins_bay($key)}} ({{$val}} {{$prise['currency']}})
                                    </label>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label  col-sm-2 pt-0">@lang('kassa.kassa')</legend>
                            <div class="col-sm-10">
                            @foreach($kasses as $key => $val)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="name_kassa"
                                           id="kassa_{{$key}}"
                                           value="{{$key}}" {{($key !== key($kasses)) ?:  'checked'}}>
                                    <label class="form-check-label" for="name_kassa_{{$key}}">
                                        <img class="kassa_label" src="{{$val['img']}}" title="{{__($val['label'])}}">
                                    </label>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row mb-3 mt-4">
                        <div class="col-12">
                            <button type="submit" class="font-weight-bold btn btn-light btn-block">{{ __('kassa.go_pay') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
