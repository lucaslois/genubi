@extends('layouts.main')

@section('content')
    <section class="section-campaign">
        {{--<div class="container">--}}
            <div class="campaign_background"
                 style="background-image: url({{ $campaign->getImage() }})">
                <div class="overlay"></div>
                <div class="container">
                    <div class="campaign_content">
                        <h1 class="campaign_title">{{ $campaign->name }}
                            <span class="badge campaign_badge" style="background: {{ $campaign->state->color }}">{{ $campaign->state->name }}</span>
                        </h1>
                        <div class="campaign_aditional">
                            Dirigda por <a href="{{ route('users.show', $campaign->user->id) }}">{{ $campaign->user->name }}</a>
                        </div>
                        <div class="campaign_description">
                            <p>
                                {{ $campaign->description }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        {{--</div>--}}
    </section>

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active"><a href="#">Partidas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Antiguo Mal</li>
                        </ol>
                    </nav>
                </div>
{{--                SECCIÓN DM--}}
                @if($campaign->user->is(auth()->user()) || true)
                    <div class="col-md-8">
                        <div class="buttons float-md-right">
                            <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-warning btn-square">Editar campaña</a>
                            <span class="dropdown">
                                <a href="" data-toggle="dropdown" class="btn btn-warning btn-square"><i class="fas fa-caret-down"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Repartir experiencias</a>
                                    <a class="dropdown-item" href="{{ route('campaigns.link.index', $campaign->id) }}">Crear enlace de invitación</a>
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
                            <dd>{{ $campaign->characters->count() }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-3">
                        <dl>
                            <dt>Fecha de inicio</dt>
                            <dd>14 de agosto de 2014</dd>
                            <dt>Estado</dt>
                            <dd><span class="badge" style="background: {{ $campaign->state->color }}">{{ $campaign->state->name }}</span></dd>
                        </dl>
                    </div>
                    <div class="col-md-3">
                        <dl>
                            <dt>Fecha de la última sesión</dt>
                            <dd>
                                @if($campaign->sessions()->count() > 0)
                                    {{ $campaign->sessions->last()->date->format('d/M/Y') }} ({{ $campaign->sessions->last()->date->diffForHumans() }})
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
                @forelse($campaign->characters as $character)
                    <div class="col-sm-6">
                        <div class="card character">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="img-thumbnail" src="{{ $character->getImage() }}" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="character-title">{{ $character->name }} <span class="character-owner">de {{ $character->user->name }}</span></h5>
                                        <p class="character-data">{{ $character->race }}, oriundo de {{ $character->nationality }}</p>
                                        <p class="character-desc">{{ $character->description }}</p>
                                        <a href="{{ route('characters.show', $character->id) }}" class="btn btn-primary btn-sm">Ver personaje</a>
                                    </div>
                                </div>
                            </div>
                            @if($campaign->user->is(auth()->user()))
                            <div class="card-footer">
                                <a href="#" class="btn btn-warning btn-sm">Editar personaje</a>
                                <a href="#" class="btn btn-warning btn-sm">Dar experiencia</a>
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


@endsection