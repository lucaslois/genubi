@extends('layouts.main')


@section('content')
    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $campaign->id) }}">Antiguo Mal</a></li>
                            <li class="breadcrumb-item">Editar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <h1>Edición de partida</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name', $campaign->name) }}"
                                        class="form-control {!! $errors->first('name', 'is-invalid') !!}">
                                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="game_id">Juego</label>
                                <select
                                        id="game_id"
                                        name="game_id"
                                        type="text"
                                        class="form-control {!! $errors->first('game_id', 'is-invalid') !!}">
                                    @foreach($games as $game)
                                        <option value="{{ $game->id }}" {{ \app\Helpers\selectedIfModelEquals($game, $campaign->game) }}>{{ $game->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('game_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="mode_id">Modo de juego</label>
                                <select
                                        id="mode_id"
                                        name="mode_id"
                                        type="text"
                                        class="form-control {!! $errors->first('mode_id', 'is-invalid') !!}">
                                    @foreach($modes as $mode)
                                        <option value="{{ $mode->id }}"{{ \app\Helpers\selectedIfModelEquals($mode, $campaign->mode) }}>{{ $mode->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('mode_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="background_image">Imagen de fondo</label>
                                <input
                                        id="background_image"
                                        name="background_image"
                                        type="file"
                                        value="{{ old('background_image') }}"
                                        class="form-control {!! $errors->first('background_image', 'is-invalid') !!}">
                                {!! $errors->first('background_image', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="short_description">Tu partida en pocas palabras</label>
                                <textarea
                                        id="short_description"
                                        name="short_description"
                                        type="text"
                                        placeholder="Un grupo de aventureros que no comparten nada en común se reunen para derrotar al mal cósmico más peligroso de todos los tiempos"
                                        class="form-control {!! $errors->first('short_description', 'is-invalid') !!}">{{ old('short_description') }}</textarea>
                                {!! $errors->first('short_description', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="description">Resumen</label>
                                <textarea
                                        id="description"
                                        name="description"
                                        type="text"
                                        placeholder="Acá podés explayarte todo lo que quieras con la descripción de tu partida"
                                        class="form-control {!! $errors->first('description', 'is-invalid') !!}">{{ old('description', $campaign->description) }}</textarea>
                                {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="state_id">Estado</label>
                                <select
                                        id="state_id"
                                        name="state_id"
                                        type="text"
                                        class="form-control {!! $errors->first('state_id', 'is-invalid') !!}">
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}"{{ \app\Helpers\selectedIfModelEquals($state, $campaign->state) }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('state_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection