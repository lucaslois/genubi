@extends('layouts.main')


@section('content')
    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Búsqueda</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Buscador</h1>
            <div class="box box-border-top">
                <p>Aquí se listan todos los canales creados en la campaña. Un canal es una via de comunicación que le permite a los jugadores rolear por fuera de una sesión.</p>
            </div>
        </div>
    </section>

    <section class="main section-sessions">
        <div class="container">
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
                        {{ $tags->links() }}
                        <table class="table">
                            <thead>
                            <tr>
                                <th width="100">Avatar</th>
                                <th>Nombre</th>
                                <th>Partida</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tags as $tag)
                                <tr>
                                    <td><img class="img-thumbnail img-mini" src="{{ $tag->taggable->getImage() }}" alt=""></td>
                                    <td>{{ $tag->name }} <br> <span class="mini">{{ $tag->taggable->getType() }}</span></td>
                                    <td>{{ $tag->campaign ? $tag->campaign->name : 'Ninguno' }}</td>
                                    <td><a href="{{ $tag->taggable->formattedLink() }}">Entrar</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Oooops! no encontramos nada para las palabras "{{ request()->global_search }}"...</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $tags->links() }}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection