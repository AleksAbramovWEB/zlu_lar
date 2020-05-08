@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('auth/register.register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.name') }}</label>
                            <div class="col-md-6">
                                <input id="name"
                                       type="text"
                                       class="form-control {{MainHelper::is_valid_form('name')}}"
                                       name="name"
                                       value="{{ old('name') }}"
                                       required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.email') }}</label>
                            <div class="col-md-6">
                                <input id="email"
                                       type="email"
                                       class="form-control {{MainHelper::is_valid_form('email')}}"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.password') }}</label>
                            <div class="col-md-6">
                                <input id="password"
                                       type="password"
                                       class="form-control {{MainHelper::is_valid_form('password')}}"
                                       name="password"
                                       required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.confirm_password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm"
                                       type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       required autocomplete="new-password">
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
                                            @if(old("country") == $country->id) selected @endif>
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
                                </select>
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center mt-2 mb-1">{{__("auth/register.date_birth")}}</div>
                        <div class="form-group row">
                            <div class="form-group col-3 col-md-2 offset-md-2">
                                <label for="day">{{__('auth/register.day')}}</label>
                                <select type="text"
                                        class="form-control {{MainHelper::is_valid_form('day')}}"
                                        id="inputCity">
                                        <option></option>
                                    @foreach(MainHelper::option_days() as $key => $val)
                                        <option value="{{$key}}"
                                                @if($key == old('day')) selected @endif>
                                            {{$val}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-4 col-md-3">
                                <label for="month">{{__('auth/register.month')}}</label>
                                <select id="month"
                                        class="form-control {{MainHelper::is_valid_form('month')}}">
                                    <option></option>
                                    @foreach(MainHelper::option_months() as $key => $val)
                                        <option value="{{$key}}"
                                                @if($key == old('month')) selected @endif>
                                            {{__($val)}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-5 col-md-3">
                                <label for="year">{{__("auth/register.year")}}</label>
                                <select id="year"
                                        class="form-control {{MainHelper::is_valid_form('year')}}">
                                    <option></option>
                                    @foreach(MainHelper::option_years() as $key => $val)
                                        <option value="{{$key}}"
                                                @if($key == old('year')) selected @endif>
                                            {{$val}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.position') }}</label>
                            <div class="col-md-6">
                                <select name="position"
                                        class="custom-select {{MainHelper::is_valid_form('position')}}"
                                        id="position"
                                        required>
                                    <option></option>
                                    <option value="domination" @if(old('position') == 'domination') selected @endif>
                                        {{__('auth/register.domination')}}
                                    </option>
                                    <option value="submission" @if(old('position') == 'submission') selected @endif>
                                        {{__('auth/register.submission')}}
                                    </option>
                                    <option value="switch" @if(old('position') == 'switch') selected @endif>
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
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.gender') }}</label>
                            <div class="col-md-6">
                                <select name="gender"
                                        class="custom-select {{MainHelper::is_valid_form('gender')}}"
                                        id="gender"
                                        required>
                                    <option></option>
                                    <option value="man" @if(old('gender') == 'man') selected @endif>
                                        {{__('auth/register.man')}}
                                    </option>
                                    <option value="submission" @if(old('gender') == 'woman') selected @endif>
                                        {{__('auth/register.woman')}}
                                    </option>
                                    <option value="switch" @if(old('gender') == 'trans') selected @endif>
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
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.about') }}</label>
                            <div class="col-md-6">
                                <textarea name="about"
                                        class="form-control {{MainHelper::is_valid_form('about')}}"
                                        id="about"
                                        rows="5"
                                        required>
                                    {{old('about')}}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="interests" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.interests') }}</label>
                            <div class="col-md-6">
                                <textarea name="interests"
                                        class="form-control {{MainHelper::is_valid_form('interests')}}"
                                        id="interests"
                                        rows="5"
                                        required>
                                    {{old('interests')}}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="taboo" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.taboo') }}</label>
                            <div class="col-md-6">
                                <textarea name="taboo"
                                        class="form-control {{MainHelper::is_valid_form('taboo')}}"
                                        id="taboo"
                                        rows="5"
                                        required>
                                    {{old('taboo')}}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row m-4">
                            <div class="form-check col-md-8 offset-md-4 col-10 offset-2">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="agreement"
                                       value="1"
                                >
                                <label class="form-check-label" for="agreement">
                                    <a href="#">
                                        {{__('auth/register.agreement')}}
                                    </a>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="font-weight-bold btn btn-light btn-block">{{ __('auth/register.register') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('select[name=country]').change(function(){
        let country = Number($('select[name=country]').val());
        if (country > 0) {
            $.get('geo/regions/'+country ,{},function(data){
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
            $.get('geo/cities/'+region ,{},function(data){
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

