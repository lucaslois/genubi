@extends('layouts.main')


@section('content')
    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mis personajes</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6">
                    <div class="buttons float-md-right">
                        <a href="{{ route('campaigns.create') }}" class="btn btn-success btn-square">Crear personaje</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Mis personajes</h1>
            <div class="box box-border-top">
                <p>Aquí se listan todas las partidas dadas de altas en Genubi. Estarán ordenadas en base a su popularidad.</p>
                <div class="form-group">
                    <input type="text"class="form-control" placeholder="Buscador...">
                </div>
            </div>
        </div>
    </section>

    <section class="main campaigns">
        <div class="container">
            <div class="row">
                @foreach($campaigns as $campaign)
                    <div class="col-md-4">
                        <div class="card campaign">
                            <img class="card-img-top" src="{{ $campaign->getImage() }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $campaign->name }}</h5>
                                <span class="campaign_details">{{ $campaign->game->name }}, por <a href="">{{ $campaign->user->name }}</a></span>
                                <p class="card-text campaign campaign_description">
                                    {{ $campaign->description }}
                                </p>
                                <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-primary btn-sm">Ver partida</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection