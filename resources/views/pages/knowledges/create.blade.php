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
                            <li class="breadcrumb-item"><a href="{{ route('knowledges.index', ['campaign_id' => $selected_campaign->id]) }}">Conocimientos</a></li>
                            <li class="breadcrumb-item active">Editar descubrimiento</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Creación de nuevo descubrimiento</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('knowledges.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <input name="campaign_id" value="{{ request()->campaign_id }}" type="text" hidden>
                            <div class="form-group">
                                <label for="character_id">Personaje</label>
                                <select
                                        id="character_id"
                                        name="character_id"
                                        type="text"
                                        class="form-control {!! $errors->first('character_id', 'is-invalid') !!}">
                                    @if($selected_campaign->user->is(auth()->user()))
                                        <option value="">Ninguno</option>
                                    @endif
                                    @foreach($characters as $character)
                                        <option value="{{ $character->id }}">{{ $character->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('character_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
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
                                <label for="name">Tipo</label>
                                <select
                                    id="type_id"
                                    name="type_id"
                                    class="form-control {!! $errors->first('type_id', 'is-invalid') !!}">
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('type_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="text">Texto</label>
                                <textarea
                                        id="text"
                                        name="text"
                                        type="text"
                                        class="form-control {!! $errors->first('text', 'is-invalid') !!}"
                                        placeholder="Su nombre es Lyrette, pricesa de Celeria. Hija de Rodolphus Flint y Myrcella Gingar. Su trabajo es gobernar la ciudad de Celeria con mano firme y justa"
                                >{{ old('text') }}</textarea>
                                {!! $errors->first('text', '<div class="invalid-feedback">:message</div>') !!}
                                <div class="mini">Este es un editor embebido. Puedes mencionar a otras entidades anteponiendo el caracter @.</div>
                            </div>

                            <div class="form-group">
                                <label for="shared_with_all">Compartido con</label>
                                <div class="form-group">
                                    <div class="pretty p-default">
                                        <input type="checkbox"
                                               name="share_everyone"
                                               id="share_everyone"
                                        />
                                        <div class="state p-primary">
                                            <label>Todos</label>
                                        </div>
                                    </div>
                                    {!! $errors->first('enemy', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <select
                                        id="character_ids"
                                        name="character_ids[]"
                                        type="text"
                                        multiple
                                        class="form-control select2 {!! $errors->first('name', 'is-invalid') !!}">
                                    @foreach($shared_with as $character)
                                        <option value="{{ $character->id }}">{{$character->name}}, de {{ $character->user->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('character_ids', '<div class="invalid-feedback">:message</div>') !!}
                                <div class="mini">Al compartir un descubrimiento con todos, cualquier usuario podrá consultar el documento.</div>
                            </div>

                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.ckeditor.com/4.12.1/standard-all/ckeditor.js"></script>
    <script src="{{ asset('plugins/ckeditor/customCkEditor.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script>
        createCkEditor('text');
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
