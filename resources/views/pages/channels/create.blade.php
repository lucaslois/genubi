@extends('layouts.main')


@section('content')
    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">{{ $selected_campaign->name }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.channels.index', $selected_campaign->id) }}">Canales</a></li>
                            <li class="breadcrumb-item active">Crear nuevo canal</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Creación de nuevo canal</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('channels.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <input name="campaign_id" value="{{ $selected_campaign->id }}" type="text"  hidden>

                            <div class="form-group">
                                <label for="name">Título</label>
                                <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name') }}"
                                        class="form-control {!! $errors->first('name', 'is-invalid') !!}"
                                        placeholder="Título de tu canal"
                                >
                                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="character_ids">Personaje</label>
                                <select
                                        id="character_ids"
                                        name="character_ids[]"
                                        type="text"
                                        class="form-control {!! $errors->first('character_ids', 'is-invalid') !!}"
                                        multiple
                                >
                                    @foreach($selected_campaign->characters as $character)
                                        <option value="{{ $character->id }}">{{ $character->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('character_ids', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="text">Descripción</label>
                                <textarea
                                        id="text"
                                        name="text"
                                        type="text"
                                        class="form-control {!! $errors->first('text', 'is-invalid') !!}"
                                        placeholder="Escribe un resumen sobre qué tratará tu canal"
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

