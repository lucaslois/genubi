@if(isset($selected_campaign))
<section class="section-campaign">
    <div class="header-campaign-background"
         style="background-image: url({{ $selected_campaign->getImage() }})">
        <div class="header-campaign-overlay"></div>
        <div class="container">
            <div class="header-campaign-content">
                <h1 class="header-campaign-title">{{ $selected_campaign->name }}
                    <span class="badge header-campaign-badge" style="background: {{ $selected_campaign->state->color }}">{{ $selected_campaign->state->name }}</span>
                </h1>
                <div class="header-campaign-additional">
                    Dirigda por <a href="{{ route('users.show', $selected_campaign->user->id) }}">{{ $selected_campaign->user->name }}</a>
                </div>
                <div class="header-campaign-description">
                    <p>
                        {{ $selected_campaign->short_description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif