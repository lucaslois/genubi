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
            <h1>Personaje: {{ $character->name }}</h1>
            <div class="box box-border-top">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-default" role="tab" >Perfil</a>
                    </li>
                    @if($character->user->is(auth()->user()))
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-experience" role="tab" >Experiencia</a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-default" role="tabpanel">
                        <div class="row">
                            <div class="col-4">
                                <div class="character-sidebar text-center">
                                    <img class="img-thumbnail character-profile-avatar" src="{{ $character->getImage() }}" alt="">
                                    <div>
                                        <span class="badge badge-state" style="background: {{ $character->state->color }}">{{ $character->state->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
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
                                            <dt>Raza</dt>
                                            <dd>{{ $character->race }}</dd>
                                            <dt>Clases</dt>
                                            <dd>{{ $character->classes->implode('name', ', ')  }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-4">
                                        <dl>
                                            <dt>Nacionalidad</dt>
                                            <dd>{{ $character->nationality ?? "-" }}</dd>
                                            <dt>Edad</dt>
                                            <dd>{{ $character->age ?? "-" }} años</dd>
                                            <dt>Partida</dt>
                                            <dd>
                                                @if($character->campaign)
                                                    <a href="{{ route('campaigns.show', $character->campaign->id) }}">{{ $character->campaign->name }}</a>
                                                @endif
                                            </dd>
                                        </dl>
                                    </div>
                                </div>

                                <h2 class="character-profile-title">¿Quién soy?</h2>
                                {!! $character->description !!}

{{--                                <h2 class="character-profile-title mt-4">Galería de fotos</h2>--}}
{{--                                {!! $character->description !!}--}}
                            </div>
                        </div>
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