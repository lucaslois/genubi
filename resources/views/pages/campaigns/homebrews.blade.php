@extends('layouts.main')


@section('content')
    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Partidas</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Antiguo Mal</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Homebrews</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-8">
                    <div class="buttons float-md-right">
                        <a href="" class="btn btn-success btn-square">Crear sesión</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Homebrews</h1>
            <div class="box box-border-top">
                <p>Aquí se listan todas las homebrews creadas por el el dungeon master para su partida. Una <i>homebrew</i> es una regla no-oficial creada por el DM de una mesa.</p>
            </div>
        </div>
    </section>

    <section class="main section-sessions">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <th>Título</th>
                        <th>Fecha</th>
                        <th>Creado por</th>
                        </thead>
                        <tbody>
                        @for($x = 0; $x < 4; $x++)
                        <tr>
                            <td width="70%">
                                <a href="{{ url('homebrew') }}">Regla de conjuros</a>
                                <p style="font-size: 14px; ">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum perferendis possimus praesentium quibusdam sunt? Aliquam architecto, eligendi fuga fugiat labore maxime officiis optio, placeat porro, possimus quos recusandae reiciendis vero?</p>
                            </td>
                            <td>21/01/2019</td>
                            <td><a href="#">Lucas Lois</a></td>
                        </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection