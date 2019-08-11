@extends('layouts.main')


@section('content')
    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">{{ $selected_campaign->name }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('knowledges.index', ['campaign_id' => $selected_campaign->id]) }}">Conocimientos</a></li>
                            <li class="breadcrumb-item active">{{ $knowledge->name }}</li>
                        </ol>
                    </nav>
                </div>
                @if($knowledge->user->is(auth()->user()))
                    <div class="col-4">
                        <div class="buttons float-md-right">
                            <a href="{{ route('knowledges.edit', $knowledge->id) }}" class="btn btn-yellow btn-upper">Editar descubrimiento</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </section>

    <section class="character-profile">
        <div class="container">
            <h1 class="mb-0">{{ $knowledge->name }}</h1>
            <div class="box box-border-top mt-1">
                <div class="knowledge">
                    <div class="knowledge-header">
                        <div class="float-right">
                            @if($knowledge->characters->count() > 0 || $knowledge->share_everyone)
                                Compartido con
                                @if($knowledge->share_everyone)
                                    <span class="badge badge-success">Todos</span>
                                @else
                                    @foreach($knowledge->characters as $chac)
                                        <span class="badge badge-dark" style="{{ $chac->color }}">{{ $chac->name }}</span>
                                    @endforeach
                                @endif
                            @endif

                        </div>
                        @if($knowledge->character)
                            <img class="knowledge-image" src="{{ $knowledge->character->getImage() }}" alt="">
                            <p class="knowledge-username">
                                por <a href="{{ route('characters.show', $knowledge->character->id) }}">{{ $knowledge->character->name }}</a> <span class="mini">{{ $knowledge->user->name }}</span>
                                <br>
                                {{ $knowledge->created_at->diffForHumans() }}
                            </p>
                        @else
                            <img class="knowledge-image" src="{{ $knowledge->user->getImage() }}" alt="">
                            <p class="knowledge-username">
                                por <a href="{{ route('users.show', $knowledge->user->id) }}">{{ $knowledge->user->name }}</a>
                                @if($knowledge->isDM())
                                    <span class="badge badge-warning">Conocimiento del DM</span>
                                @endif
                                <br>
                                {{ $knowledge->created_at->diffForHumans() }}
                            </p>
                        @endif
                    </div>
                    <div class="knowledge-content">
                        {!! $knowledge->formattedText() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection