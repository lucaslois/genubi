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
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">Antiguo Mal</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.sessions.index', $selected_campaign->id) }}">Sesiones</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('sessions.show', $session->id) }}">{{ $session->name }}</a></li>
                            <li class="breadcrumb-item active">Asignaciones</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>Asignaciones</h1>
            <div class="box box-border-top">
                <h4>NPCs</h4>
                <form action="{{ route('sessions.assignments.store', $session->id)  }}" method="POST">
                    @csrf
                    @method("POST")
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <select name="npc_id" id="npc_id" class="form-control">
                                    @foreach($npcs as $npc)
                                        <option value="{{ $npc->id }}">{{ $npc->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-success" value="Guardar">
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table">
                    <tbody>
                        @foreach($session->npcs as $npc)
                            <tr>
                                <td><img style="width: 64px" src="{{ $npc->getImage() }}" alt=""></td>
                                <td>{{ $npc->name }}</td>
                                <td><a href="{{ route('sessions.assignments.delete', [$session->id, $npc->id]) }}">Quitar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h4>Enemigos</h4>
                <form action="{{ route('sessions.assignments.store', [$session->id, 'enemy' => true])  }}" method="POST">
                    @csrf
                    @method("POST")
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <select name="npc_id" id="npc_id" class="form-control">
                                    @foreach($npcs as $npc)
                                        <option value="{{ $npc->id }}">{{ $npc->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-success" value="Guardar">
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table">
                    <tbody>
                    @foreach($session->enemies as $npc)
                        <tr>
                            <td><img style="width: 64px" src="{{ $npc->getImage() }}" alt=""></td>
                            <td>{{ $npc->name }}</td>
                            <td><a href="{{ route('sessions.assignments.delete', [$session->id, $npc->id, 'enemy' => true]) }}">Quitar</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#text' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
