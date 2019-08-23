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
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.channels.index', $selected_campaign->id) }}">Canales</a></li>
                            <li class="breadcrumb-item active">{{ $channel->name }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-6">
                    <div class="buttons float-md-right">
                        @if(auth()->check() && !$channel->closed)
                        <a href="{{ route('channels.dices.create', $channel->id) }}" class="btn btn-success btn-square"><i class="fas fa-dice-three"></i> Lanzar dados</a>
                        <a href="{{ route('channels.posts.create', $channel->id) }}" class="btn btn-success btn-square"><i class="fas fa-edit"></i> Crear post</a>
                        @endif
                        @if($channel->user->is(auth()->user()) || $channel->campaign->user->is(auth()->user()))
                        <a href="{{ route('channels.edit', $channel->id) }}" class="btn btn-warning btn-square">Editar</a>
                        @endif
                        @if($channel->campaign->user->is(auth()->user()))
                        <span class="dropdown">
                            <a href="" data-toggle="dropdown" class="btn btn-warning btn-square"><i class="fas fa-caret-down"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if($channel->closed)
                                    <a class="dropdown-item" href="{{ route('channels.open', $channel->id) }}"><i class="fas fa-unlock"></i> Abrir canal</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('channels.close', $channel->id) }}"><i class="fas fa-lock"></i> Cerrar canal</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('channels.remove', $channel->id) }}"><i class="fas fa-trash"></i> Eliminar canal</a>
                            </div>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>
                @if($channel->closed)
                    <span class="badge badge-pill bg-danger channel-icon"><i class="fas fa-lock"></i></span>
                @endif
                {{ $channel->name }}
            </h1>
            <div class="box box-border-top">
                <div class="content">
                    <div class="row">
                        <div class="col-6">
                            <dl>
                                <dt>Título del canal</dt>
                                <dd>{{ $channel->name }}</dd>
                                <dt>Autor</dt>
                                <dd>{{ $channel->user->name }}</dd>
                                <dt>Fecha de creación</dt>
                                <dd>{{ $channel->created_at->format('d F Y') }}</dd>
                                <dt>Usuarios suscritos</dt>
                                <dd>{{ $channel->suscribedUsers->pluck('name')->implode(', ') }}</dd>
                            </dl>
                        </div>
                        <div class="col-6">
                            <dl>
                                <dt>Cantidad de posts</dt>
                                <dd>{{ $channel->posts()->count() }}</dd>
                                <dt>Estado</dt>
                                <dd>{{ $channel->created_at->format('d/M/Y') }}</dd>
                                <dt>Participantes</dt>
                                <dd>{!! $channel->characters->map(function($character) {
                                    return "<span style='background: {$character->color}' class='badge badge-pill'>{$character->name}</span>";
                                })->implode(', ') !!}</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="description">
                        <b>Resumen</b>
                        {!! $channel->formattedText()  !!}
                    </div>

                    @auth
                    <div class="buttons mb-5">
                        @if($channel->suscribedUsers->contains(auth()->user()))
                            <a href="{{ route('channels.unsuscribe', $channel->id) }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-bell-slash"></i> Desuscribirme</a>
                        @else
                            <a href="{{ route('channels.suscribe', $channel->id) }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-bell"></i> Suscribirme</a>
                        @endif
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            {{ $posts->links() }}
        @foreach($posts as $post)
            <div class="card box-border-top channel-post mb-2">
                <div class="row">
                    <div class="col-2 text-center">
                        <div class="channel-sidebar">
                            <img class="channel-image img-thumbnail" src="{{ $post->participant()->getImage() }}" alt="">
                            <h3 class="channel-character">{{ $post->participant()->getName() }}</h3>
                            <div class="channel-line" style="background: {{ $post->participant()->getColor() }}"></div>
                            <p class="channel-user"><span class="channel-user">{{ $post->user->name }}</span></p>
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="channel-bar">{{ $post->created_at->format('d/M/Y') }} ({{ $post->created_at->diffForHumans() }})</div>
                        <div class="channel-content">
                            @if($post->only_dm == true && $selected_campaign->user->isNot(auth()->user()))
                            <p class="only-dm">Tirada visible sólo para el DM</p>
                            @else
                            <p>{!! $post->formattedText() !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer channel-footer">
                    @if($post->is_roll == false  && $post->user->is(auth()->user()))
                        <a href="{{ route('posts.edit', $post->id) }}" class="float-right ml-4"><i class="fas fa-edit"></i> Editar</a>
                    @endif
                    <a href="{{ route('channels.posts.create', [$channel->id, 'post_id' => $post->id]) }}" class="float-right"><i class="fas fa-reply"></i> Responder</a>
                </div>
            </div>
            @endforeach
            {{ $posts->links() }}
        </div>
    </section>
@endsection