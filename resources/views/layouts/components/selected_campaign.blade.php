@if(isset($selected_campaign))
<section class="section-campaign">
    {{--<div class="container">--}}
    <div class="campaign_background"
         style="background-image: url({{ $selected_campaign->getImage() }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="campaign_content">
                <h1 class="campaign_title">{{ $selected_campaign->name }}
                    <span class="badge campaign_badge" style="background: {{ $selected_campaign->state->color }}">{{ $selected_campaign->state->name }}</span>
                </h1>
                <div class="campaign_aditional">
                    Dirigda por <a href="{{ route('users.show', $selected_campaign->user->id) }}">{{ $selected_campaign->user->name }}</a>
                </div>
                <div class="campaign_description">
                    <p>
                        {{ $selected_campaign->short_description }}
                    </p>
                </div>
            </div>
        </div>

    </div>
    {{--</div>--}}
</section>
@endif