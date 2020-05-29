@extends('layouts.app')
@section('content')

    <div class="card messenger_notice col-md-8 offset-md-2 border-dark">
        <div class="card-body">
            <h3 class="text-center">@lang('connexion/messenger.notice')</h3>
            <p class="text-center mt-1 mb-1">
                @switch($code)
                    @case(1)
                        @lang("connexion/messenger.limit_contacts_with_out_wip_1")
                        {{Declination::contacts(config("bz.max_contacts_without_vip"))}}!
                        @lang("connexion/messenger.limit_contacts_with_out_wip_2")!
                    @break
                    @case(2)
                        @lang("connexion/messenger.limit_contacts_with_vip"):
                        {{Declination::contacts(config("bz.max_contacts_with_vip"))}}!
                    @break
                    @case(3)
                        @lang('connexion/messenger.not_vip_for_photo')
                @endswitch
            </p>
            <div class="pic mr-4"></div>
        </div>
    </div>

@endsection
