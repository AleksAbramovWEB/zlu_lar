@extends('layouts.app')
@section('content')

<div class="messenger_photos">
    @error('photo')
        <div class="alert alert-danger mb-4">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
            {{$message}}
        </div>
    @enderror
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="text-center m-2">Прикрепить фото к сообщению:</h3>
            <form class="col-md-6 offset-md-3" action="{{route('connexion.messenger.photos.store')}}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="custom-file col">
                    <style>
                        .custom-file-label::after {content: '{{__('connexion/profiles.browse')}}';}
                    </style>
                    <input name="photo" type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">{{__('connexion/profiles.choose_file')}}</label>
                </div>
                <button type="submit" class="font-weight-bold btn btn-light btn-block mt-1 ">{{__('connexion/profiles.load')}}</button>
            </form>
        </div>
    </div>
    @if(!$photos->isEmpty())
        <form action="{{route('connexion.messenger.photos.attach', ['id' => $contact_id])}}" method="POST">
            @method('post')
            @csrf
            <div class="row">
                @php
                    $int =  $photos->count() / 3;
                    $photoCollections =  $photos->chunk(ceil($int));
                @endphp
                @foreach($photoCollections as $collection)
                    <div class="col">
                        @foreach($collection AS $photo)
                            @php /** @var App\Models\Connexion\Messenger\Photos $photo */@endphp
                            <input name="photo_{{$photo->id}}"
                                   type="checkbox"
                                   id="photo_{{$photo->id}}"
                                   value="{{$photo->id}}">
                            <label for="photo_{{$photo->id}}">
                                <div class="card mb-4">
                                    @include('connexion.messenger.includes.delete_photo_messages')
                                    <div class="card-body">
                                            <img src="{{$photo->path_s3}}">
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="col">
                        <button type="submit" class="font-weight-bold btn btn-light btn-block">
                            @lang("connexion/messenger.attach")
                        </button>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="card">
            <div class="card-body">
                <h5 class="text-center mt-3">@lang("connexion/messenger.no_photos")</h5>
                <div class="no_photos"></div>
            </div>
        </div>

    @endif
</div>
<form class="d-none"
      action="{{route('connexion.messenger.photos.destroy')}}"
      method="POST"
      id="remove_photo_form"
>
    @method('delete')
    @csrf
    <input type="text" name="remove_photo" id="remove_photo_input">
</form>

<script type="text/javascript">
    $('.delete_photo_messenger').on('click', function () {
        $('body input:checkbox').prop('checked', false);
        let id = $(this).attr('data-photo');
        $('#remove_photo_input').val(id);
        $('#remove_photo_form').submit();
    });
</script>



@endsection
