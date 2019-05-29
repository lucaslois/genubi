@extends('layouts.main')


@section('content')
    <div class="container">
        <div class="box box-login">
            <form action="{{ route('recovery_password.store', $password_reset->token) }}" method="POST">
                @csrf
                @method("POST")

                <h1 class="text-center">Nueva contraseña</h1>
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

                <input type="submit" class="btn btn-primary" value="Cambiar contraseña">
            </form>
        </div>
    </div>
@endsection