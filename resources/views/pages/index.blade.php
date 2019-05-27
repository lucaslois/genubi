@extends('layouts.main')


@section('content')
    <section class="main news">

        <div class="container">
            @for($x = 0; $x < 2; $x++)
                <div class="box">
                    <div class="article">
                        <h1 class="article_title">¡Bienvenidos a Genubi!</h1>
                        <div class="details">
                            <span class="data author">Escrito por <a href="#">Lucas Lois</a> | 15/01/2019 (hace 4 dias)</span>
                        </div>
                        <div class="content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio doloremque eligendi esse eveniet facere fugit, inventore modi neque obcaecati quaerat quibusdam, repellat sequi temporibus vitae voluptatibus! Sequi tempora, totam. Adipisci?</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio doloremque eligendi esse eveniet facere fugit, inventore modi neque obcaecati quaerat quibusdam, repellat sequi temporibus vitae voluptatibus! Sequi tempora, totam. Adipisci?</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio doloremque eligendi esse eveniet facere fugit, inventore modi neque obcaecati quaerat quibusdam, repellat sequi temporibus vitae voluptatibus! Sequi tempora, totam. Adipisci?</p>
                        </div>
                    </div>
                </div>
            @endfor

            <div class="view-more text-center">
                <a href="#">Ver todas las noticias</a>
            </div>
            <hr>
        </div>

    </section>

    <section class="main partidas">
        <div class="container">
            <h1>Partidas populares</h1>
            <div class="row">
                @for($x = 0; $x < 3; $x++)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16853fa67ea%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16853fa67ea%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.203125%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Antiguo Mal</h5>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eligendi et quo saepe sapiente soluta suscipit ullam, veritatis vero vitae? Asperiores delectus enim est ipsa iusto nostrum quia ratione totam!
                                </p>
                                <a href="#" class="btn btn-primary">Ver partida</a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <hr>
        </div>
    </section>
    <section class="main partidas">
        <div class="container">
            <h1>Últimas sesiones</h1>
            <div class="row">
                @for($x = 0; $x < 3; $x++)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16853fa67ea%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16853fa67ea%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.203125%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">El golpe de la gacela que escapa de su presa</h5>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eligendi et quo saepe sapiente soluta suscipit ullam, veritatis vero vitae? Asperiores delectus enim est ipsa iusto nostrum quia ratione totam!
                                </p>
                                <a href="#" class="btn btn-primary">Ver sesión</a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection