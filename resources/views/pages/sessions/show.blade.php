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
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.sessions.index', $selected_campaign->id) }}">Sesiones</a></li>
                            <li class="breadcrumb-item">{{ $session->name }}</li>
                        </ol>
                    </nav>
                </div>
                @if($selected_campaign->user->is(auth()->user()))
                <div class="col-md-4">
                    <div class="buttons float-md-right">
                        <a href="{{ route('sessions.edit', $session->id) }}" class="btn btn-warning btn-square">Editar sesión</a>
                        <span class="dropdown">
                            <a href="" data-toggle="dropdown" class="btn btn-warning btn-square"><i class="fas fa-caret-down"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('sessions.assignments.index', $session->id) }}">Asignar npcs o enemigos</a>
                                <a class="dropdown-item" href="{{ route('sessions.milestones.index', $session->id) }}">Hitos</a>
                            </div>
                        </span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <section class="section-sessions">
        <div class="container">
            <h1 class="mb-0">{{ $session->name }}</h1>
            @if($session->activeTag())
                <h5 class="mini mb-0">{{ "@{$session->activeTag()->tag}" }}</h5>
            @endif
            <div class="box box-border-top session-summary mt-1">
                <div class="votes text-center mb-2">
                    @if(auth()->check() && auth()->user()->isTimeToVote($session))
                        <a href="{{ route('sessions.vote.positive', $session->id) }}"
                           class="btn btn-success btn-square">
                            <i class="fa fa-thumbs-up"></i> {{ $session->positives()->count() }}
                        </a>
                        <a href="{{ route('sessions.vote.negative', $session->id) }}"
                           class="btn btn-danger btn-square">
                            <i class="fa fa-thumbs-down"></i> {{ $session->negatives()->count() }}
                        </a>
                    @else
                        <div style="font-size: 24px;">
                            <span class="text-success"><i class="fa fa-thumbs-up"></i> {{ $session->positives()->count() }}</span>
                            <span class="text-danger"><i class="fa fa-thumbs-down"></i> {{ $session->negatives()->count() }}</span>
                        </div>
                    @endif
                </div>
                <img class="img-thumbnail session-image" src="{{ $session->getImage() }}" alt="">
                <div class="session-custom mt-3">
                    <dl>
                        <dt>Autor</dt>
                        <dd>{{ $session->user->name }}</dd>
                        <dt>Fecha de juego</dt>
                        <dd>{{ $session->date->format('d F Y') }}</dd>
                    </dl>
                    <h4>Resumen</h4>
                    {!! $session->formattedText() !!}
                </div>
            </div>
        </div>
    </section>

    @if($session->milestones()->count() > 0)
    <section>
        <div class="container">
            <h1>Hitos</h1>
            <div class="box box-border-top">
                @foreach($session->milestones as $milestone)
                    <div class="milestone">
                        <div class="row">
                            <div class="col-md-4">
                                <img style="width: 128px" src="{{ $milestone->getImage() }}" alt="">
                            </div>
                            <div class="col-md-8">
                                <div class="milestone-title">{{ $milestone->name }}</div>
                                <div class="milestone-desc">{{ $milestone->description }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($session->npcs()->count() > 0 || $session->enemies()->count() > 0)
        <section>
        <div class="container">
            <h1>Apariciones</h1>
            <div class="box box-border-top session-summary">

                @if($session->npcs()->count() > 0)
                <h2 class="box-title">NPCs</h2>
                <div class="row">
                    @foreach($session->npcs as $npc)
                        <div class="col-md-3">
                            <div class="card" style="padding: 0; border-top: 3px solid cornflowerblue; margin-bottom: 6px;">
                                <div class="card-body" style="padding: 0;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img class="img-thumbnail m-2" src="{{ $npc->getImage() }}" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            <h5 class="card-title" style="padding: 16px 0;">{{ $npc->name }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif

                @if($session->enemies()->count() > 0)
                    <h2 class="box-title">Enemigos</h2>
                    <div class="row">
                        @foreach($session->enemies as $npc)
                            <div class="col-md-3">
                                <div class="card" style="padding: 0; border-top: 3px solid #ed1429; margin-bottom: 6px;">
                                    <div class="card-body" style="padding: 0;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img class="img-thumbnail m-2" src="{{ $npc->getImage() }}" alt="">
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="card-title" style="padding: 16px 0;">{{ $npc->name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <section>
        <div class="container">
            <h1>Diario de los personajes</h1>
            <div class="box box-border-top session-summary journal">
                @forelse($session->posts as $post)
                    <div class="session-post">
                        <div class="journal-opener" data-toggle="collapse"
                             data-target="#journal_{{ str_slug($post->character->name) }}">
                            <div class="row">
                                <div class="col-md-1">
                                    <img class="journal-image-little img-thumbnail" src="{{ $post->character->getImage() }}"  alt="{{ $post->character->name }}">
                                </div>
                                <div class="col-11">
                                    <div class="float-right">
                                        <div class="journal-date">{{ $post->created_at->diffForHumans() }}</div>
                                        @if($post->user->is(auth()->user()))
                                        <div class="journal-buttons">
                                            <a href="{{ route('sessions.posts.edit', $post->id) }}" class="mr-2">Editar</a>
                                            <a href="{{ route('sessions.posts.remove', $post->id) }}">Borrar</a>
                                        </div>
                                        @endif
                                    </div>
                                    <h3 class="journal-character mt-2">{{ $post->character->name }}</h3>
                                    <h4 class="journal-user">{{ $post->user->name }}</h4>
                                </div>
                            </div>
                        </div>
                        <div id="journal_{{ str_slug($post->character->name) }}" class="collapse journal-content">
                            <h2 class="journal-title">{{ $post->title }}</h2>
                            {!! $post->formattedText() !!}
                        </div>
                    </div>
                @empty
                    <div class="pt-2 pl-2">
                        <p>Aun no hay diarios creados para esta sesión</p>
                    </div>
                @endforelse

                @auth
                    @if(auth()->user()->isPlayingCampaign($selected_campaign))
                    <div class="buttons m-2">
                        <a href="{{ route('sessions.posts.create', $session->id) }}" class="btn btn-primary btn-sm">Crear nuevo diario</a>
                    </div>
                    @endif
                @endauth
            </div>

        </div>
    </section>

    @if($session->visites->count() > 0)
    <div class="container">
        <p class="visites">Esta página ha sido visitada por {{ $session->visites->pluck('name')->implode(', ') }}</p>
    </div>
    @endif

    <!-- Large modal -->
    <div id="voteModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="box">
                    <h1 class="text-center">¡No te olvides de puntuar!</h1>
                    <p>Tu feedback es muy importante para el DM. Por favor decinos a continuación qué te pareció la sesión. ¡No tendrás que escribir nada!</p>
                    <div class="votes text-center">
                        <a href="{{ route('sessions.vote.positive', $session->id) }}" class="btn btn-success btn-square"><i class="fa fa-thumbs-up"></i> Me gustó</a>
                        <a href="{{ route('sessions.vote.negative', $session->id) }}" class="btn btn-danger btn-square"><i class="fa fa-thumbs-down"></i> No me gustó</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <section>--}}
{{--        <div class="container">--}}
{{--            <h1>Comentarios</h1>--}}
{{--            <div class="box box-border-top session-summary">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body p-2">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-2">--}}
{{--                                <img class="img-thumbnail" src="https://genubi.com.ar/uploads/personajes/thumb_sarumo-1528841378.jpeg" alt="">--}}
{{--                                <h6 class="text-center">Lucas Lois</h6>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-10">--}}
{{--                                <p>                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est facere harum hic iure perspiciatis quo reprehenderit repudiandae temporibus ullam vitae! Deserunt eum fugit id nobis quaerat tempora, ut? Culpa, ipsa?--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection

@push('js')
    <script>
        @auth
            @if(auth()->user()->isTimeToVote($session))
            $('#voteModal').modal();
            @endif
        @endauth
    </script>
@endpush