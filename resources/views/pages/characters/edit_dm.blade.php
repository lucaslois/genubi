@extends('layouts.main')


@section('content')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edición de personaje</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Editar personaje</h1>
            <div class="box box-border-top">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-default" role="tab" >Perfil</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-default" role="tabpanel">
                        <div class="row">
                            <div class="col-8">
                                <form action="{{ route('characters.dm.update', $character->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input
                                                id="name"
                                                name="name"
                                                type="text"
                                                value="{{ old('name', $character->name) }}"
                                                class="form-control {!! $errors->first('name', 'is-invalid') !!}">
                                        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="family">Familia</label>
                                        <input
                                                id="family"
                                                name="family"
                                                type="text"
                                                value="{{ old('family', $character->family) }}"
                                                class="form-control {!! $errors->first('family', 'is-invalid') !!}"
                                                placeholder="Familia/Casa/Apellido/Clan"
                                        >
                                        {!! $errors->first('family', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="race">Raza</label>
                                        <input
                                                id="race"
                                                name="race"
                                                type="text"
                                                value="{{ old('race', $character->race) }}"
                                                class="form-control {!! $errors->first('race', 'is-invalid') !!}">
                                        {!! $errors->first('race', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="age">Edad</label>
                                        <input
                                                id="age"
                                                name="age"
                                                type="text"
                                                value="{{ old('age', $character->age) }}"
                                                class="form-control {!! $errors->first('age', 'is-invalid') !!}">
                                        {!! $errors->first('age', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="nationality">Nacionalidad</label>
                                        <input
                                                id="nationality"
                                                name="nationality"
                                                type="text"
                                                value="{{ old('nationality', $character->nationality) }}"
                                                class="form-control {!! $errors->first('nationality', 'is-invalid') !!}"
                                                placeholder="Indicanos en qué ciudad o pais naciste"
                                        >
                                        {!! $errors->first('nationality', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <input
                                                id="color"
                                                name="color"
                                                type="color"
                                                value="{{ old('color', $character->color) }}"
                                                class="form-control {!! $errors->first('color', 'is-invalid') !!}"
                                        >
                                        {!! $errors->first('color', '<div class="invalid-feedback">:message</div>') !!}
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
                                        <label for="state_id">Estado</label>
                                        <select
                                                id="state_id"
                                                name="state_id"
                                                type="file"
                                                value="{{ old('state_id') }}"
                                                class="form-control {!! $errors->first('state_id', 'is-invalid') !!}"
                                        >
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}" {{ $state->is($character->state) ? 'selected' : '' }}>{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('state_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Resumen</label>
                                        <textarea
                                                id="description"
                                                name="description"
                                                type="text"
                                                class="form-control {!! $errors->first('description', 'is-invalid') !!}"
                                                placeholder="¡Contanos un poco sobre vos! Podés resumir sobre quién es tu personaje, cuales son sus principales motivaciones y por qué participa en la campaña"
                                        >{{ old('description', $character->description) }}</textarea>
                                        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <input type="submit" value="Guardar" class="btn btn-primary">
                                </form>
                            </div>
                            <div class="col-4">
                                <img class="img-thumbnail" src="{{ $character->getImage() }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection