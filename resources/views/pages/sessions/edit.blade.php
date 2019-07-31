@extends('layouts.main')


@section('content')

    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">Antiguo Mal</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.sessions.index', $selected_campaign->id) }}">Sesiones</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('sessions.show', $selected_campaign->id) }}">{{ $session->name }}</a></li>
                            <li class="breadcrumb-item active">Editar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Editar sesión</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('sessions.update', $session->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="campaign_id">Partida</label>
                                <input
                                        name="campaign_id"
                                        type="text"
                                        class="form-control {!! $errors->first('campaign_id', 'is-invalid') !!}"
                                        value="{{ $session->campaign->name }}"
                                        disabled
                                >
                                {!! $errors->first('campaign_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name', $session->name) }}"
                                        class="form-control {!! $errors->first('name', 'is-invalid') !!}">
                                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="date">Día de la sesión</label>
                                <input
                                        id="date"
                                        name="date"
                                        type="date"
                                        value="{{ old('date', optional($session->date)->format('Y-m-d')) }}"
                                        class="form-control {!! $errors->first('date', 'is-invalid') !!}">
                                {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="background_image">Imagen de fondo</label>
                                <input
                                        id="background_image"
                                        name="background_image"
                                        type="file"
                                        value="{{ old('background_image') }}"
                                        class="form-control {!! $errors->first('background_image', 'is-invalid') !!}">
                                {!! $errors->first('background_image', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="text">Resumen</label>
                                <textarea
                                        id="text"
                                        name="text"
                                        class="form-control {!! $errors->first('text', 'is-invalid') !!}">{{ old('text', $session->text) }}</textarea>
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

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/tributejs/tribute.css') }}">
@endpush

@push('js')
    {{--    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>--}}
    {{--    <script src="{{ asset('plugins/ckeditor/customCkEditor.js') }}"></script>--}}
    <script src="https://cdn.ckeditor.com/4.12.1/standard-all/ckeditor.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var users = [{
            id: 1,
            avatar: 'm_1',
            fullname: 'Charles Flores',
            username: 'cflores'
        },
            {
                id: 2,
                avatar: 'm_2',
                fullname: 'Gerald Jackson',
                username: 'gjackson'
            },
        ];
        CKEDITOR.replace('text', {
            plugins: 'mentions,basicstyles,undo,link,wysiwygarea,toolbar',
            contentsCss: [
                'http://cdn.ckeditor.com/4.12.1/full-all/contents.css',
                'https://ckeditor.com/docs/vendors/4.12.1/ckeditor/assets/mentions/contents.css'
            ],
            height: 200,
            toolbar: [{
                name: 'document',
                items: ['Undo', 'Redo']
            },
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Strike']
                },
                {
                    name: 'links',
                    items: ['EmojiPanel', 'Link', 'Unlink']
                }
            ],
            mentions: [{
                feed: madeMention,
                itemTemplate: '<li data-id="{id}" class="mention-li">' +
                    '<img class="mention-image" src="{avatar}" />' +
                    '<div class="mention-data">' +
                    '<span class="mention-slug">{name}</span>' +
                    '<span class="mention-name">{slug}</span>' +
                    '</div>' +
                    '</li>',
                outputTemplate: '@{slug}',
                minChars: 2
            }]
        });

        function madeMention(opts, callback) {
            axios.defaults.baseURL = 'http://genubireborn.local';
            axios.get('api/autocomplete?search=' + opts.query).then(res => {
                var data = res.data.characters;
                callback(data);
            });
        }
    </script>
@endpush