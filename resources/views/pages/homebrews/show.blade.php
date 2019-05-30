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
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.show', $selected_campaign->id) }}">{{ $selected_campaign->name }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('campaigns.homebrews.index', $selected_campaign->id) }}">Reglas de la casa</a></li>
                            <li class="breadcrumb-item active">{{ $homebrew->name }}</li>
                        </ol>
                    </nav>
                </div>
                @if($selected_campaign->user->is(auth()->user()))
                <div class="col-6">
                    <div class="buttons float-md-right">
                        <a href="{{ route('homebrews.edit', $homebrew->id) }}" class="btn btn-warning btn-square">Editar</a>
                        <span class="dropdown">
                            <a href="" data-toggle="dropdown" class="btn btn-warning btn-square"><i class="fas fa-caret-down"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('homebrews.remove', $homebrew->id) }}">Eliminar regla</a>
                            </div>
                        </span>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <h1>{{ $homebrew->name }}</h1>
            <div class="box box-border-top">
                <div class="content">
                    {!! $homebrew->text !!}
                </div>
            </div>
        </div>
    </section>
@endsection