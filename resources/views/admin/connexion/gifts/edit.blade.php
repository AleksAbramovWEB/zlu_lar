@extends('layouts.app')
@section('content')
    @php
        /** @var App\Models\Connexion\Gifts\Gifts $gift */
    @endphp

    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger offset-1 col-md-10" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                {{$errors->first()}}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success offset-1 col-md-10" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                Изменения успешно сохранены
            </div>
        @endif
        <form action="{{route("admin.connexion.gifts.update", $gift)}}" method="POST">
            @method("PATCH")
            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <h5 class="text-center mb-1 mt-4">Редактировать подарок:</h5>
                            <img class="card-img-top offset-4 col-4" src="{{ asset($gift->path) }}" alt="Card image cap">
                            <div class="card-body">
                                <div class="form-group mb-1">
                                    <label for="title_ru" class="mb-0">title_ru:</label>
                                    <input class="form-control {{MainHelper::is_valid_form('title_ru')}}"
                                           id="title_ru"
                                           name="title_ru"
                                           value="{{ (old('title_ru')) ? old('title_ru') : $gift->title_ru }}">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="title_en" class="mb-0">title_en:</label>
                                    <input class="form-control {{MainHelper::is_valid_form('title_en')}}"
                                           id="title_en"
                                           name="title_en"
                                           value="{{ (old('title_en')) ? old('title_en') : $gift->title_en }}">
                                </div>
                                <div class="form-group">
                                    <label for="price" class="mb-0">цена:</label>
                                    <select name="price"
                                            class="custom-select {{MainHelper::is_valid_form('price')}}"
                                            id="price">
                                        <option></option>
                                        @for($i = 1; $i <= 50; $i++)
                                            <option value="{{$i}}" {{(( (old('price')) ? old('price') : $gift->price ) == $i) ? 'selected':''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <a href="{{route("admin.connexion.gifts.index")}}">вернуться к списку подарков</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="card-body ">
                                        <button type="submit" class="font-weight-bold btn btn-light btn-block mt-1 mb-3">{{__('connexion/profiles.save')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            <li>ID: {{$gift->id}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Создано</label>
                                            <input type="text" value="{{$gift->created_at_local}}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Изменено</label>
                                            <input type="text" value="{{$gift->updated_at_local}}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Удалено</label>
                                            <input type="text" value="{{$gift->deleted_at_local}}" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <a href="#" id="delete" class="text-center w-100">
                                            {{(is_null($gift->deleted_at)? 'удалить' : "востановить")}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <form action="{{route("admin.connexion.gifts.destroy", $gift)}}" method="POST" class="d-none" id="delete_form">
        @method('DELETE')
        @csrf
    </form>

    <script type="text/javascript" >
        $('#delete').on('click', function () {
            $('#delete_form').submit();
        });
    </script>
@endsection
