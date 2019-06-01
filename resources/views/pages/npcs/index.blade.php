@extends('layouts.main')


@section('content')
    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $campaign->id) }}">{{ $campaign->name }}</a></li>
                            <li class="breadcrumb-item active">Npcs</li>
                        </ol>
                    </nav>
                </div>
                @if($selected_campaign->user->is(auth()->user()))
                <div class="col-md-6">
                    <div class="buttons float-md-right">
                        <a href="{{ route('npcs.create') }}" class="btn btn-success btn-square btn-upper">Crear NPC</a>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>NPCs</h1>
            <div class="box box-border-top">
                <p>Aquí se listan todos los NPCs dados de alta en el sistema.</p>
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
                            <input type="submit" class="btn btn-success" value="Buscar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="main section-sessions">
        <div class="container">
            <div class="box box-border-top">
                <div class="row">
                    <div class="col-12">
                        {{ $npcs->links() }}
                        <table class="table">
                            <thead>
                            <tr>
                                <th width="100">Foto</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($npcs as $npc)
                                <tr>
                                    <td><img class="img-thumbnail npc-avatar" src="{{ $npc->getImage() }}" alt=""></td>
                                    <td>
                                        <div class="square" style="background-color: {{ $npc->color }}"></div>
                                        <span class="npc-name"><a href="{{ route('npcs.show', $npc->id) }}">{{ $npc->name }}</a></span>
                                        @if($npc->enemy)
                                            <span class="badge badge-danger">Enemigo</span>
                                        @endif
                                        @if(!$npc->public)
                                            <span class="badge badge-primary">Privado</span>
                                        @endif
                                        <span class="npc-description">{{ $npc->description }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Aun no hay NPCs</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $npcs->links() }}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection