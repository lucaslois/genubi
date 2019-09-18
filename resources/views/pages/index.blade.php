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
                        @component('layouts/components/campaign_card', ['campaign' => $campaign])
                        @endcomponent
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
                        @component('layouts/components/session_card', ['session' => $session])
                        @endcomponent
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection