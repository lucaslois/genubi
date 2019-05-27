@extends('layouts.main')


@section('content')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active"><a href="#">NPCs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Edición de NPC</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('npcs.update', $npc->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="campaign_id">Partida</label>
                                <input
                                        id="campaign_id"
                                        type="text"
                                        class="form-control {!! $errors->first('campaign_id', 'is-invalid') !!}"
                                        value="{{ $npc->campaign->name }}"
                                        disabled>
                            </div>

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name', $npc->name) }}"
                                        class="form-control {!! $errors->first('name', 'is-invalid') !!}">
                                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="color">Color</label>
                                <input
                                        id="color"
                                        name="color"
                                        type="color"
                                        value="{{ old('color', $npc->color) }}"
                                        class="form-control {!! $errors->first('date', 'is-invalid') !!}">
                                {!! $errors->first('color', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="avatar">Imagen de fondo</label>
                                <input
                                        id="avatar"
                                        name="avatar"
                                        type="file"
                                        value="{{ old('avatar') }}"
                                        class="form-control {!! $errors->first('avatar', 'is-invalid') !!}">
                                {!! $errors->first('avatar', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="text">Descripción</label>
                                <textarea
                                        id="text"
                                        name="text"
                                        type="text"
                                        class="form-control {!! $errors->first('text', 'is-invalid') !!}">{{ old('text', $npc->text) }}</textarea>
                                {!! $errors->first('text', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="enemy">Enemigo</label>
                                <input
                                        id="enemy"
                                        name="enemy"
                                        type="checkbox"
                                        class="{!! $errors->first('enemy', 'is-invalid') !!}"
                                        {{ $npc->enemy ? 'checked' : '' }}
                                >
                                {!! $errors->first('enemy', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

