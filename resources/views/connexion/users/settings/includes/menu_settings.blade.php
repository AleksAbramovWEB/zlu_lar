@php
   $menu = [
        'my_profile_edit' => [
            'href'  => route('connexion.my_profile.edit'),
            'label' => __('connexion/profiles.edit_profile'),
            'blade' => 'connexion.my_profile.edit'
        ],
        'edit_password' => [
            'href'  => route('connexion.my_profile.edit.password'),
            'label' => __('connexion/profiles.edit_password'),
            'blade' => 'connexion.my_profile.edit.password'
        ],
        'kassa' => [
            'href'  => route('kassa.index'),
            'label' => __('kassa.replenish_account'),
            'blade' => 'kassa.index'
        ],
   ];

    $thisBlade = Route::current()->getName();

@endphp



<div class="card border-light mb-4">
    <div class="card-body ">
        <div class="d-flex flex-column align-items-center">
            <h2>@lang('connexion/profiles.settings')</h2>
            <ul>
                @foreach($menu as $li)
                    <li>
                        @if($thisBlade == $li['blade'])
                            <span class="text-secondary">{{$li['label']}}</span>
                        @else
                            <a href="{{$li['href']}}">{{$li['label']}}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
