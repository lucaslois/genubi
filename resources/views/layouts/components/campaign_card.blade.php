<div class="card card-campaign mb-3">
    <div style="background-image: url('{{ $campaign->getImageMini() }}')"
         class="card-campaign-header">
    </div>
    <div class="card-body">
        <h5 class="card-title card-campaign-title">{{ $campaign->name }} <span class="mini-2" style="color: {{ $campaign->state->color }}">{{ $campaign->state->name }}</span></h5>
        <span class="card-campaign-details">
            {{ $campaign->game->name }}, por <a href="">{{ $campaign->user->name }}</a>
        </span>
        <p class="card-text card-campaign-description">
            {{ str_limit($campaign->short_description, 150) }}
        </p>
    </div>
    <div class="card-footer">
        <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-primary btn-sm">Ver partida</a>
        <div class="float-right">
            <span class="badge text-success reaction"><i class="fa fa-thumbs-up"></i> {{ $campaign->positives() }}</span>
            <span class="badge text-danger reaction"><i class="fa fa-thumbs-down"></i> {{ $campaign->negatives() }}</span>
        </div>
    </div>
</div>