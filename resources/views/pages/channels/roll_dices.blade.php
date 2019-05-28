@extends('layouts.main')


@section('content')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">Antiguo Mal</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.channels.index', $selected_campaign->id) }}">Canales</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('channels.show', $channel->id) }}">{{ $channel->name }}</a></li>
                            <li class="breadcrumb-item active">Crear post</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Creación de post</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('channels.dices.store',  $channel->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <div class="form-group">
                                <label for="character_id">Personaje</label>
                                <select
                                        id="character_id"
                                        name="character_id"
                                        type="text"
                                        class="form-control {!! $errors->first('character_id', 'is-invalid') !!}"
                                >
                                    <optgroup label="Personajes">
                                        @forelse($characters as $character)
                                            <option value="C{{ $character->id }}">{{ $character->name }}</option>
                                        @empty
                                            <option selected disabled>Ninguno</option>
                                        @endforelse
                                    </optgroup>
                                    @if($channel->campaign->user->is(auth()->user()))
                                    <optgroup label="NPCs">
                                        @forelse($npcs as $npc)
                                            <option value="N{{ $npc->id }}">{{ $npc->name }}</option>
                                        @empty
                                            <option selected disabled>Ninguno</option>
                                        @endforelse
                                    </optgroup>
                                    @endif
                                </select>
                                {!! $errors->first('character_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="reason">Motivo</label>
                                <input
                                        id="reason"
                                        name="reason"
                                        type="text"
                                        class="form-control {!! $errors->first('reason', 'is-invalid') !!}"
                                        value="{{ old('reason') }}"
                                >
                                {!! $errors->first('reason', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="roll">Tirada de dados</label>
                                <input
                                        id="roll"
                                        name="roll"
                                        type="text"
                                        class="form-control {!! $errors->first('roll', 'is-invalid') !!}"
                                        value="{{ old('roll') }}"
                                        placeholder="Por ejemplo: [1d20] + 4"
                                >
                                {!! $errors->first('roll', '<div class="invalid-feedback">:message</div>') !!}
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