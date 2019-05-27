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
                        <a href="{{ route('npcs.create') }}" class="btn btn-success btn-square">Crear NPC</a>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>NPCs</h1>
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
                                <th>Foto</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($npcs as $npc)
                                <tr>
                                    <td><img class="img-thumbnail npc-avatar" src="{{ $npc->getImage() }}" alt=""></td>
                                    <td><div class="square" style="background-color: {{ $npc->color }}"></div> {{ $npc->name }}</td>
                                    <td>{{ $npc->description }}</td>
                                    <td><a href="{{ route('npcs.edit', $npc->id) }}">Editar</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Aun no hay NPCs</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $npcs->links() }}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection