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
                            <li class="breadcrumb-item"><a
                                        href="{{ route('campaigns.npcs.index', $selected_campaign->id) }}">Npcs</a></li>
                            <li class="breadcrumb-item active">{{ $npc->name }}</li>
                        </ol>
                    </nav>
                </div>
                @if($npc->campaign->user->is(auth()->user()))
                <div class="col-6">
                    <div class="buttons float-md-right">
                        <a href="{{ route('npcs.edit', $npc->id) }}" class="btn btn-yellow btn-upper">Editar npc</a>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </section>

    <section class="character-profile">
        <div class="container">
            <h1 class="mb-0">{{ $npc->name }}</h1>
            @if($npc->slug)
                <h5 class="mini mb-0">{{ "@$npc->slug" }}</h5>
            @endif
            <div class="box box-border-top mt-1">
                <img src="{{ $npc->getImage() }}" alt="">
                <div class="text mt-3">
                    {!! $npc->formattedText() !!}
                </div>
            </div>
        </div>
    </section>

    <section class="main campaigns">
        <div class="container">
            <div class="row character-list">

            </div>
        </div>
    </section>
@endsection