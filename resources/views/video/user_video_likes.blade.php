@extends('layouts.app')
@push('css')

@endpush
@section('content')
    @php
        /** @var App\Models\Video\VideoLikes $like */
        /** @var Illuminate\Database\Eloquent\Collection $likes */

        $collectionsLikes = $likes->chunk(6);
    @endphp

    <div class="card mb-4">
        <div class="card-body d-flex flex-column align-items-center">
            <h4>{{__('video/video.liked_videos_user')}}: {{$name}}</h4>
        </div>
    </div>

    @include('video.includes.for_like')

    @include('video.includes.paginator', ['videos' => $likes])


@endsection
@push('script_files')

@endpush
{{--<script>--}}
@push('script')

@endpush
