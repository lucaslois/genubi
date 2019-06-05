@if(isset($selected_campaign))
    <div class="secondbar">
    <nav id="secondbar" class="navbar nav-main navbar-expand-sm">
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
                        <a class="nav-link" href="{{ route('campaigns.homebrews.index', $selected_campaign->id) }}">Reglas de la casa</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a  data-toggle="dropdown"
                            class="nav-link"
                            href="{{ route('campaigns.npcs.index', $selected_campaign->id) }}">
                            Mundo <i class="fas fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-grey" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('campaigns.npcs.index', $selected_campaign->id) }}">NPCs</a>
                            <a class="dropdown-item disabled" href="#">Locaciones</a>
                            <a class="dropdown-item disabled" href="#">Lore</a>
                            <a class="dropdown-item disabled" href="#">Monstruos</a>
                            <a class="dropdown-item disabled" href="#">Objetos</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('campaigns.channels.index', $selected_campaign->id) }}">Canales</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </div>
@endif
