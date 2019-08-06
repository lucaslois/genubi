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
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.npcs.index', $selected_campaign->id) }}">Npcs</a></li>
                            <li class="breadcrumb-item active">Crear Npc</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Creación de nuevo NPC</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('npcs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <input type="text" name="campaign_id" value="{{ $selected_campaign->id }}" hidden>

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
                                <label for="color">Color</label>
                                <input
                                        id="color"
                                        name="color"
                                        type="color"
                                        value="{{ old('color') }}"
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
                                <label for="description">¿Quién es?</label>
                                <textarea
                                        id="description"
                                        name="description"
                                        type="description"
                                        placeholder="Por ejemplo: Director de Arcania, Herrero de Molten, Miembro de los Espada Plateada, etc."
                                        class="form-control {!! $errors->first('description', 'is-invalid') !!}">{{ old('description') }}</textarea>
                                {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <div class="pretty p-default p-round">
                                    <input type="checkbox"
                                           name="enemy"
                                           id="enemy"
                                    />
                                    <div class="state p-danger">
                                        <label>Es un enemigo</label>
                                    </div>
                                </div>
                                {!! $errors->first('enemy', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <div class="pretty p-default p-round">
                                    <input type="checkbox"
                                           name="public"
                                           id="public"
                                           checked
                                    />
                                    <div class="state p-danger">
                                        <label>Público</label>
                                    </div>
                                </div>
                                {!! $errors->first('public', '<div class="invalid-feedback">:message</div>') !!}
                                <div class="checkbox-mini">* Si el personaje es público, aparecerá en la lista de NPCs de tu campaña y el resto de jugadores podrán mencionarlo en sus posteos.</div>
                            </div>

                            <div class="form-group">
                                <label for="description">Resumen</label>
                                <textarea
                                        id="description"
                                        name="description"
                                        type="text"
                                        class="form-control {!! $errors->first('description', 'is-invalid') !!}"
                                        placeholder="Su nombre es Lyrette, pricesa de Celeria. Hija de Rodolphus Flint y Myrcella Gingar. Su trabajo es gobernar la ciudad de Celeria con mano firme y justa"
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
                                        placeholder="La mentalidad del npc. Cómo imagina. Cómo piensa. Qué dice su cerebro antes de actuar."
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
                                        placeholder="Cómo se ve el npc. ¡Descripción física y atuendo!"
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
                                        placeholder="Cómo se relaciona el npc. Cómo lo ven los demás. Cómo habla. Cómo se expresa."
                                >{{ old('desc_social_status') }}</textarea>
                                {!! $errors->first('desc_social_status', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="famous_phrase">El NPC en 3 palabras <span class="mini">(opcional)</span></label>
                                <textarea
                                        id="famous_phrase"
                                        name="famous_phrase"
                                        type="text"
                                        class="form-control {!! $errors->first('famous_phrase', 'is-invalid') !!}"
                                        placeholder="Intrépido, curioso, inteligente"
                                >{{ old('famous_phrase') }}</textarea>
                                {!! $errors->first('famous_phrase', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="private_note">Información privada <span class="mini">(opcional)</span></label>
                                <textarea
                                        id="private_note"
                                        name="private_note"
                                        type="text"
                                        class="form-control {!! $errors->first('private_note', 'is-invalid') !!}"
                                        placeholder="Es un peligroso nigromante..."
                                >{{ old('private_note') }}</textarea>
                                {!! $errors->first('private_note', '<div class="invalid-feedback">:message</div>') !!}
                            </div>


                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

