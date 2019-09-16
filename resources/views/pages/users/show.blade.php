@extends('layouts.main')


@section('content')
    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">{{ $user->name }}</li>
                        </ol>
                    </nav>
                </div>
                @if($user->is(auth()->user()))
                    <div class="col-md-6">
                        <div class="buttons float-md-right">
                            <a href="{{ route('profile.edit') }}" class="btn btn-success btn-square btn-upper">Editar perfil</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </section>

    <section class="character-profile">
        <div class="container">
            <h1>Perfil de {{ $user->name }}</h1>
            @if($user->activeTag())
                <h5 class="mini mb-0">{{ "@{$user->activeTag()->tag}" }}</h5>
            @endif
            <div class="box box-border-top mt-1">
                <div class="row">
                    <div class="col-3">
                        <img class="user-avatar" src="{{ $user->getImage() }}" alt="">
                    </div>
                    <div class="col-9">
                        <h2 class="user-title">
                            {{ $user->name }}
                            @if($user->isLogged())
                                <span class="mini text-success"><i class="fa fa-circle"></i> En línea</span>
                            @endif
                        </h2>
                        @if($user->is_admin)
                            <h3 class="user-staff">Administrador de Genubi</h3>
                        @endif
                        <p class="user-desc">Miembro desde el {{ $user->created_at->isoFormat('d MMM Y') }} <br>
                            Última actividad el {{ $user->last_login ? $user->last_login->isoFormat('D MMM Y') : 'Nunca' }}</p>
                    </div>
                </div>

                <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-default">Actividad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-characters">Personajes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-campaigns" >Partidas</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-default" role="tabpanel">
                        <table class="table table-sm table-material">
                            <tbody>
                            @forelse($user->activities->take(20) as $activity)
                                <tr>
                                    <td>{!! $activity->formatted_text !!}, <span class="activity-date">{{ $activity->created_at->diffForHumans() }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Aun no hay actividad registrada para este usuario</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tab-characters" role="tabpanel">
                        <div class="row character-list">
                            @forelse($user->characters as $character)
                                <div class="col-sm-6">
                                    <div class="card character">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img class="img-thumbnail" src="{{ $character->getImage() }}" alt="">
                                                </div>
                                                <div class="col-md-8">
                                                    <h5 class="character-title">{{ $character->name }} <span class="character-level">Nv. {{ $character->currentLevel() }}</span></h5>
                                                    @if($character->campaign)
                                                        {{--                                        <p class="character-data character-data-owner">en {{ $character->campaign->name }}</p>--}}
                                                        <span class="badge badge-pill badge-success">{{ $character->campaign->name }}</span>
                                                    @endif

                                                    <p class="character-data">{{ $character->race }} |
                                                        {{ $character->classes->implode('name', ', ')  }}
                                                    </p>
                                                    @if($character->nationality)
                                                        <p class="character-data">Oriundo de {{ $character->nationality }}</p>
                                                    @endif
                                                    <a href="{{ route('characters.show', $character->id) }}" class="btn btn-primary btn-sm">Ver personaje</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="box">
                                        <p>Aun no has creado ningún personaje. ¡Puedes hacer <a href="{{ route('characters.create') }}">click aquí</a> para crear uno!</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-campaigns" role="tabpanel">
                        <div class="row">
                            @forelse($user->campaigns as $campaign)
                                <div class="col-md-4">
                                    <div class="card campaign">
                                        <img class="card-img-top" src="{{ $campaign->getImageMini() }}" alt="{{ $campaign->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $campaign->name }}</h5>
                                            <span class="campaign_details">{{ $campaign->game->name }}, por <a href="">{{ $campaign->user->name }}</a></span>
                                            <p class="card-text campaign campaign_description">
                                                {{ $campaign->description }}
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-primary btn-sm">Ver partida</a>
                                            <div class="float-md-right">
                                                <span class="badge bg-success reaction"><i class="fa fa-thumbs-up"></i> {{ $campaign->positives() }}</span>
                                                <span class="badge bg-danger reaction"><i class="fa fa-thumbs-down"></i> {{ $campaign->negatives() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="box">
                                        <p>Aun no has creado ningúna partida. ¡Puedes hacer <a href="{{ route('campaigns.create') }}">click aquí</a> para crear una!</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="main campaigns">
        <div class="container">
            <div class="row character-list">

            </div>
        </div>
    </section>
@endsection