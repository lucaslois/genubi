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
                            <li class="breadcrumb-item active">Reglas de la casa</li>
                        </ol>
                    </nav>
                </div>
                @if($selected_campaign->user->is(auth()->user()))
                <div class="col-md-6">
                    <div class="buttons float-md-right">
                        <a href="{{ route('homebrews.create') }}" class="btn btn-success btn-square">Crear regla de la casa</a>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Reglas de la casa</h1>
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
                                <th>Reglas</th>
                                <th>Última modificación</th>
                                <th>Creado por</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($homebrews as $homebrew)
                                <tr>
                                    <td width="60%">
                                        <a href="{{ route('homebrews.show', $homebrew->id) }}">{{ $homebrew->name }}</a>
                                        <p style="font-size: 14px; ">{{ strip_tags($homebrew->text) }}</p>
                                    </td>
                                    <td>{{ $homebrew->updated_at->format('d/M/Y') }} ({{ $homebrew->updated_at->diffForHumans() }})</td>
                                    <td><a href="#">{{ $homebrew->user->name }}</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Aun no hay reglas de la casa</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $homebrews->links() }}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection