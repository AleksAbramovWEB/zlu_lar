@extends('layouts.app')
@section('content')

    <div class="flex-column profiles_search offset-md-2 col-md-8">

        <div class="card mb-4">
            <div class="card-body row">
                <div class="col">{{__('connexion/profiles.found')}} {{Declination::users($users->total())}}:</div>
                <div class="col text-right">
                    <a href="{{route('home')}}">@lang('connexion/profiles.start_new_search')</a>
                </div>
            </div>
        </div>

        {{$users->links('blades.my_paginator')}}

        @foreach($users AS $user)
            @php /** @var App\Models\User $user */ @endphp
            <div class="card mb-4">
                 <div class="card-body row">
                     <div class="flex-column col-2">
                         <a href="{{route("connexion.profile",['id' => $user->id])}}">
                             <div class="avatars">
                                 <img src="{{$user->getAvatar()}}">
                             </div>
                         </a>
                     </div>
                     <div class="col-10 flex-column">
                         <div class="row">
                             <div class="col">
                                 <a href="{{route("connexion.profile",['id' => $user->id])}}">{{$user->name}}</a>,
                                 {{$user->getAge()}}
                             </div>
                             <div class="col text-right">
                                 {{$user->getOnline()}}
                             </div>
                         </div>
                         <div class="flex-column">
                             <div>{{__('connexion/profiles.country')}}: {{$user->geo_country->title}}</div>
                             <div>{{__('connexion/profiles.region')}}: {{$user->geo_region->title}}</div>
                             <div>{{__('connexion/profiles.city')}}: {{$user->geo_city->title}}</div>
                         </div>
                         <div class="text-justify">{{$user->greeting}}</div>
                     </div>
                 </div>
             </div>
        @endforeach
        @if($users->total() !== 0)
            @if ($users->hasMorePages())
                {{$users->links('blades.my_paginator')}}
            @else
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{route('home')}}">@lang('connexion/profiles.start_new_search')</a>
                    </div>
                </div>
             @endif
        @endif
    </div>
@endsection
