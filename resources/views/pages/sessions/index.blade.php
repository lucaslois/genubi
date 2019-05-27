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
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $campaign->id) }}">Antiguo Mal</a></li>
                            <li class="breadcrumb-item active">Sesiones</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-8">
                    <div class="buttons float-md-right">
                        <a href="{{ route('sessions.create') }}" class="btn btn-success btn-square">Crear sesión</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Sesiones</h1>
            <div class="box box-border-top">
                <p>Aquí se listan todas las sesiones que se fueron jugando en la campaña. Aquí se recopila información sobre qué sucedio en cada una de las sesiones. Se podrán encontrar detalles como un resumen, publicaciones de los personajes, la repartida de experiencia, cuales fueron los NPCs más relevantes, cuales fueron los enemigos abatidos, etc.</p>
            </div>
        </div>
    </section>

    <section class="main section-sessions">
        <div class="container">
            <div class="row">
                @foreach($sessions as $session)
                    <div class="col-md-4">
                        <div class="card session">
                            <img class="card-img-top" src="{{ $session->getImage() }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="session-title">{{ $session->name }}</h5>
                                <span class="session-details">{{ $session->date->diffForHumans() }} ({{ $session->date->format('d/M/Y') }}), <a href="{{ route('users.show', $session->user->id) }}">{{ $session->user->name }}</a></span>
                                <p class="card-text session-description">
                                    {{ str_limit(strip_tags($session->text), 100) }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('sessions.show', $session->id) }}" class="btn btn-primary btn-sm">Ver sesión</a>
                                <div class="float-md-right">
                                    <span class="badge bg-success reaction"><i class="fa fa-thumbs-up"></i> {{ $session->positives()->count() }}</span>
                                    <span class="badge bg-danger reaction"><i class="fa fa-thumbs-down"></i> {{ $session->negatives()->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection