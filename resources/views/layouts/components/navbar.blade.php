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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('campaigns.channels.index', $selected_campaign->id) }}">Canales</a>
                        </li>
                        <li class="nav-item">
                            
                            <a class="nav-link" href="{{ route('campaigns.npcs.index', $selected_campaign->id) }}">NPC's</a>
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
