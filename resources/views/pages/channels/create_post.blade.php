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
                            <form action="{{ route('channels.posts.store',  $channel->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="text">Descripción</label>
                                    <textarea
                                            id="text"
                                            name="text"
                                            type="text"
                                            class="form-control {!! $errors->first('text', 'is-invalid') !!}"
                                            placeholder="Escribe tu mensaje"
                                    >{{ old('text') }}</textarea>
                                    {!! $errors->first('text', '<div class="invalid-feedback">:message</div>') !!}
                                    <div class="mini">Este es un editor embebido. Puedes mencionar a otras entidades anteponiendo el caracter @.</div>
                                </div>

                                <input type="submit" value="Guardar" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>

                @if($post)
                    <div class="box">
                        <p>Estás respondiendo al siguiente post de <b>{{ $post->participant()->getName() }}</b>, escrito por {{ $post->user->name }}</p>
                        <div class="quote">{!! $post->text !!}</div>
                    </div>
                @endif
            </div>
        </section>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdn.ckeditor.com/4.12.1/standard-all/ckeditor.js"></script>
    <script src="{{ asset('plugins/ckeditor/customCkEditor.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var channel_id = @json($channel->id);

        createCkEditor('text');

        let app = new Vue({
            el: '#app',
            data: {
                last_post: @json(optional($last_post)->getAttributes())
            },
            methods: {
                checkLastPost: function() {
                    if(!channel_id) return;
                    axios.get('/channels/'+ channel_id + '/last-post').then(response => {
                        const last = response.data;
                        if(last.id !== this.last_post.id) {
                            this.last_post = last;
                            swal(
                                'Atención!',
                                "Hay un nuevo post de "+ this.last_post.participant +", escrito por " + this.last_post.user,
                                'warning'
                            )
                        }
                    });
                }
            }
        })

        setInterval(function() { app.checkLastPost() }, 5000);
    </script>
@endpush