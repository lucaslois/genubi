@extends('layouts.main')


@section('content')
    <div class="container">
        <div class="box box-login">
            <form action="{{ route('forgot_password.store') }}" method="POST">
                @csrf
                @method("POST")

                <h1 class="text-center">Recuperar contraseña</h1>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input
                            id="email"
                            name="email"
                            type="text"
                            value="{{ old('email') }}"
                            class="form-control {!! $errors->first('email', 'is-invalid') !!}">
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <input type="submit" class="btn btn-primary" value="Enviar contraseña">
            </form>
        </div>
    </div>
@endsection