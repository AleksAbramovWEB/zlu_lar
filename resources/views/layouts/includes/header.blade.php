


<header class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a href="{{ url('/') }}">
            <div class="logo"></div>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-link ">
                        <a  href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-link ">
                            <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a href="{{route('connexion.my_profile.edit')}}">настройки</a>
                        <a href="{{route('connexion.photos.index')}}">мои фото</a>
                        @php $newMessages = Auth::user()->getProperty('new_messages')  @endphp
                        <a href="{{route('connexion.messenger')}}"
                        @if($newMessages > 0) class="text-danger" @endif
                        >
                            сообщения: {{$newMessages}}
                        </a>
                        <a href="{{route('connexion.my_profile', ['locale' => App::getLocale()])}}">{{ Auth::user()->name }}</a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</header>
