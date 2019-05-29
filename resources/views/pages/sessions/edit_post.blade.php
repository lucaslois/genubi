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
                            <li class="breadcrumb-item"><a href="{{ route('sessions.show', $post->session->id) }}">{{ $post->session->name }}</a></li>
                            <li class="breadcrumb-item active">Editar post</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Edición diario</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('sessions.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="character_id">Personaje</label>
                                <input type="text" class="form-control" value="{{ $post->character->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="text">Diario</label>
                                <textarea name="text" id="text" class="form-control">{{ old('text', $post->text) }}</textarea>
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