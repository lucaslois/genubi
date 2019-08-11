@extends('layouts.main')

@section('content')
    @include('layouts.components.selected_campaign')

    <section class="main news">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Partidas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">{{ $selected_campaign->name }}</a></li>
                            <li class="breadcrumb-item">Conocimientos</li>
                        </ol>
                    </nav>
                </div>
                @if(auth()->check() && auth()->user()->canCreateKnowledge($selected_campaign))
                    <div class="col-md-4">
                        <div class="buttons float-md-right">
                            <a href="{{ route('knowledges.create', ['campaign_id' => $selected_campaign->id]) }}" class="btn btn-warning btn-square">Crear conocimiento</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="section-sessions">
        <div class="container">
            <h1>Conocimientos</h1>
            <div class="box box-border-top">
                {{ $knowledges->links() }}
                <table class="table">
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>Creador</th>
                        <th>Compartido con</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($knowledges as $knowledge)
                        <tr>
                            <td>{{ $knowledge->name }}</td>
                            <td>
                                @if($knowledge->character)
                                    {{ $knowledge->character->name }} <span class="mini">({{ $knowledge->user->name }})</span>
                                @else
                                    {{ $knowledge->user->name }}
                                    @if($knowledge->isDM())
                                        <span class="badge badge-warning">Conocimiento del DM</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($knowledge->characters->count() > 0 || $knowledge->share_everyone)
                                    @if($knowledge->share_everyone)
                                        <span class="badge badge-success">Todos</span>
                                    @else
                                        @foreach($knowledge->characters as $chac)
                                            <span class="badge badge-dark" style="{{ $chac->color }}">{{ $chac->name }}</span>
                                        @endforeach
                                    @endif
                                @else
                                    <span class="badge badge-danger">Nadie</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('knowledges.show', $knowledge->id) }}">Entrar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Oooops! parece que aun no hay conocimientos</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $knowledges->links() }}
            </div>
        </div>
    </section>
@endsection
