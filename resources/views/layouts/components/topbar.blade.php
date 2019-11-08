
<div class="topbar">
    <nav class="navbar nav-main navbar-expand-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img class="logo" src="{{ asset('images/logo.png') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topbarContent">
                <span class="navbar-toggler-icon" style="color: white"><i class="fa fa-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="topbarContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <form action="{{ route('search') }}">
                            <div class="input-group">
                                <input name="global_search" value="{{ request()->global_search }}" type="text" class='form-control topbar-searcher' placeholder="Buscador...">
                                <div class="input-group-append">
                                    <span class="search-icon"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('campaigns.index') }}">Partidas</a>
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