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

                             <div class="row flex-wrap ml-1 mr-1">
                                 @foreach($attach_photos AS $attach_photo)
                                     @php /** @var App\Models\Connexion\Messenger\Photos  $attach_photo */ @endphp
                                     <input type="hidden" name="photo_{{$attach_photo->id}}" value="{{$attach_photo->id}}">
                                     <div class="attach_photo m-1">
                                         <img src="{{$attach_photo->path_s3}}" >
                                     </div>
                                 @endforeach
                             </div>
                             <textarea rows="3"
                                       name="message"
                                       type="text"
                                       class="w-100 form-control {{MainHelper::is_valid_form('message')}}"
                                       placeholder="{{__('home/feedback.message')}}"
                                       required
                             ></textarea>
                             <div class="row mt-2">
                                 <div class="col">
                                     <a href="{{route('connexion.messenger.photos.show', ['photo' => $contact->id])}}">
                                         <div class="add_photo">
                                             @include('connexion.messenger.includes.fpg_svg')
                                         </div>
                                     </a>
                                 </div>
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
        @if($messages)
            @foreach($messages AS $message)
                @php /** @var App\Models\Connexion\Messenger\Messages $message */ @endphp
            <div class="card border-dark mb-4 col-8 {{$message->my_indentation($contact->id)}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div>{{$message->my_name($contact->id, $contact->to_user_contact->name)}}</div>
                                <div class="view {{$message->my_view($contact->id)}}"></div>
                            </div>
                        </div>
                        <div class="col text-right">{{$message->my_time()}}</div>
                    </div>
                    @if(!$message->attach_photos->isEmpty())
                        @foreach($message->attach_photos AS $photos_in_message)
                        @php /** @var App\Models\Connexion\Messenger\PhotoSend  $photos_in_message */ @endphp
                        <div class="photos_in_message m-3">
                            <img src="{{$photos_in_message->photo->path_s3}}">
                        </div>
                        @endforeach
                    @endif
                    <div class="text-justify mt-2">{{$message->message}}</div>
                </div>
            </div>
            @endforeach
            {{$messages->links('blades.my_paginator')}}
        @endif
    </div>
@endsection
