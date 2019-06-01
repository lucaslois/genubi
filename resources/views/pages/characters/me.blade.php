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
                        <a href="{{ route('characters.create') }}" class="btn btn-success btn-square btn-upper">Crear personaje</a>
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
                <form action="">
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

    <section class="main campaigns">
        <div class="container">
            <div class="row character-list">
                @forelse($characters as $character)
                    <div class="col-sm-6">
                        <div class="card character">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="img-thumbnail" src="{{ $character->getImage() }}" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="character-title">{{ $character->name }} <span class="character-level">Nv. {{ $character->currentLevel() }}</span></h5>
                                        @if($character->campaign)
{{--                                        <p class="character-data character-data-owner">en {{ $character->campaign->name }}</p>--}}
                                        <span class="badge badge-pill badge-success">{{ $character->campaign->name }}</span>
                                        @endif

                                        <p class="character-data">{{ $character->race }} |
                                            {{ $character->classes->implode('name', ', ')  }}
                                        </p>
                                        @if($character->nationality)
                                            <p class="character-data">Oriundo de {{ $character->nationality }}</p>
                                        @endif
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