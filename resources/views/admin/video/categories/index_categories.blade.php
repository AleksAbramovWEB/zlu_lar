@extends('layouts.app')
@section('content')
    @php
        /**
         * @var \Illuminate\Database\Eloquent\Collection $categories
         * @var \App\Models\Video\CategoriesVideo $category
         */
    @endphp
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col"><h4>Категории видео:</h4></div>
                <div class="col text-right"> <a class="" href="{{route("admin.video.categories.create")}}">добавить категорию</a></div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    @php
                        $rez = function ($column) use ($request){
                            $columnRequest = $request->input('column');
                            if ($column === 'id' AND empty($request->input('direction')))
                                $direction = 'desk';
                            elseif ($column === $columnRequest)
                                    $direction = ($request->input('direction') === 'desk') ? 'asc' : 'desk' ;
                            else    $direction = 'asc';
                            return [
                                'column' => $column,
                                'direction' => $direction
                            ];
                        }
                    @endphp
                    <th><a href="{{route("admin.video.categories.index", $rez('id'))}}">#id</a></th>
                    <th><a href="{{route("admin.video.categories.index", $rez('slug'))}}">#slug</a></th>
                    <th><a href="{{route("admin.video.categories.index", $rez('title_ru'))}}">#title_ru</a></th>
                    <th><a href="{{route("admin.video.categories.index", $rez('title_en'))}}">#title_en</a></th>
                    <th><a href="{{route("admin.video.categories.index", $rez('published'))}}">#published</a></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr {{($category->deleted_at == null) ? '':'class=text-danger'}} >
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->title_ru}}</td>
                        <td>{{$category->title_en}}</td>
                        <td>{{($category->deleted_at == null) ? ( ((bool)$category->published ) ? 'ДА' : 'НЕТ') : 'удалено'}}</td>
                        <td><a href="{{route("admin.video.categories.edit", $category)}}">изменить</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>


@endsection
