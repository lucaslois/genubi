@extends('layouts.main')


@section('content')
    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar perfil</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Editar mi perfil</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name', auth()->user()->name) }}"
                                        class="form-control {!! $errors->first('name', 'is-invalid') !!}"
                                        placeholder="Nickname"
                                >
                                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="email">Correo electrónico</label>
                                <input
                                        id="email"
                                        name="email"
                                        type="text"
                                        value="{{ old('email', auth()->user()->email) }}"
                                        class="form-control {!! $errors->first('email', 'is-invalid') !!}"
                                        placeholder="Correo electrónico"
                                        disabled
                                >
                                {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input
                                        id="avatar"
                                        name="avatar"
                                        type="file"
                                        class="form-control {!! $errors->first('avatar', 'is-invalid') !!}"
                                >
                                {!! $errors->first('avatar', '<div class="invalid-feedback">:message</div>') !!}
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
