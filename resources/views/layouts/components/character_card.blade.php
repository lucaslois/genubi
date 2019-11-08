<div class="card card-character">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <img class="img-thumbnail" src="{{ $character->getImage() }}" alt="">
            </div>
            <div class="col-8">
                <h5 class="character-title">{{ $character->name }} <span class="character-level">Nv. {{ $character->currentLevel() }}</span></h5>
                <p class="character-data character-data-owner">de <a href="{{ route('users.show', $character->user->id) }}">{{ $character->user->name }}</a></p>
                <p class="character-data">{{ $character->race }} |
                    {{ $character->classes->implode('name', ', ')  }}
                </p>
                @if($character->nationality)
                    <p class="character-data">Oriundo de {{ $character->nationality }}</p>
                @endif
                <p class="character-desc">{{ str_limit($character->description, 200) }}</p>
                <a href="{{ route('characters.show', $character->id) }}" class="btn btn-primary btn-sm mt-2">Ver personaje</a>
            </div>
        </div>
    </div>
    @php
        $campaign = $character->campaign;
    @endphp
    @if($campaign->user->is(auth()->user()))
        <div class="card-footer">
            <a href="{{ route('characters.dm.edit', $character->id) }}" class="btn btn-warning btn-sm">Editar personaje</a>
        </div>
    @endif
</div>