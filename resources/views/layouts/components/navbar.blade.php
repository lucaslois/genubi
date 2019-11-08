@if(isset($selected_campaign))
    <div class="secondbar">
        <nav id="secondbar" class="navbar nav-main navbar-expand">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item partida">
                            <a class="nav-link"
                               href="{{ route('campaigns.show', $selected_campaign->id) }}"><b>{{ $selected_campaign->name }}</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('campaigns.sessions.index', $selected_campaign->id) }}">Sesiones</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a data-toggle="dropdown"
                               class="nav-link"
                               href="{{ route('campaigns.npcs.index', $selected_campaign->id) }}">
                                Campaña <i class="fas fa-caret-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-grey dropdown-200" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item"
                                   href="{{ route('campaigns.homebrews.index', $selected_campaign->id) }}">
                                    <img class="dropdown-grey-icon" src="{{ asset('images/icons/dices.svg') }}" alt="">
                                    Reglas de la casa
                                </a>
                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle"
                                       href="{{ route('knowledges.index', ['campaign_id' => $selected_campaign->id]) }}">
                                        <img class="dropdown-grey-icon" src="{{ asset('images/icons/open_book.svg') }}"
                                             alt=""> Conocimientos
                                    </a>
                                    <ul class="dropdown-menu dropdown-grey">
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle"
                                               href="{{ route('knowledges.index', ['campaign_id' => $selected_campaign->id, 'visibility' => 'me']) }}">Propios</a>
                                            @include('layouts.components.dropdown_knowledge', ['visibility' => 'me'])
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle"
                                               href="{{ route('knowledges.index', ['campaign_id' => $selected_campaign->id, 'visibility' => 'shared']) }}">De otros jugadores</a>
                                            @include('layouts.components.dropdown_knowledge', ['visibility' => 'shared'])

                                        </li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle"
                                               href="{{ route('knowledges.index', ['campaign_id' => $selected_campaign->id, 'visibility' => 'dm']) }}">Del DM</a>
                                            @include('layouts.components.dropdown_knowledge', ['visibility' => 'dm'])
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a data-toggle="dropdown"
                               class="nav-link"
                               href="{{ route('campaigns.npcs.index', $selected_campaign->id) }}">
                                Mundo <i class="fas fa-caret-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-grey dropdown-600" aria-labelledby="dropdownMenuButton">
                                <div class="row">
                                    <div class="col-6 col-border-right">
                                        <a class="dropdown-item"
                                           href="{{ route('campaigns.npcs.index', $selected_campaign->id) }}">
                                            <img class="dropdown-grey-icon" src="{{ asset('images/icons/helm.svg') }}">
                                            NPCs
                                        </a>
                                        <a class="dropdown-item dropdown-hover-light-blue disabled" href="#">
                                            <img class="dropdown-grey-icon" src="{{ asset('images/icons/globe.svg') }}">
                                            Locaciones
                                        </a>
                                        <a class="dropdown-item dropdown-hover-red disabled" href="#">
                                            <img class="dropdown-grey-icon" src="{{ asset('images/icons/ink.svg') }}">
                                            Lore
                                        </a>
                                        <a class="dropdown-item dropdown-hover-violet disabled" href="#">
                                            <img class="dropdown-grey-icon"
                                                 src="{{ asset('images/icons/monster.svg') }}"> Monstruos
                                        </a>
                                        <a class="dropdown-item dropdown-hover-green disabled" href="#">
                                            <img class="dropdown-grey-icon" src="{{ asset('images/icons/bag.svg') }}">
                                            Objetos
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a class="dropdown-item disabled" href="#">
                                            <img class="dropdown-grey-icon" src="{{ asset('images/icons/tower.svg') }}">
                                            Edificios
                                        </a>
                                        <a class="dropdown-item disabled" href="#">
                                            <img class="dropdown-grey-icon"
                                                 src="{{ asset('images/icons/heraldic.svg') }}"> Civilizaciones
                                        </a>
                                        <a class="dropdown-item disabled" href="#">
                                            <img class="dropdown-grey-icon" src="{{ asset('images/icons/book.svg') }}">
                                            Artículo
                                        </a>
                                        <a class="dropdown-item disabled" href="#">
                                            <img class="dropdown-grey-icon"
                                                 src="{{ asset('images/icons/scroll.svg') }}"> Mapas
                                        </a>
                                    </div>
                                </div>
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

@push('js')
    <!-- JS NAVBAR -->
    <script>

    </script>
    <!-- END JS NAVBAR -->
@endpush
