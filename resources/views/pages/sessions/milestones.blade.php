@extends('layouts.main')


@section('content')

    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">{{ $selected_campaign->name }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.sessions.index', $selected_campaign->id) }}">Sesiones</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('sessions.show', $session->id) }}">{{ $session->name }}</a></li>
                            <li class="breadcrumb-item active">Hitos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Hitos</h1>
            <div class="box box-border-top">
                <form action="{{ route('sessions.milestones.store', $session->id)  }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                class="form-control {!! $errors->first('name', 'is-invalid') !!}">
                        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input
                                id="avatar"
                                name="avatar"
                                type="file"
                                value="{{ old('avatar') }}"
                                class="form-control {!! $errors->first('avatar', 'is-invalid') !!}">
                        {!! $errors->first('avatar', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description">Resumen</label>
                        <textarea
                                id="description"
                                name="description"
                                type="text"
                                class="form-control {!! $errors->first('description', 'is-invalid') !!}">{{ old('description') }}</textarea>
                        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <input type="submit" class="btn btn-success" value="Guardar">
                </form>
                <table class="table mt-4">
                    <thead>
                    <th colspan="3">Lista de hitos</th>
                    </thead>
                    <tbody>
                        @forelse($milestones as $milestone)
                            <tr>
                                <td><img style="width: 64px" src="{{ $milestone->getImage() }}" alt=""></td>
                                <td>{{ $milestone->name }}</td>
                                <td><a href="{{ route('sessions.milestones.delete', [$session->id, $milestone->id]) }}">Quitar</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Aun no hay hitos para esta sesión</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </section>

@endsection
