@extends('layouts.app')
@section('content')

    @php
        /** @var App\Models\User $user */
    @endphp

    <div class="settings_profile col-md-10 offset-md-1">

        @include('connexion.users.settings.includes.menu_settings')

        @if(session('success'))
            <div class="alert alert-success mb-4 border-light text-center" role="alert">
                @lang('connexion/profiles.success_password')
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
        @endif

        <div class="card border-light">
            <div class="card-body">
                <h4 class="text-center mb-3">@lang('connexion/profiles.edit_password')</h4>
                <form class="mt-5" action="{{route('connexion.my_profile.edit.password.update')}}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="form-group row">
                        <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('connexion/profiles.old_password') }}</label>
                        <div class="col-md-6">
                            <input id="old_password"
                                   type="password"
                                   class="form-control {{MainHelper::is_valid_form('old_password')}}"
                                   name="old_password"
                                   value="{{ old('old_password') }}"
                                   required autocomplete="new-password">
                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('connexion/profiles.new_password') }}</label>
                        <div class="col-md-6">
                            <input id="password"
                                   type="password"
                                   class="form-control {{MainHelper::is_valid_form('password')}}"
                                   name="password"
                                   value="{{ old('password') }}"
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
                                   value="{{old('password_confirmation')}}"
                                   required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group row mb-3 mt-5">
                        <div class="col-md-8 offset-md-2">
                            <button type="submit" class="font-weight-bold btn btn-light btn-block">{{ __('connexion/profiles.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
