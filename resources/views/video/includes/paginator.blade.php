

@if($videos->total() > $videos->count())
    <div class="card mb-4">
        <div class="card-body">
            {{$videos->links('blades.my_paginator_simple')}}
        </div>
    </div>
@endif
