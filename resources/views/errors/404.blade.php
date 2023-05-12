@extends('layouts.main')


@section('content')
    <section class="main feed-list">
        <div class="container">
            <h1>Error 404</h1>
            <div class="box box-border-top-red text-center">
                <img class="error-image" src="{{ asset('images/404.jpeg') }}" alt="">
                <div class="mt-2">
                    <p>¡Nos hemos perdido! Pero no te preocupes, a los mejores guerreros también les pasa.</p>
                    @if($exception->getMessage())
                    <p class="alert alert-warning">{{ $exception->getMessage() }}</p>
                    @endif
                    <p><a href="{{ url('/') }}">Ir a la página principal</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
