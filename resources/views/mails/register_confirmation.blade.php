@extends('mails.layout')

@section('content')
    <p>¡Hola, {{ $user->name }}!</p>
    <p>¡Bienvenido a Genubi! Este mensaje es para corroborar que el correo electrónico sea legítimo.</p>
    <p>Para completar tu registro, <a href="{{ route('register.check', $token) }}">has click aquí</a>.</p>
@endsection