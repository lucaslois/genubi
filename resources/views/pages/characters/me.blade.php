@extends('layouts.main')


@section('content')
    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mis personajes</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-8">
                    <div class="buttons float-md-right">
                        <a href="{{ route('characters.create') }}" class="btn btn-success btn-square">Crear personaje</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Mis personajes</h1>
            <div class="box box-border-top">
                <p>Aquí se listan todos tus personajes.</p>
                <div class="form-group">
                    <input type="text"class="form-control" placeholder="Buscador...">
                </div>
            </div>
        </div>
    </section>

    <section class="main campaigns">
        <div class="container">
            <div class="row character-list">
                @forelse($characters as $character)
                    <div class="col-sm-6">
                        <div class="card character">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="img-thumbnail character-avatar" src="{{ $character->getImage() }}" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="character-title">{{ $character->name }}
                                            @if($character->campaign)
                                            <span class="character-owner">de {{ $character->campaign->name }}</span>
                                            @endif
                                        </h5>
                                        <p class="character-data">{{ $character->race }}, oriundo de {{ $character->nationality }}</p>
                                        <p class="character-desc">{{ $character->description }}</p>
                                        <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="{{ route('characters.show', $character->id) }}" class="btn btn-primary btn-sm">Ver personaje</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="box">
                            <p>Aun no has creado ningún personaje. ¡Puedes hacer <a href="{{ route('characters.create') }}">click aquí</a> para crear uno!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection