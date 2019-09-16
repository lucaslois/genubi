@extends('layouts.main')


@section('content')
    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">{{ $selected_campaign->name }}</a></li>
                            <li class="breadcrumb-item active">Canales</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6">
                    <div class="buttons float-md-right">
                        @if(auth()->check())
                            <a href="{{ route('channels.create', ['campaign_id' => $selected_campaign->id]) }}" class="btn btn-success btn-square">Crear nuevo canal</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Canales</h1>
            <div class="box box-border-top">
                <p>Aquí se listan todos los canales creados en la campaña. Un canal es una via de comunicación que le permite a los jugadores rolear por fuera de una sesión.</p>
            </div>
        </div>
    </section>

    <section class="main section-sessions">
        <div class="container">
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
                        {{ $channels->links() }}
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Creado por</th>
                                <th>Último post</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($channels as $channel)
                                <tr>
                                    <td width="60%">
                                        <a href="{{ route('channels.show', $channel->id) }}">
                                            @if($channel->closed)
                                                <span class="badge badge-pill bg-danger channel-icon"><i class="fas fa-lock"></i></span>
                                            @endif
                                            {{ $channel->name }}
                                        </a>
                                        <p style="font-size: 14px; ">{{ strip_tags($channel->text) }}</p>
                                    </td>
                                    <td>{{ $channel->user->name }}</td>
                                    <td>
                                        @if($channel->posts->last())
                                            {{ $channel->posts->last()->participant()->getName() }}, {{ $channel->posts->last()->created_at->diffForHumans() }}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Aun no hay canales creados en {{ $selected_campaign->name }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $channels->links() }}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection