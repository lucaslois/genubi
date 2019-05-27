@if(isset($selected_campaign))
    <div class="secondbar">
    <nav class="navbar nav-main navbar-expand-sm">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item partida">
                        <a class="nav-link"><b>{{ $selected_campaign->name }}</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('campaigns.show', $selected_campaign->id) }}">Página principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('campaigns.sessions.index', $selected_campaign->id) }}">Sesiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('homebrews') }}">Homebrew</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('campaigns.npcs.index', $selected_campaign->id) }}">NPCs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Objetos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Artículos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Galería</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Canales</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </div>
@endif
