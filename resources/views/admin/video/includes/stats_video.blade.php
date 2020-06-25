<table class="table table-sm mb-0">
    <thead>
    <tr>
        <th>Статистика видео</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Количество видео</td>
        <td>{{$stats->count_video}}</td>
    </tr>
    <tr>
        <td>Количество лайков</td>
        <td>{{$stats->count_likes}}</td>
    </tr>
    <tr>
        <td>Количество просмотров</td>
        <td>{{$stats->views_video}}</td>
    </tr>
    <tr>
        <td>Количество удаленных</td>
        <td>{{$stats->deleted_video}}</td>
    </tr>
    <tr>
        <td>Количество опубликованных</td>
        <td>{{$stats->published_video}}</td>
    </tr>
    <tr>
        <td>Количество не опубликованных</td>
        <td>{{$stats->is_not_published_video}}</td>
    </tr>

    </tbody>
</table>
