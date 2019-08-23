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
                            <li class="breadcrumb-item active">Editar post</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Edición de post</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('posts.update',  $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
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
                                            <option value="C{{ $character->id }}" {{ $character->is($post->character) ? 'selected' : "" }}>{{ $character->name }}</option>
                                        @empty
                                            <option selected disabled>Ninguno</option>
                                        @endforelse
                                    </optgroup>
                                    @if($channel->campaign->user->is(auth()->user()))
                                    <optgroup label="NPCs">
                                        @forelse($npcs as $npc)
                                            <option value="N{{ $npc->id }}" {{ $npc->is($post->npc) ? 'selected' : "" }}>{{ $npc->name }}</option>
                                        @empty
                                            <option selected disabled>Ninguno</option>
                                        @endforelse
                                    </optgroup>
                                    @endif
                                </select>
                                {!! $errors->first('character_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="text">Descripción</label>
                                <textarea
                                        id="text"
                                        name="text"
                                        type="text"
                                        class="form-control {!! $errors->first('text', 'is-invalid') !!}"
                                        placeholder="Escribe tu mensaje"
                                >{{ old('text', $post->text) }}</textarea>
                                {!! $errors->first('text', '<div class="invalid-feedback">:message</div>') !!}
                                <div class="mini">Este es un editor embebido. Puedes mencionar a otras entidades anteponiendo el caracter @.</div>
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
    <script src="https://cdn.ckeditor.com/4.12.1/standard-all/ckeditor.js"></script>
    <script src="{{ asset('plugins/ckeditor/customCkEditor.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        createCkEditor('text');
    </script>
@endpush