@extends('layouts.main')


@section('content')
    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Partidas</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-8">
                    <div class="buttons float-md-right">
                        @auth
                        <a href="{{ route('campaigns.create') }}" class="btn btn-success btn-square">Crear campaña</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Partidas</h1>
            <div class="box box-border-top">
                <p>Aquí se listan todas las partidas dadas de altas en Genubi. Estarán ordenadas en base a su popularidad.</p>
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="search"
                                       type="text"
                                       class="form-control"
                                       placeholder="Buscador..."
                                       value="{{ request()->search }}"
                                >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-success" value="Buscar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="main campaigns">
        <div class="container">
            <div class="row">
                @forelse($campaigns as $campaign)
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
                @empty
                    <div class="col-12">
                        <div class="box">
                            No se han encontrado campañas
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection