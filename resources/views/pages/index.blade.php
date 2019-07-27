@extends('layouts.main')


@section('content')
    <section class="main feed-list">
        <div class="container">
            <h1>Actividad</h1>
            <div class="box">
                @foreach($activities as $activity)
                    <div class="feed-item">
                        <p>{!! $activity->formatted_text !!} <span class="feed-date">{{ $activity->created_at->diffForHumans() }}</span></p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

{{--    <section class="main news">--}}

{{--        <div class="container">--}}
{{--            <div class="box">--}}
{{--                <div class="article">--}}
{{--                    <h1 class="article_title">¡Bienvenidos a Genubi!</h1>--}}
{{--                    <div class="details">--}}
{{--                        <span class="data author">Escrito por <a href="#">Lucas Lois</a> | 15/01/2019 (hace 4 dias)</span>--}}
{{--                    </div>--}}
{{--                    <div class="content">--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio doloremque eligendi esse eveniet facere fugit, inventore modi neque obcaecati quaerat quibusdam, repellat sequi temporibus vitae voluptatibus! Sequi tempora, totam. Adipisci?</p>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio doloremque eligendi esse eveniet facere fugit, inventore modi neque obcaecati quaerat quibusdam, repellat sequi temporibus vitae voluptatibus! Sequi tempora, totam. Adipisci?</p>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio doloremque eligendi esse eveniet facere fugit, inventore modi neque obcaecati quaerat quibusdam, repellat sequi temporibus vitae voluptatibus! Sequi tempora, totam. Adipisci?</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="view-more text-center">--}}
{{--                <a href="#">Ver todas las noticias</a>--}}
{{--            </div>--}}
{{--            <hr>--}}
{{--        </div>--}}

{{--    </section>--}}

    <section class="main partidas">
        <div class="container">
            <h1>Partidas populares</h1>
            <div class="row">
                @foreach($campaigns as $campaign)
                    <div class="col-md-4">
                        <div class="card campaign">
                            <div style="background-image: url('{{ $campaign->getImageMini() }}')"
                                 class="campaign-card-header">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $campaign->name }}</h5>
                                <span class="campaign_details">{{ $campaign->game->name }}, por <a href="">{{ $campaign->user->name }}</a></span>
                                <p class="card-text campaign campaign_description">
                                    {{ $campaign->description }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-primary btn-sm">Ver partida</a>
                                <div class="float-md-right">
                                    <span class="badge bg-success reaction"><i class="fa fa-thumbs-up"></i> {{ $campaign->positives() }}</span>
                                    <span class="badge bg-danger reaction"><i class="fa fa-thumbs-down"></i> {{ $campaign->negatives() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
        </div>
    </section>
    <section class="main partidas section-sessions">
        <div class="container">
            <h1>Últimas sesiones</h1>
            <div class="row">
                @foreach($sessions as $session)
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