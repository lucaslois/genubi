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
                                <img class="img-thumbnail" src="{{ $character->getImage() }}" alt="">
                            </div>
                            <div class="col-8">
                                <h2 class="character-profile-title">Ficha de personaje</h2>
                                <div class="row">
                                    <div class="col-4">
                                        <dl>
                                            <dt>Nombre</dt>
                                            <dd>{{ $character->name }}</dd>
                                            <dt>Raza</dt>
                                            <dd>{{ $character->race }}</dd>
                                            <dt>Clases</dt>
                                            <dd>{{ "Mago" }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-4">
                                        <dl>
                                            <dt>Nacionalidad</dt>
                                            <dd>{{ $character->nationality }}</dd>
                                            <dt>Edad</dt>
                                            <dd>{{ $character->age }} años</dd>
                                            <dt>Partida</dt>
                                            <dd>{{ $character->campaign->name ?? "-" }}</dd>
                                        </dl>
                                    </div>
                                </div>

                                <h2 class="character-profile-title">¿Quién soy?</h2>
                                {!! $character->description !!}

                                <h2 class="character-profile-title mt-4">Galería de fotos</h2>
                                {!! $character->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-experience" role="tabpanel">
                        <div class="alert alert-success">
                            Nivel: {{ $character->currentLevel() }}
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