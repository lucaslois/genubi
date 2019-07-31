@extends('layouts.main')


@section('content')
    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">{{ $character->name }}</li>
                        </ol>
                    </nav>
                </div>
                @if($character->user->is(auth()->user()))
                    <div class="col-6">
                        <div class="buttons float-md-right">
                            <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-warning btn-square"><i class="fas fa-edit"></i> Editar personaje</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </section>

    <section class="character-profile">
        <div class="container">
            <h1 class="mb-0">Personaje: {{ $character->name }}</h1>
            @if($character->slug)
                <h5 class="mini mb-0">{{ "@$character->slug" }}</h5>
            @endif
            <div class="box box-border-top mt-1">
                <div class="row">
                    <div class="col-3">
                        <div class="character-sidebar text-center">
                            <img class="img-thumbnail character-profile-avatar" src="{{ $character->getImage() }}" alt="">
                            <div>
                                <span class="badge badge-state" style="background: {{ $character->state->color }}">{{ $character->state->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-default" role="tab" >Perfil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-posts" role="tab" >Diario</a>
                            </li>
                            @if($character->user->is(auth()->user()))
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-experience" role="tab" >Experiencia</a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab-default" role="tabpanel">
                                <h2 class="character-profile-title">Ficha de personaje</h2>
                                <div class="row">
                                    <div class="col-4">
                                        <dl>
                                            <dt>Nombre</dt>
                                            <dd>
                                                @if($character->family)
                                                    {{ $character->family }},
                                                @endif
                                                {{ $character->name }}
                                            </dd>
                                            <dt>Nacionalidad</dt>
                                            <dd>{{ $character->nationality ?? "-" }}</dd>

                                        </dl>
                                    </div>
                                    <div class="col-4">
                                        <dl>
                                            <dt>Raza</dt>
                                            <dd>{{ $character->race }}</dd>

                                            <dt>Edad</dt>
                                            <dd>{{ $character->age ?? "-" }} años</dd>

                                        </dl>
                                    </div>
                                    <div class="col-4">
                                        <dt>Clases</dt>
                                        <dd>
                                            @if($character->classes->count() > 0)
                                                {{ $character->classes->implode('name', ', ') }}
                                            @else
                                                -
                                            @endif
                                        </dd>
                                        <dt>Partida</dt>
                                        <dd>
                                            @if($character->campaign)
                                                <a href="{{ route('campaigns.show', $character->campaign->id) }}">{{ $character->campaign->name }}</a>
                                            @endif
                                        </dd>
                                    </div>
                                </div>

                                <h2 class="character-profile-title">¿Quién soy?</h2>
                                {!! $character->description !!}
                                @if($character->desc_mentality)
                                    <h2 class="character-profile-title mt-3">Mentalidad</h2>
                                    {!! $character->desc_mentality !!}
                                @endif
                                @if($character->desc_appearance )
                                    <h2 class="character-profile-title mt-3">Apariencia</h2>
                                    {!! $character->desc_appearance !!}
                                @endif
                                @if($character->desc_social_status)
                                    <h2 class="character-profile-title mt-3">Status social</h2>
                                    {!! $character->desc_social_status !!}
                                @endif
                                @if($character->famous_phrase)
                                    <h2 class="character-profile-title mt-3">Frases célebres</h2>
                                    {!! $character->famous_phrase !!}
                                @endif
                            </div>
                            <div class="tab-pane fade" id="tab-experience" role="tabpanel">
                                <div class="alert alert-success">
                                    <div class="row">
                                        <div class="col-md-2 text-center">
                                            Nivel: {{ $character->currentLevel() }}
                                        </div>
                                        <div class="col-md-10">
                                            @php
                                                $xp_percentage = round($character->currentXp() * 100 / $character->xpForNextLevel($character->currentLevel()));
                                            @endphp
                                            <div class="progress progress-level-bar">
                                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ $xp_percentage }}%">
                                                    {{ $xp_percentage }}%
                                                </div>
                                            </div>
                                            <div class="progress-level-text">
                                                Nv. {{ $character->currentLevel() }} ({{ $character->currentXp() }}/{{$character->xpForNextLevel($character->currentLevel())}}) - {{ $xp_percentage }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Sesión</th>
                                        <th>Experiencia</th>
                                        <th>Motivo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($character->experiences as $experience)
                                        <tr>
                                            <td>{{ $experience->created_at->format('d/M/Y') }}</td>
                                            <td>
                                                @if($experience->session)
                                                    {{ $experience->session->name }}
                                                @endif
                                            </td>
                                            <td>{{ $experience->value }}</td>
                                            <td>{{ $experience->reason }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tab-posts">
                                <h2 class="character-profile-title">Listado de posts</h2>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Sesión</th>
                                        <th>Título</th>
                                        <th></th>
                                    </tr>
                                    @forelse($character->posts->reverse()->take(10) as $post)
                                        <tr>
                                            <td>{{ $post->created_at->format('d M Y') }}</td>
                                            <td>{{ $post->session->name }}</td>
                                            <td>-</td>
                                            <td>
                                                <a href="{{ route('sessions.show', $post->session->id) }}">Entrar</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td rowspan="4">Aun no hay diarios para este personaje</td>
                                        </tr>
                                    @endforelse
                                    </thead>
                                </table>
                            </div>
                        </div>
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