@extends('layouts.app')
@section('content')
    @php /** @var App\Models\Connexion\Messenger\Contacts $contact */ @endphp
    <div class="container messenger_contact offset-md-1 col-md-10">
        <div class="card border-light mb-4">
            <div class="card-body row">
                <div class="col-2 flex-column ">
                    <a href="{{route("connexion.profile",['id' => $contact->to_user_contact->id])}}">
                        <div class="avatars">
                            <img src="{{$contact->to_user_contact->getAvatar()}}">
                        </div>
                    </a>
                </div>
                <div class="col-10 flex-column">
                    <div class="row">
                        <div class="col">
                            <a href="{{route("connexion.profile",['id' => $contact->to_user_contact->id])}}">{{$contact->to_user_contact->name}}</a>,
                            {{$contact->to_user_contact->getAge()}}
                        </div>
                        <div class="col text-right">
                            {{$contact->to_user_contact->getOnline()}}
                        </div>
                    </div>
                    <div class="flex-column">
                        @php $title = 'title_'.App::getLocale(); @endphp
                        <div class="mr-2">{{__('connexion/profiles.country')}}: {{$contact->to_user_contact->geo_country->$title}}</div>
                        <div class="mr-2">{{__('connexion/profiles.region')}}: {{$contact->to_user_contact->geo_region->$title}}</div>
                        <div class="mr-2">{{__('connexion/profiles.city')}}: {{$contact->to_user_contact->geo_city->$title}}</div>
                    </div>
                    <div class="row">
                        <form class="col" action="{{route("connexion.messenger.new_message", ['id' => $contact->id])}}" method="POST">
                             @method('post')
                             @csrf
                                <textarea rows="3"
                                       name="message"
                                       type="text"
                                       class="form-control {{MainHelper::is_valid_form('message')}}"
                                       placeholder="{{__('home/feedback.message')}}"
                                       required
                             ></textarea>
                             <div class="row">
                                 <div class="col"></div>
                                 <div class="col"></div>
                                 <div class="col">
                                     <button type="submit" class="font-weight-bold btn btn-light btn-block mt-1">
                                         {{__('home/feedback.sand')}}
                                     </button>
                                 </div>
                             </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @foreach($messages AS $message)
            @php /** @var App\Models\Connexion\Messenger\Messages $message */ @endphp
        <div class="card border-dark mb-4 col-8 {{$message->my_indentation($contact->id)}}">
            <div class="card-body">
                <div class="row">
                    <div class="col">{{$message->my_name($contact->id, $contact->to_user_contact->name)}}</div>
                    <div class="col"></div>
                </div>
                <div class="text-justify mt-2">{{$message->message}}</div>
            </div>
        </div>
        @endforeach

        {{$messages->links('blades.my_paginator')}}
        
    </div>
@endsection
