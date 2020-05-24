@extends('layouts.app')
@section('content')

    <div class="container contacts_list offset-md-1 col-md-10">
        <div class="card border-light mb-4">
            <div class="card-body">
                <h3 class="text-center">СООБЩЕНИЯ</h3>
                <hr class="border-light">
                <div class="row justify-content-around">
                    <a href="{{route('connexion.messenger.main_list')}}"
                       @if($category == 'main_list') class="text-muted disabled"  @endif
                    >
                        @lang('connexion/messenger.main_list') ( {{$count->count_main_list}} )
                    </a>
                    <a href="{{route('connexion.messenger.list_of_favorites')}}"
                       @if($category == 'list_of_favorites') class="text-muted disabled" @endif
                    >
                        @lang('connexion/messenger.list_of_favorites') ( {{$count->count_list_of_favorites}} )
                    </a>
                    <a href="{{route('connexion.messenger.black_list')}}"
                       @if($category == 'black_list') class="text-muted disabled" @endif
                    >
                        @lang('connexion/messenger.black_list') ( {{$count->count_black_list}} )
                    </a>
                </div>
            </div>
        </div>

        @if(!$contacts->isEmpty())
        {{$contacts->links('blades.my_paginator')}}

        @foreach($contacts AS  $contact)
            @php /** @var App\Models\Connexion\Messenger\Contacts $contact */ @endphp
            <div class="card border-dark mb-4">
                <div class="card-body row">
                    <div class="col-2 flex-column ">
                        <a href="{{route("connexion.profile",['id' => $contact->to_user_contact->id])}}">
                            <div class="avatars">
                                <img src="{{$contact->to_user_contact->getAvatar()}}">
                            </div>
                        </a>
                    </div>
                    <div class="col-6 flex-column">
                        <div>
                            <a href="{{route("connexion.profile",['id' => $contact->to_user_contact->id])}}">{{$contact->to_user_contact->name}}</a>,
                            {{$contact->to_user_contact->getAge()}}
                        </div>
                        <div class="flex-column">
                            <div>{{__('connexion/profiles.country')}}: {{$contact->to_user_contact->geo_country->title}}</div>
                            <div>{{__('connexion/profiles.region')}}: {{$contact->to_user_contact->geo_region->title}}</div>
                            <div>{{__('connexion/profiles.city')}}: {{$contact->to_user_contact->geo_city->title}}</div>
                            <div><a href="{{route('connexion.messenger.show_contact', ['id'=> $contact->id])}}"
                                @if($contact->count_new_messages > 0)class="text-danger"@endif>

                                    @lang('connexion/messenger.write_message') |
                                    @lang('connexion/messenger.total_messages'): {{$contact->count_messages}} |
                                    @lang('connexion/messenger.new'): {{$contact->count_new_messages}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 flex-column">
                        <div class="text-right">{{$contact->to_user_contact->getOnline()}}</div>
                        @if($category !== 'main_list')
                            <div class="text-right">
                                <a href="{{route('connexion.messenger.update.contact.to_main_list', ['id' => $contact->id])}}">
                                    @lang('connexion/messenger.to_main_list')
                                </a>
                            </div>
                        @endif
                        @if($category !== 'list_of_favorites')
                        <div class="text-right">
                            <a href="{{route('connexion.messenger.update.contact.to_list_of_favorites', ['id' => $contact->id])}}">
                                @lang('connexion/messenger.to_list_of_favorites')
                            </a>
                        </div>
                        @endif
                        @if($category !== 'black_list')
                        <div class="text-right">
                            <a href="{{route('connexion.messenger.update.contact.to_black_list', ['id' => $contact->id])}}">
                                @lang('connexion/messenger.to_black_list')
                            </a>
                        </div>
                        @endif
                        <div class="text-right">
                            <a href="{{route('connexion.messenger.destroy.contact', ['id' => $contact->id])}}">
                                @lang('connexion/profiles.remove')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{$contacts->links('blades.my_paginator')}}

        @else
            <div class="card border-dark mb-4">
                <div class="card-body">
                    <h4 class="text-center">@lang('connexion/messenger.no_contacts')!!!</h4>
                    <div class="no_contacts"></div>
                </div>
            </div>
        @endif

    </div>
    <script type="text/javascript">
        $('.disabled').click(function(e){
            e.preventDefault();
        });
    </script>

@endsection
