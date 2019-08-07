@extends('layouts.main')


@section('content')
    <section class="main feed-list">
        <div class="container">
            <h1>Error 500</h1>
            <div class="box box-border-top-red text-center">
                <img style="width: 700px" src="{{ asset('images/broken.png') }}" alt="">
                <div class="mt-2">
                    <p>Ooops! Algo en la página se rompió. Será conveniente que te contactes con el Administrador</p>
                    <p><a href="#">Ir a la página principal</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection