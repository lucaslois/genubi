<li class="nav-item dropdown">
    <a class="nav-link notify-bell-link" data-toggle="dropdown" href="{{ route('login.index') }}">
        <i class="fa fa-bell"></i>
        @if(auth()->user()->notViewedNotifications()->count() > 0)
        <span class="notify-bell-number">{{ auth()->user()->notViewedNotifications()->count() }}</span>
        @endif
    </a>
    <div class="dropdown-menu notify-drop">
        <div class="notify-drop-content">
            <div class="notify-title">Mis notificaciones</div>
            <div class="notify-body">
                @if(auth()->user()->notViewedNotifications()->count() > 0)
                <div class="notify-bar">
                    Nuevas
                </div>
                @foreach(auth()->user()->notViewedNotifications()->take(3) as $notif)
                <div class="notify-notif">
                    <a class="notify-link" href="{{ route('notifications.click', $notif->id) }}">
                        <div class="row">
                            <div class="col-2">
                                <img class="notify-icon" src="{{ $notif->image }}" alt="">
                            </div>
                            <div class="col-10">
                                <div class="notify-text">
                                    {{ $notif->text }}
                                    <span class="notify-mini">{{ $notif->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @endif
                <div class="notify-bar">
                    Antiguas
                </div>
                @foreach(auth()->user()->viewedNotifications()->take(5) as $notif)
                    <div class="notify-notif">
                        <a class="notify-link" href="{{ route('notifications.click', $notif->id) }}">
                            <div class="row">
                                <div class="col-2">
                                    <img class="notify-icon" src="{{ $notif->image }}" alt="">
                                </div>
                                <div class="col-10">
                                    <div class="notify-text">
                                        {{ $notif->text }}
                                        <span class="notify-mini">{{ $notif->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</li>
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="{{ route('login.index') }}">{{ auth()->user()->name }} <i class="fa fa-caret-down"></i></a>
    <div class="dropdown-menu navbar-dropdown-black" aria-labelledby="navbarDropdown">
{{--        <a class="dropdown-item" href="{{ route('profile.show') }}">Mi perfil</a>--}}
        <a class="dropdown-item" href="{{ route('users.show', auth()->user()->id) }}">Mi perfil</a>
        <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a>
    </div>
</li>