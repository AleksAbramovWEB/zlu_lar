@extends('layouts.app')
@section('content')

    @php
        /** @var App\Models\User $user */

        $countryScript = true;
    @endphp

    <div class="settings_profile col-md-10 offset-md-1">

        @include('connexion.users.settings.includes.menu_settings')

        @if(session('success'))
            <div class="alert alert-success mb-4 border-light text-center" role="alert">
                @lang('connexion/profiles.success')
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
        @endif

        <div class="card border-light">
            <div class="card-body">
                <h4 class="text-center mb-3">@lang('connexion/profiles.edit_profile')</h4>
                <form action="{{route('connexion.my_profile.update')}}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.name') }}</label>
                        <div class="col-md-6">
                            <input id="name"
                                   type="text"
                                   class="form-control {{MainHelper::is_valid_form('name')}}"
                                   name="name"
                                   value="{{ (old('name')) ? old('name') : $user->name }}"
                                   required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.country') }}</label>
                        <div class="col-md-6">
                            <select name="country"
                                    class="form-control {{MainHelper::is_valid_form('country')}}"
                                    id="country"
                                    required>
                                <option></option>
                                @foreach($countries as $country)
                                    @php /** @var App\Models\Geo\GeoCountries $country */ @endphp
                                    <option value="{{$country->id}}"
                                            @if(((old('country')) ? old('country') : $user->country) == $country->id) selected @endif>
                                        {{$country->title}}
                                    </option>
                                @endforeach
                            </select>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="region" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.region') }}</label>
                        <div class="col-md-6">
                            <select name="region"
                                    class="form-control {{MainHelper::is_valid_form('region')}}"
                                    id="region"
                                    required>
                                <option></option>
                                @if(!empty($regions))
                                    @foreach($regions as $region)
                                        @php /** @var App\Models\Geo\GeoRegions $region */ @endphp
                                        <option value="{{$region->id}}"
                                                @if(((old('region')) ? old('region') : $user->region) == $region->id) selected @endif>
                                            {{$region->title}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('region')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.city') }}</label>
                        <div class="col-md-6">
                            <select name="city"
                                    class="form-control {{MainHelper::is_valid_form('city')}}"
                                    id="city"
                                    required>
                                <option></option>
                                @if(!empty($cities))
                                    @foreach($cities as $city)
                                        @php /** @var App\Models\Geo\GeoCities $city */ @endphp
                                        <option value="{{$city->id}}"
                                                @if(((old('city')) ? old('city') : $user->city) == $city->id) selected @endif>
                                            {{$city->title}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('city')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center mt-2 mb-1">{{__("connexion/profiles.date_birth")}} @include('connexion.users.settings.includes.vip')</div>
                    <div class="form-group row">
                        <div class="form-group col-3 col-md-2 offset-md-2">
                            <label for="day">{{__('auth/register.day')}}</label>
                            <select type="text"
                                    name="day"
                                    class="form-control {{MainHelper::is_valid_form('day')}} disabled"
                                    id="day"
                                    {{ ($user->hasVip()) ? 'required' : 'disabled' }}>
                                <option></option>
                                @foreach(MainHelper::option_days() as $key => $val)
                                    <option value="{{$key}}"
                                            @if($key == ( (old('day')) ? old('day') : $user->birthday->format('d')) ) selected @endif>
                                        {{$val}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-4 col-md-3">
                            <label for="month">{{__('auth/register.month')}}</label>
                            <select id="month"
                                    name="month"
                                    class="form-control {{MainHelper::is_valid_form('month')}}"
                                    {{ ($user->hasVip()) ? 'required' : 'disabled' }}>
                                <option></option>
                                @foreach(MainHelper::option_months() as $key => $val)
                                    <option value="{{$key}}"
                                            @if($key == ( (old('month')) ? old('month') : $user->birthday->format('m'))) selected @endif>
                                        {{__($val)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-5 col-md-3">
                            <label for="year">{{__("auth/register.year")}}</label>
                            <select id="year"
                                    name="year"
                                    class="form-control {{MainHelper::is_valid_form('year')}}"
                                    {{ ($user->hasVip()) ? 'required' : 'disabled' }}>
                                <option></option>
                                @foreach(MainHelper::option_years() as $key => $val)
                                    <option value="{{$key}}"
                                            @if($key == ( (old('year')) ? old('year') : $user->birthday->format('Y'))) selected @endif>
                                        {{$val}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="position" class="col-md-4 col-form-label text-md-right">
                            {{ __('auth/register.position') }}  @include('connexion.users.settings.includes.vip')
                        </label>
                        <div class="col-md-6">
                            <select name="position"
                                    class="custom-select {{MainHelper::is_valid_form('position')}}"
                                    id="position"
                                    {{ ($user->hasVip()) ? 'required' : 'disabled' }} >
                                <option></option>
                                <option value="domination"
                                        @if( ((old('position')) ? old('position') : $user->position ) == 'domination') selected @endif>
                                    {{__('auth/register.domination')}}
                                </option>
                                <option value="submission"
                                        @if( ((old('position')) ? old('position') : $user->position ) == 'submission') selected @endif>
                                    {{__('auth/register.submission')}}
                                </option>
                                <option value="switch"
                                        @if( ((old('position')) ? old('position') : $user->position )  == 'switch') selected @endif>
                                    {{__('auth/register.switch')}}
                                </option>
                            </select>
                            @error('position')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gender" class="col-md-4 col-form-label text-md-right">
                            {{ __('auth/register.gender') }}  @include('connexion.users.settings.includes.vip')
                        </label>
                        <div class="col-md-6">
                            <select name="gender"
                                    class="custom-select {{MainHelper::is_valid_form('gender')}}"
                                    id="gender"
                                    {{ ($user->hasVip()) ? 'required' : 'disabled' }}>
                                <option></option>
                                <option value="man" @if( ((old('gender')) ? old('gender') : $user->gender) == 'man') selected @endif>
                                    {{__('auth/register.man')}}
                                </option>
                                <option value="woman" @if( ((old('gender')) ? old('gender') : $user->gender) == 'woman') selected @endif>
                                    {{__('auth/register.woman')}}
                                </option>
                                <option value="trans" @if( ((old('gender')) ? old('gender') : $user->gender) == 'trans') selected @endif>
                                    {{__('auth/register.trans')}}
                                </option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="about" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.about') }}</label>
                        <div class="col-md-6">
                                <textarea name="about"
                                          class="form-control {{MainHelper::is_valid_form('about')}}"
                                          id="about"
                                          rows="5"
                                          required>{{ (old('about')) ? old('about') : $user->about }}</textarea>
                            @error('about')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="interests" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.interests') }}</label>
                        <div class="col-md-6">
                                <textarea name="interests"
                                          class="form-control {{MainHelper::is_valid_form('interests')}}"
                                          id="interests"
                                          rows="5"
                                          required>{{ (old('interests')) ? old('interests') : $user->interests }}</textarea>
                            @error('interests')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="taboo" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.taboo') }}</label>
                        <div class="col-md-6">
                                <textarea name="taboo"
                                          class="form-control {{MainHelper::is_valid_form('taboo')}}"
                                          id="taboo"
                                          rows="5"
                                          required>{{ (old('taboo')) ? old('taboo') : $user->taboo }}</textarea>
                            @error('taboo')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-8 offset-md-2">
                            <button type="submit" class="font-weight-bold btn btn-light btn-block">{{ __('connexion/profiles.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        let csrftoken = $("meta[name='csrf-token']").attr('content');

        $('select[name=country]').change(function(){
            let country = Number($('select[name=country]').val());

            if (country > 0) {
                $.ajax({
                    url: '/geo/regions/'+country,
                    type: 'POST',
                    data: ({}),
                    beforeSend: function(request) {
                        return request.setRequestHeader('X-CSRF-Token', csrftoken);
                    },
                })
                    .done(function(data) {
                        $('select[name=region]').empty();
                        $('select[name=city]').empty();
                        $('select[name=region]').append(("<option value = ''></option>"));
                        for(let id in data){
                            $('select[name=region]').append(("<option value = '"+ id +"'>"+data[id] +"</option>"));}
                    });
            }else {
                $('select[name=region]').empty();
                $('select[name=city]').empty();
            }
        });
        $('select[name=region]').change(function(){
            let region = Number($('select[name=region]').val());
            if (region > 0) {
                $.ajax({
                    url: '/geo/cities/'+region,
                    type: 'POST',
                    data: ({}),
                    beforeSend: function(request) {
                        return request.setRequestHeader('X-CSRF-Token', csrftoken);
                    },
                })
                    .done(function(data) {
                        $('select[name=city]').empty();
                        $('select[name=city]').append(("<option value = ''></option>"));
                        for(let id in data){
                            $('select[name=city]').append(("<option value = '"+ id +"'>"+data[id] +"</option>"));}
                    });
            }else {
                $('select[name=city]').empty();
            }
        });
    </script>

@endsection


