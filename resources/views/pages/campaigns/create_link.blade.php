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
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $campaign->id) }}">{{ $campaign->name }}</a></li>
                            <li class="breadcrumb-item">Link de invitación</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Crear link de invitación</h1>
            <div class="box box-border-top">
                <p>Puedes crear un link de invitación para que otros usuarios puedan registrar personajes en tus partidas. El enlace es de uso ilimitado. Si no quieres que más usuarios lo utilicen puedes regenerarlo o deshabilitarlo</p>

                <div class="token">
                    @if($campaign->token)
                        {{ route('campaigns.join.index', $campaign->token) }}
                    @else
                        No hay token activo
                    @endif

                </div>
                <div class="links mt-2">
                    <a href="{{ route('campaigns.link.regenerate', $campaign->id) }}">Regenerar link</a>
                    <a class="ml-3" href="{{ route('campaigns.link.disable', $campaign->id) }}">Deshabilitar</a>
                </div>
            </div>
        </div>
    </section>


@endsection