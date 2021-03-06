@extends('layouts.app')
@section('content')
    @php
        /**
         * @var App\Models\Admins\Access\Roles $role
         * @var Illuminate\Database\Eloquent\Collection $permissions
         * @var App\Models\Admins\Access\Permissions $permission
         */

    @endphp

    @if(session('success'))
        <div class="alert alert-success offset-2 col-md-8" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
            Изменения успешно сохранены
        </div>
    @endif

    <div class="card offset-2 col-md-8">
        <div class="card-body">
            <h4>Редактировать роль:</h4>
            <form action="{{route("admin.master.roles.update", $role)}}" method="POST">
                @method("PATCH")
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.name') }}</label>
                    <div class="col-md-6">
                        <input id="name"
                               type="text"
                               class="form-control {{MainHelper::is_valid_form('name')}}"
                               name="name"
                               value="{{ (old('name')) ? old('name') :  $role->name }}"
                               required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Слаг</label>
                    <div class="col-md-6">
                        <input id="name"
                               type="text"
                               class="form-control {{MainHelper::is_valid_form('slug')}}"
                               name="slug"
                               value="{{ (old('slug')) ? old('slug') :  $role->slug }}"
                               required autocomplete="slug" autofocus>
                        @error('slug')
                        <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 text-md-right">Права</div>
                    <div class="col-md-6">
                        @foreach ( $permissions AS $permission)
                        <div class="form-check">
                            <input type="hidden" name="{{$permission->slug}}" value="0">
                            <input class="form-check-input"
                                   type="checkbox"
                                   value="1"
                                   name="{{$permission->slug}}"
                                   id="permission_{{$permission->id}}"
                                   {{( (boolean)$permission->actively) ? 'checked' :""}}
                            >
                            <label class="form-check-label" for="permission_{{$permission->id}}">
                                {{$permission->name}}
                            </label>
                        </div>
                        @endforeach
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


@endsection
