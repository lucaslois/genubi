@extends('layouts.main')


@section('content')
    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Usuarios</h1>
            <div class="box box-border-top">
                <p>Aquí se listan todos los usuarios registrados en Genubi</p>
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="search"
                                       type="text"
                                       class="form-control"
                                       placeholder="Buscador..."
                                       value="{{ request()->search }}"
                                >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-yellow btn-upper" value="Buscar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="main users ">
        <div class="container">
            <div class="box">

                <table class="table">
                    <thead>
                    <tr>
                        <th width="140">Avatar</th>
                        <th>Usuario</th>
                        <th>Ultimo inicio</th>
                        <th></th>
                    </tr>
                    @forelse($users as $user)
                        <tr>
                            <td><img class="img-thumbnail img-mini" src="{{ $user->getImage() }}" alt=""></td>
                            <td>
                                {{ $user->name }}
                                @if($user->isLogged())
                                    <span class="mini text-success"><i class="fa fa-circle"></i> En línea</span>
                                @endif
                                <br>
                                @if($user->isAdmin())
                                    <span class="badge badge-danger">Administrador</span>
                                @endif
                            </td>
                            <td>{{ $user->last_login ? $user->last_login->isoFormat('D MMM Y - H:m \h\s') : 'Nunca' }}</td>
                            <td><a href="{{ route('users.show', $user->id) }}">Entrar</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay usuarios registrados</td>
                        </tr>
                    @endforelse
                    </thead>
                </table>
            </div>

            {{ $users->links() }}
        </div>
    </section>
@endsection