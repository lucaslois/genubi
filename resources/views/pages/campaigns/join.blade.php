@extends('layouts.main')

@section('content')
    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active"><a href="#">Partidas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Entrar en una partida</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Entrar a una partida</h1>
            <div class="box box-border-top">
                <p>Estás a punto de entrar a la partida <b>{{ $campaign->name }}</b>, dirigida por <a href="{{ route('users.show', $campaign->user->id) }}">{{ $campaign->user->name }}</a>.</p>
                @if($characters->count() > 0)
                <p>Selecciona con qué personaje deseas entrar</p>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('campaigns.join.store', $campaign->token) }}" method="POST">
                                @csrf
                                @method("POST")
                                <div class="form-group">
                                    <select name="character_id" id="character_id" class="form-control">
                                        @foreach($characters as $character)
                                            <option value="{{ $character->id }}">{{ $character->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p>Si el personaje que quieres ingresar no está en esta lista, <a href="{{ route('characters.create', ['join_link' => $campaign->token]) }}">has click aquí</a> para ir a crearlo y luego vuelve a este lugar</p>

                                <input class="btn btn-success" type="submit" value="¡Entrar a la aventura!">
                            </form>
                        </div>
                    </div>
                @else
                <p>Aun no tienes creado ningún personaje. <a href="{{ route('characters.create', ['join_link' => $campaign->token]) }}">Has click aquí</a> para ir a la página de creación de personajes y cuando termines regresa a este lugar</p>
                @endif

            </div>
        </div>
    </section>


@endsection