@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-light">
        <div class="card-body">
            @include('home.includes.search_form')
        </div>
    </div>
</div>
@endsection
