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
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-class" role="tab" >Clases</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-default" role="tabpanel">
                        <div class="row">
                            <div class="col-8">
                                <form action="{{ route('characters.update', $character->id) }}" method="POST" enctype="multipart/form-data">
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

                                    <div class="form-group">
                                        <label for="desc_mentality">Mentalidad <span class="mini">(opcional)</span></label>
                                        <textarea
                                                id="desc_mentality"
                                                name="desc_mentality"
                                                type="text"
                                                class="form-control {!! $errors->first('desc_mentality', 'is-invalid') !!}"
                                                placeholder="La mentalidad de tu personaje. Cómo imagina. Cómo piensa. Qué dice su cerebro antes de actuar."
                                        >{{ old('desc_mentality', $character->desc_mentality) }}</textarea>
                                        {!! $errors->first('desc_mentality', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="desc_appearance">Apariencia <span class="mini">(opcional)</span></label>
                                        <textarea
                                                id="desc_appearance"
                                                name="desc_appearance"
                                                type="text"
                                                class="form-control {!! $errors->first('desc_appearance', 'is-invalid') !!}"
                                                placeholder="Cómo se ve tu personaje. ¡Descripción física y atuendo!"
                                        >{{ old('desc_appearance', $character->desc_appearance) }}</textarea>
                                        {!! $errors->first('desc_appearance', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="desc_social_status">Status social <span class="mini">(opcional)</span></label>
                                        <textarea
                                                id="desc_social_status"
                                                name="desc_social_status"
                                                type="text"
                                                class="form-control {!! $errors->first('desc_social_status', 'is-invalid') !!}"
                                                placeholder="Cómo se relaciona tu personaje. Cómo lo ven los demás. Cómo habla. Cómo se expresa."
                                        >{{ old('desc_social_status', $character->desc_social_status) }}</textarea>
                                        {!! $errors->first('desc_social_status', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="famous_phrase">Frases célebres <span class="mini">(opcional)</span></label>
                                        <textarea
                                                id="famous_phrase"
                                                name="famous_phrase"
                                                type="text"
                                                class="form-control {!! $errors->first('famous_phrase', 'is-invalid') !!}"
                                                placeholder="'Detrás de mí...'"
                                        >{{ old('famous_phrase', $character->famous_phrase) }}</textarea>
                                        {!! $errors->first('famous_phrase', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <input type="submit" value="Guardar" class="btn btn-primary">
                                    <div class="float-right">
                                        <a href="javascript:confirmDelete('{{ route('characters.remove', $character->id) }}')" class="btn btn-danger">Borrar personaje</a>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4">
                                <img class="img-thumbnail" src="{{ $character->getImage() }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-class" role="tabpanel">
                        <div class="form-group">
                            <form action="{{ route('characters.addclass', $character->id) }}" method="POST">
                                @csrf
                                @method("POST")
                                <div class="row">
                                    <div class="col-4">
                                        <input name="class" type="text" class="form-control" placeholder="Clase">
                                    </div>
                                    <div class="col-2">
                                        <input name="level" type="number" class="form-control" placeholder="Nivel">
                                    </div>
                                    <div class="col-2">
                                        <input type="submit" value="Agregar clase" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Clase</th>
                                <th>Nivel</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($character->classes as $class)
                                <tr>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->level }}</td>
                                    <td>
                                        <a href="{{ route('characters.removeclass', [$character->id, $class->id]) }}">Quitar</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Aun no hay clases asignadas a este personaje</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            @if($character->campaign)
            <div class="alert alert-warning">
                <strong>Atención!</strong> Este personaje pertenece a la campañas <strong> {{ $character->campaign->name }}</strong>. El director de la campaña puede editar este personaje cuando lo desee y habilitarlo o deshabilitarlo en su campaña. Los personajes adheridos a una campaña no pueden ser removidos de la misma.
            </div>
            @endif

        </div>
    </section>

@endsection