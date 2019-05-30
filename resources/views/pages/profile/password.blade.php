@extends('layouts.main')


@section('content')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mi perfil</li>
                            <li class="breadcrumb-item active" aria-current="page">Cambiar contraseña</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Cambiar contraseña</h1>
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('password.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <div class="form-group">
                                <label for="old_password">Contraseña actual</label>
                                <input
                                        id="old_password"
                                        name="old_password"
                                        type="password"
                                        value="{{ old('old_password') }}"
                                        class="form-control {!! $errors->first('old_password', 'is-invalid') !!}">
                                {!! $errors->first('old_password', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="password">Nueva contraseña</label>
                                <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        value="{{ old('password') }}"
                                        class="form-control {!! $errors->first('password', 'is-invalid') !!}">
                                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Nueva contraseña... ¡otra vez!</label>
                                <input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        class="form-control {!! $errors->first('password_confirmation', 'is-invalid') !!}">
                                {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection