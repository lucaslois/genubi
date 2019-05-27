@extends('layouts.main')


@section('content')
    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-8">
                    <div class="buttons float-md-right">
                        <a href="{{ route('characters.create') }}" class="btn btn-success btn-square">Crear personaje</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="character-profile">
        <div class="container">
            <h1>Personaje: {{ $character->name }}</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-4">
                        <img style="width: 320px" src="{{ asset('images/sarumo.jpg') }}" alt="">
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
        </div>
    </section>

    <section class="main campaigns">
        <div class="container">
            <div class="row character-list">

            </div>
        </div>
    </section>
@endsection