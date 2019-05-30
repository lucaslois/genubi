@extends('layouts.main')

@section('content')
    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Antiguo Mal</li>
                        </ol>
                    </nav>
                </div>
{{--                SECCIÓN DM--}}
                @if($campaign->user->is(auth()->user()))
                    <div class="col-md-6">
                        <div class="buttons float-md-right">
                            <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-warning btn-square">Editar campaña</a>
                            <span class="dropdown">
                                <a href="" data-toggle="dropdown" class="btn btn-warning btn-square"><i class="fas fa-caret-down"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('campaigns.experiences.index', $campaign->id) }}">Repartir experiencias</a>
                                    <a class="dropdown-item" href="{{ route('campaigns.link.index', $campaign->id) }}">Crear enlace de invitación</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('campaigns.remove', $campaign->id) }}"><i class="fas fa-trash"></i> Eliminar partida</a>
                                </div>
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Información principal</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-md-3">
                        <dl>
                            <dt>Director</dt>
                            <dd>{{ $campaign->user->name }}</dd>
                            <dt>Cantidad de personajes</dt>
                            <dd>{{ $characters->count() }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-3">
                        <dl>
                            <dt>Fecha de inicio</dt>
                            <dd>
                                @if($campaign->sessions->count() > 0)
                                {{ $campaign->sessions->first()->date->format('d F Y') }}
                                @else
                                    Aun no hay sesiones
                                @endif
                            </dd>
                            <dt>Estado</dt>
                            <dd><span class="badge badge-state" style="background: {{ $campaign->state->color }}">{{ $campaign->state->name }}</span></dd>
                        </dl>
                    </div>
                    <div class="col-md-3">
                        <dl>
                            <dt>Fecha de la última sesión</dt>
                            <dd>
                                @if($campaign->sessions()->count() > 0)
                                    {{ $campaign->sessions->last()->date->format('d F Y') }} ({{ $campaign->sessions->last()->date->diffForHumans() }})
                                @else
                                    Aun no hay sesiones
                                @endif
                            </dd>
                            <dt>Última sesión</dt>
                            <dd>
                                @if($campaign->sessions()->orderByDesc('date')->first())
                                    {{ $campaign->sessions()->orderByDesc('date')->first()->name }}
                                @else
                                    Aun no hay sesiones
                                @endif
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-3">
                        <dt>Sesiones totales</dt>
                        <dd>{{ $campaign->sessions->count() }} sesiones</dd>
                        <dt>Votos</dt>
                        <dd>
                            <span class="badge bg-success reaction"><i class="fa fa-thumbs-up"></i> {{ $campaign->positives() }}</span>
                            <span class="badge bg-danger reaction"><i class="fa fa-thumbs-down"></i> {{ $campaign->negatives() }}</span>
                        </dd>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <h1>Protagonistas</h1>
            <div class="row character-list">
                @forelse($characters as $character)
                    <div class="col-sm-6">
                        <div class="card character">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="img-thumbnail" src="{{ $character->getImage() }}" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="character-title">{{ $character->name }} <span class="character-level">Nv. {{ $character->currentLevel() }}</span></h5>
                                        <p class="character-data character-data-owner">de {{ $character->user->name }}</p>
                                        <p class="character-data">{{ $character->race }} |
                                            {{ $character->classes->implode('name', ', ')  }}
                                        </p>
                                        @if($character->nationality)
                                        <p class="character-data">Oriundo de {{ $character->nationality }}</p>
                                        @endif
                                        <p class="character-desc">{{ str_limit($character->description, 200) }}</p>
                                        <a href="{{ route('characters.show', $character->id) }}" class="btn btn-primary btn-sm">Ver personaje</a>
                                    </div>
                                </div>
                            </div>
                            @if($campaign->user->is(auth()->user()))
                            <div class="card-footer">
                                <a href="{{ route('characters.dm.edit', $character->id) }}" class="btn btn-warning btn-sm">Editar personaje</a>
                              </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="box">
                            <p>Ooops! Parece que aún no tenemos personajes.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @if($campaign->inactiveCharacters()->count() > 0 && $campaign->user->is(auth()->user()))
    <section>
        <div class="container">
            <h1>Personajes inactivos</h1>
            <div class="row character-list">
                @forelse($campaign->inactiveCharacters() as $character)
                    <div class="col-sm-6">
                        <div class="card character">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="img-thumbnail" src="{{ $character->getImage() }}" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="character-title">{{ $character->name }} <span class="character-level">Nv. {{ $character->currentLevel() }}</span></h5>
                                        <p class="character-data character-data-owner">de {{ $character->user->name }}</p>
                                        <p class="character-data">{{ $character->race }} |
                                            {{ $character->classes->implode('name', ', ')  }}
                                        </p>
                                        @if($character->nationality)
                                            <p class="character-data">Oriundo de {{ $character->nationality }}</p>
                                        @endif
                                        <p class="character-desc">{{ str_limit($character->description, 200) }}</p>
                                        <a href="{{ route('characters.show', $character->id) }}" class="btn btn-primary btn-sm">Ver personaje</a>
                                    </div>
                                </div>
                            </div>
                            @if($campaign->user->is(auth()->user()))
                                <div class="card-footer">
                                    <a href="{{ route('characters.dm.edit', $character->id) }}" class="btn btn-warning btn-sm">Editar personaje</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="box">
                            <p>Ooops! Parece que aún no tenemos personajes.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif


@endsection