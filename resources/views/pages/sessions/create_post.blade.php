@extends('layouts.main')


@section('content')
    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">Antiguo Mal</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.sessions.index', $selected_campaign->id) }}">Sesiones</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('sessions.show', $session->id) }}">{{ $session->name }}</a></li>
                            <li class="breadcrumb-item active">Crear post</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Creación de nuevo diario</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('sessions.posts.store', $session->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <div class="form-group">
                                <label for="character_id">Personaje</label>
                                <select
                                        name="character_id"
                                        id="character_id"
                                        class="form-control {!! $errors->first('character_id', 'is-invalid') !!}"
                                >
                                    <option disabled selected>Ninguno</option>
                                    @foreach($characters as $character)
                                        <option value="{{ $character->id }}">{{ $character->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('character_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="title">Título</label>
                                <input
                                        name="title"
                                        id="title"
                                        value="{{ old('title') }}"
                                        placeholder="Una aventura increible"
                                        class="form-control {!! $errors->first('title', 'is-invalid') !!}"
                                >
                                {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="text">Diario</label>
                                <textarea name="text" id="text"
                                          class="form-control {!! $errors->first('text', 'is-invalid') !!}"
                                          placeholder="El diario de la sesión anima a los personajes a contar sus experiencias en el rol. Puedes extenderte todo lo que quieras. Es importante que cuentes el diario desde la perspectiva de tu personaje (narrado preferentemente en primera persona). Recuerda que no puedes modificar los hechos que ocurrieron durante la sesión, solo narrarlos según tu perspectiva."
                                >{{ old('text') }}</textarea>
                                {!! $errors->first('text', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#text' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush