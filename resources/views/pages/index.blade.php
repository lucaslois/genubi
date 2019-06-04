@extends('layouts.main')


@section('content')
{{--    <section class="main feed-list">--}}
{{--        <div class="container">--}}
{{--            <div class="box">--}}
{{--                <div class="feed-item">--}}
{{--                    <p><a href="#">Lucas Lois</a> ha dejado un comentario en <a href="#">Antiguo mal</a> con <a--}}
{{--                                href="#">Sarumo</a> <span class="feed-date">hace 1 semana</span></p>--}}
{{--                </div>--}}
{{--                <div class="feed-item">--}}
{{--                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto blanditiis delectus ipsa non porro rerum! Ab ad id ipsa ipsam, neque perferendis possimus quidem quos, repellendus, unde velit vero voluptatum!</p>--}}
{{--                </div>--}}
{{--                <div class="feed-item">--}}
{{--                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto blanditiis delectus ipsa non porro rerum! Ab ad id ipsa ipsam, neque perferendis possimus quidem quos, repellendus, unde velit vero voluptatum!</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

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
                            <img class="card-img-top" src="{{ $campaign->getImageMini() }}" alt="{{ $campaign->name }}">
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
                            <img class="card-img-top" src="{{ $session->getImage() }}" alt="Card image cap">
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