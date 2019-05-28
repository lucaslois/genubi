
<div class="topbar">
    <nav class="navbar nav-main navbar-expand-sm">
        <div class="container">
            <a class="navbar-brand" href="#"><img class="logo" src="{{ asset('images/logo.png') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mi contenido
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('characters.me') }}">Mis Personajes</a>
                            <a class="dropdown-item" href="{{ route('campaigns.me') }}">Mis Partidas</a>
                        </div>
                    </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('campaigns.index') }}">Partidas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="http://wiki.genubi.com.ar">Wiki</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="{{ route('login.index') }}">{{ auth()->user()->name }} <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.show') }}">Mi perfil</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a>
                        </div>
                    </li>
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