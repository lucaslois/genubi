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
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $campaign->id) }}">{{ $selected_campaign->name }}</a></li>
                            <li class="breadcrumb-item active">Sesiones</li>
                        </ol>
                    </nav>
                </div>
                @if($campaign->user->is(auth()->user()))
                <div class="col-md-6">
                    <div class="buttons float-md-right">
                        <a href="{{ route('sessions.create', ['campaign_id' => $selected_campaign->id]) }}" class="btn btn-success btn-upper">Crear sesión</a>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Sesiones</h1>
            <div class="box box-border-top">
                <p>Aquí se listan todas las sesiones que se fueron jugando en la campaña. Aquí se recopila información sobre qué sucedio en cada una de las sesiones. Se podrán encontrar detalles como un resumen, publicaciones de los personajes, la repartida de experiencia, cuales fueron los NPCs más relevantes, cuales fueron los enemigos abatidos, etc.</p>
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
                            <input type="submit" class="btn btn-yellow btn-upper" value="Buscar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="main section-sessions">
        <div class="container">
            {{ $sessions->links() }}
            <div class="row">
                @forelse($sessions as $session)
                    <div class="col-md-4">
                        <div class="card session">
                            <div style="background-image: url('{{ $session->getImage() }}')"
                                 class="campaign-card-header">
                            </div>
                            <div class="card-body">
                                <h5 class="session-title">{{ str_limit($session->name, 30) }}</h5>
                                <span class="session-details">{{ $session->date->diffForHumans() }} ({{ $session->date->format('d/M/Y') }}), <a href="{{ route('users.show', $session->user->id) }}">{{ $session->user->name }}</a></span>
                                <p class="card-text session-description">
                                    {{ str_limit(strip_tags($session->text), 100) }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('sessions.show', $session->id) }}" class="btn btn-primary btn-sm">Ver sesión</a>
                                <div class="float-md-right">
                                    <span class="badge text-success reaction"><i class="fa fa-thumbs-up"></i> {{ $session->positives()->count() }}</span>
                                    <span class="badge text-danger reaction"><i class="fa fa-thumbs-down"></i> {{ $session->negatives()->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="box">
                            No hemos encontrado sesiones
                        </div>
                    </div>
                @endforelse
            </div>

            {{ $sessions->links() }}
        </div>
    </section>
@endsection