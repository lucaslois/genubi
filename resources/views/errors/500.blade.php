@extends('layouts.main')


@section('content')
    <section class="main feed-list">
        <div class="container">
            <h1>Error 500</h1>
            <div class="box box-border-top-red text-center">
                <img class="error-image" src="{{ asset('images/500.jpeg') }}" alt="">
                <div class="mt-2">
                    <p>¡Algo se rompió! Quizás sea un buen momento para tomar un descanso, o pedir ayuda.</p>
                    <p><a href="{{ url('/') }}">Ir a la página principal</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
