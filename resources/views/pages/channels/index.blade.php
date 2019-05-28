@extends('layouts.main')


@section('content')
    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">Antiguo Mal</a></li>
                            <li class="breadcrumb-item active">Canales</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-8">
                    <div class="buttons float-md-right">
                        <a href="{{ route('channels.create') }}" class="btn btn-success btn-square">Crear nuevo canal</a>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Canales</h1>
            <div class="box box-border-top">
                <p>Aquí se listan todas las sesiones que se fueron jugando en la campaña. Aquí se recopila información sobre qué sucedio en cada una de las sesiones. Se podrán encontrar detalles como un resumen, publicaciones de los personajes, la repartida de experiencia, cuales fueron los NPCs más relevantes, cuales fueron los enemigos abatidos, etc.</p>
            </div>
        </div>
    </section>

    <section class="main section-sessions">
        <div class="container">
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
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
                                        <a href="{{ route('channels.show', $channel->id) }}">{{ $channel->name }}</a>
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