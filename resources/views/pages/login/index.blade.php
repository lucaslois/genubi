@extends('layouts.main')


@section('content')
    <div class="container">
        <div class="box box-login">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                @method("POST")

                <h1 class="text-center">Iniciar sesión</h1>
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
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input
                            id="password"
                            name="password"
                            type="password"
                            value="{{ old('password') }}"
                            class="form-control {!! $errors->first('password', 'is-invalid') !!}">
                    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <input type="submit" class="btn btn-primary" value="Iniciar sesión">
                <a class="ml-3" href="{{ route('forgot_password.index') }}">Olvidé mi contraseña</a>

            </form>
        </div>
    </div>
@endsection