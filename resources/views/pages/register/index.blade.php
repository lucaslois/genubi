@extends('layouts.main')


@section('content')
    <div class="container">
        <div class="box box-login">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                @method("POST")

                <h1 class="text-center">Registro de cuenta</h1>
                <div class="form-group">
                    <label for="name">Nombre completo</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        class="form-control {!! $errors->first('name', 'is-invalid') !!}">
                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
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

                <div class="form-group">
                    <label for="captcha">Ingrese el captcha</label>
                    <input
                        id="captcha"
                        name="captcha"
                        type="text"
                        value="{{ old('captcha') }}"
                        class="form-control {!! $errors->first('captcha', 'is-invalid') !!}">
                    {!! $errors->first('captcha', '<div class="invalid-feedback">:message</div>') !!}
                    <div class="mt-2">
                        {!! captcha_img() !!}
                    </div>
                </div>

                <input type="submit" class="btn btn-primary" value="Registrarme!">

            </form>
        </div>
    </div>
@endsection

