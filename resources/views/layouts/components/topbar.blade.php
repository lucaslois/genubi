
<div class="topbar">
    <nav class="navbar nav-main navbar-expand-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img class="logo" src="{{ asset('images/logo.png') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topbarContent">
                <span class="navbar-toggler-icon" style="color: white"><i class="fa fa-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="topbarContent">
                <ul class="navbar-nav mr-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Mi contenido
                            </a>
                            <div class="dropdown-menu navbar-dropdown-black">
                                <a class="dropdown-item" href="{{ route('characters.me') }}">Mis Personajes</a>
                                <a class="dropdown-item" href="{{ route('campaigns.me') }}">Mis Partidas</a>
                            </div>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('campaigns.index') }}">Partidas</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('search') }}">
                            <input name="global_search" value="{{ request()->global_search }}" type="text" class='form-control topbar-searcher' placeholder="Buscador...">
                        </form>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @auth
                        @include('layouts.components.navbar_user_login')
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.index') }}">Ingresar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.index') }}">Registrarse</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>