@extends('mails.layout')

@section('content')
    <p>¡Hola, {{ $user->name }}!</p>
    <p>Hemos recibido una solicitud para cambiar tu contraseña.</p>
    <p>Si deseas cambiar tu contraseña, <a href="{{ route('recovery_password.index', $token->token) }}">has click aquí</a>.</p>
@endsection