@extends('layouts.main')


@section('content')
    <section class="main feed-list">
        <div class="container">
            <h1>Error 404</h1>
            <div class="box box-border-top-red text-center">
                <img class="img-thumbnail" src="{{ asset('images/belial.webp') }}" alt="">
                <div class="mt-2">
                    <p>Ooops! Parece que nos tropezamos y caímos en los confines del infierno. Claramente no encontramos lo que buscabas...</p>
                    <p><a href="{{ url('/') }}">Ir a la página principal</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection