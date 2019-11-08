<div class="dropdown-menu dropdown-grey dropdown-600" aria-labelledby="dropdownMenuButton">
    <div class="row">
        <div class="col-6 col-border-right">
            <a class="dropdown-item"
               href="{{ route('knowledges.index', [
                'campaign_id' => $selected_campaign->id,
                'visibility' => $visibility,
                'type' => 'npc'
                ]) }}">
                <img class="dropdown-grey-icon" src="{{ asset('images/icons/helm.svg') }}">
                NPCs
            </a>
            <a class="dropdown-item dropdown-hover-red"
               href="{{ route('knowledges.index', [
                'campaign_id' => $selected_campaign->id,
                'visibility' => $visibility,
                'type' => 'location'
                ]) }}">
                <img class="dropdown-grey-icon" src="{{ asset('images/icons/globe.svg') }}">
                Locaciones
            </a>
            <a class="dropdown-item dropdown-hover-violet"
               href="{{ route('knowledges.index', [
                'campaign_id' => $selected_campaign->id,
                'visibility' => $visibility,
                'type' => 'lore'
                ]) }}">
                <img class="dropdown-grey-icon" src="{{ asset('images/icons/ink.svg') }}">
                Lore
            </a>
            <a class="dropdown-item dropdown-hover-light-blue"
               href="{{ route('knowledges.index', [
                'campaign_id' => $selected_campaign->id,
                'visibility' => $visibility,
                'type' => 'creatures'
                ]) }}">
                <img class="dropdown-grey-icon"
                     src="{{ asset('images/icons/monster.svg') }}"> Criaturas
            </a>
            <a class="dropdown-item dropdown-hover-green"
               href="{{ route('knowledges.index', [
                'campaign_id' => $selected_campaign->id,
                'visibility' => $visibility,
                'type' => 'item'
                ]) }}">
                <img class="dropdown-grey-icon" src="{{ asset('images/icons/bag.svg') }}">
                Objetos
            </a>
        </div>
        <div class="col-6">
            <a class="dropdown-item dropdown-hover-dark-red"
               href="{{ route('knowledges.index', [
                'campaign_id' => $selected_campaign->id,
                'visibility' => $visibility,
                'type' => 'buildings'
                ]) }}">
                <img class="dropdown-grey-icon" src="{{ asset('images/icons/tower.svg') }}">
                Edificios
            </a>
            <a class="dropdown-item dropdown-hover-blue"
               href="{{ route('knowledges.index', [
                'campaign_id' => $selected_campaign->id,
                'visibility' => $visibility,
                'type' => 'civilizations'
                ]) }}">
                <img class="dropdown-grey-icon"
                     src="{{ asset('images/icons/heraldic.svg') }}"> Civilizaciones
            </a>
            <a class="dropdown-item dropdown-hover-dark-green"
               href="{{ route('knowledges.index', [
                'campaign_id' => $selected_campaign->id,
                'visibility' => $visibility,
                'type' => 'note'
                ]) }}">
                <img class="dropdown-grey-icon" src="{{ asset('images/icons/book.svg') }}">
                Notas
            </a>
            <a class="dropdown-item dropdown-hover-brown"
               href="{{ route('knowledges.index', [
                'campaign_id' => $selected_campaign->id,
                'visibility' => $visibility,
                'type' => 'maps'
                ]) }}">
                <img class="dropdown-grey-icon"
                     src="{{ asset('images/icons/scroll.svg') }}"> Mapas
            </a>
        </div>
    </div>
</div>
