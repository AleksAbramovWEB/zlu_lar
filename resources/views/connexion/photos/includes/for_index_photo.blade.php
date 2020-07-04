<div class="row">
    @php
        $int =  $photos->count() / 3;
        $photoCollections =  $photos->chunk(ceil($int));
    @endphp
    @foreach($photoCollections as $collection)
        <div class="col">
            @foreach($collection AS $photo)
                @php /** @var App\Models\Connexion\Photos\Photos $photo */@endphp
                <div class="card mb-4">
                    <a href="{{route('connexion.photos.show', $photo)}}">
                        <div class="card-body">
                            <img src="{{$photo->path_s3}}">
                        </div>
                    </a>
                </div>
                </label>
            @endforeach
        </div>
    @endforeach
</div>
{{$photos->links('blades.my_paginator')}}
