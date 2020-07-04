@extends('layouts.app')
@push('css')

@endpush
@section('content')
    @php
        /** @var Illuminate\Support\Collection $news */

        $user = new \App\Models\User();
        $photo = new \App\Models\Connexion\Messenger\Photos();
    @endphp
    <div class="news offset-md-2 col-md-8">
        <div class="card border-dark mb-4">
            <div class="card-body">
                <h4 class="text-center m-0">{{__('connexion/news.news')}}</h4>
            </div>
        </div>
        @if($news->isNotEmpty())
            @foreach($news as $new)
            <div class="card border-dark mb-4">
                <div class="card-body">
                    <div class="media">@include("connexion.news.includes.{$new->news}")</div>
                    <div class="text-right mt-2">{{\MainHelper::getLocalDate($new->created_at)}}</div>
                </div>
            </div>
            @endforeach
        @else
            <div class="card border-dark mb-4">
                <div class="card-body d-flex flex-column align-items-center">
                    <h5>{{__('connexion/news.not_news')}}</h5>
                    <img class="w-50" src="{{asset("img/svg/notice_messenger.svg")}}">
                </div>
            </div>
        @endif

        {{$news->links('blades.my_paginator_dark')}}
    </div>
@endsection
@push('script_files')

@endpush
{{--<script>--}}
@push('script')



@endpush
