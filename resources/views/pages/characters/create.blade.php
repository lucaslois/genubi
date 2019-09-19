ç@extends('layouts.main')


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
            @if($campaign_to_join)
                <div class="alert alert-success"><b>Atención</b>: Tu personaje será automaticamente vinculado a la partida {{ $campaign_to_join->name }}</div>
            @endif
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('characters.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            @if($campaign_to_join)
                                <input type="text" name="join_link" value="{{ $campaign_to_join->token }}" hidden>
                            @endif
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name', "Personaje de " . auth()->user()->name) }}"
                                        class="form-control {!! $errors->first('name', 'is-invalid') !!}">
                                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="family">Familia</label>
                                <input
                                        id="family"
                                        name="family"
                                        type="text"
                                        value="{{ old('family') }}"
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

                            <div class="form-group">
                                <label for="desc_mentality">Mentalidad <span class="mini">(opcional)</span></label>
                                <textarea
                                        id="desc_mentality"
                                        name="desc_mentality"
                                        type="text"
                                        class="form-control {!! $errors->first('desc_mentality', 'is-invalid') !!}"
                                        placeholder="La mentalidad de tu personaje. Cómo imagina. Cómo piensa. Qué dice su cerebro antes de actuar."
                                >{{ old('desc_mentality') }}</textarea>
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
                                >{{ old('desc_appearance') }}</textarea>
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
                                >{{ old('desc_social_status') }}</textarea>
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
                                >{{ old('famous_phrase') }}</textarea>
                                {!! $errors->first('famous_phrase', '<div class="invalid-feedback">:message</div>') !!}
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
