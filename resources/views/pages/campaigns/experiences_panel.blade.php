@extends('layouts.main')

@section('content')
    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">{{ $selected_campaign->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gestor de experiencias</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4">
                    <div class="buttons float-md-right">
                        <a href="{{ route('campaigns.experiences.index', $selected_campaign->id) }}" class="btn btn-warning btn-square">Repartir experiencias</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Gestor de experiencias</h1>
            <div class="box box-border-top">
                <form action="{{ route('campaigns.experiences.store', $selected_campaign->id) }}" method="POST">
                    @csrf
                    @method("POST")
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th rowspan="2">Personaje</th>
                            <th rowspan="2">Acumulada</th>
                            <th colspan="{{ $last_sessions->count() }}">Sesiones</th>
                        </tr>
                        <tr>
                            @foreach($last_sessions as $session)
                                <th>{{ str_limit($session->name, 10) }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($characters as $character)
                            @php
                                $xp_percentage = round($character->currentXp() * 100 / $character->xpForNextLevel($character->currentLevel()));
                            @endphp
                            <tr>
                                <td>{{ $character->name }}</td>
                                <td>{{ mile_separator($character->experiences()->sum('value')) }}</td>
                                @foreach($last_sessions as $session)
                                    <td>{{ mile_separator($character->experiences()->whereSessionId($session->id)->value('value')) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <input type="submit" class="btn btn-primary" value="Confirmar">
                </form>
            </div>
        </div>
    </section>


@endsection