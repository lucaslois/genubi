@extends('layouts.main')

@section('content')
    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Antiguo Mal</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Repartir experiencias</h1>
            <div class="box box-border-top">
                <form action="{{ route('campaigns.experiences.store', $selected_campaign->id) }}" method="POST">
                    @csrf
                    @method("POST")
                    <div class="form-group">
                        <label for="session_id">Sesión de la campaña</label>
                        <select name="session_id" id="session_id" class="form-control">
                            <option value="">Ninguno</option>
                            @foreach($selected_campaign->sessions as $session)
                                <option value="{{ $session->id }}">{{ $session->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Personaje</th>
                            <th>Experiencia</th>
                            <th>Motivo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($selected_campaign->characters as $character)
                            <tr>
                                <td>
                                    {{ $character->name }}
                                    <input hidden name="character_ids[]" type="text" value="{{ $character->id }}">
                                </td>
                                <td>
                                    <input name="value[{{ $character->id }}]" type="number" class="form-control">
                                </td>
                                <td>
                                    <input name="reason[{{ $character->id }}]" type="text" class="form-control">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <input type="submit" class="btn btn-primary" value="Confirmar">
                </form>
            </div>
        </div>
    </section>


@endsection