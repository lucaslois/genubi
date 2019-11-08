<div class="footer-online">
    <div class="container">
        <p class='visites'>
            @if($usersOnline->count() > 0)
            <b>Usuarios online:</b> {{ $usersOnline->pluck('name')->implode(', ') }}
            @else
            No hay usuarios online en este momento
            @endif
        </p>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </div>
            <div class="col-md-3">
                <h6>MI CUENTA</h6>
                <ul>
                    <li><a href="{{ route('characters.me') }}">Mis personajes</a></li>
                    <li><a href="{{ route('campaigns.me') }}">Mis partidas</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>CONTENIDO</h6>
                <ul>
                    <li><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                    <li><a href="{{ route('users.index') }}">Usuarios</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>SÍGUENOS</h6>
                <ul>
                    <li><a href="https://www.facebook.com/groups/319115168263033/">Facebook</a></li>
                    <li><a href="https://wiki.genubi.com.ar">Wiki</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<footer class="subfooter">
    <div class="container">
        <p><i class="fa fa-code"></i> con <i class="fa fa-dice"></i> por <a href="https://lucaslois.com">Lucas Lois</a> y el grupo de
            <a href="{{ route('campaigns.show', 2) }}">Antiguo Mal</a></p>
        <p><a href="{{ url('/') }}">Genubi</a> {{ now()->year }} | V{{ $version }}</p>
    </div>
</footer>