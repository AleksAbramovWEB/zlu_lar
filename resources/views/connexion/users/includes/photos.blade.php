@php
    /** @var Illuminate\Database\Eloquent\Collection $photos */
    /** @var App\Models\Connexion\Photos\Photos $photo */
@endphp

@if($photos->isNotEmpty())
    <div class="card mb-4 border-light">
        <div class="card-body pt-1 pb-0 m-0">
            <a href="{{route('connexion.photos.user', $user->id)}}" class="mb-0">{{__("connexion/photos.photo")}}:</a>
            <div class="owl-carousel categories m-0">
                @foreach($photos AS $photo)
                    <a href="{{route('connexion.photos.show', $photo->id)}}">
                        <img src="{{$photo->path_s3}}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif

