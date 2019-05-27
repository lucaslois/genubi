@extends('layouts.main')


@section('content')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nuevo personaje</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Creación de nuevo personaje</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('characters.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name') }}"
                                        class="form-control {!! $errors->first('name', 'is-invalid') !!}">
                                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="race">Raza</label>
                                <input
                                        id="race"
                                        name="race"
                                        type="text"
                                        value="{{ old('race') }}"
                                        class="form-control {!! $errors->first('race', 'is-invalid') !!}">
                                {!! $errors->first('race', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="age">Edad</label>
                                <input
                                        id="age"
                                        name="age"
                                        type="text"
                                        value="{{ old('age') }}"
                                        class="form-control {!! $errors->first('age', 'is-invalid') !!}">
                                {!! $errors->first('age', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="nationality">Nacionalidad</label>
                                <input
                                        id="nationality"
                                        name="nationality"
                                        type="text"
                                        value="{{ old('nationality') }}"
                                        class="form-control {!! $errors->first('nationality', 'is-invalid') !!}"
                                        placeholder="Indicanos en qué ciudad o pais naciste"
                                >
                                {!! $errors->first('nationality', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input
                                        id="avatar"
                                        name="avatar"
                                        type="file"
                                        value="{{ old('avatar') }}"
                                        class="form-control {!! $errors->first('avatar', 'is-invalid') !!}"
                                        placeholder="Indicanos en qué ciudad o pais naciste"
                                >
                                {!! $errors->first('avatar', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="description">Resumen</label>
                                <textarea
                                        id="description"
                                        name="description"
                                        type="text"
                                        class="form-control {!! $errors->first('description', 'is-invalid') !!}"
                                        placeholder="¡Contanos un poco sobre vos! Podés resumir sobre quién es tu personaje, cuales son sus principales motivaciones y por qué participa en la campaña"
                                >{{ old('description') }}</textarea>
                                {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="col-4">
                        <p>Si estás creando tu personaje con intenciones de hacerlo participar en una partida, no te preocupes, ¡podrás hacerlo cuando te envíen el link de invitación!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection