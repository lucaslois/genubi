<?php

namespace App\Observers;

use App\Models\Campaign;

class CampaignObserver
{
    /**
     * Handle the campaign "created" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function created(Campaign $campaign)
    {
        $campaign->generateTag();
    }

    /**
     * Handle the campaign "updated" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function updated(Campaign $campaign)
    {
        $campaign->generateTag();
    }

    /**
     * Handle the campaign "deleted" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function deleted(Campaign $campaign)
    {
        //
    }

    /**
     * Handle the campaign "restored" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function restored(Campaign $campaign)
    {
        //
    }

    /**
     * Handle the campaign "force deleted" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function forceDeleted(Campaign $campaign)
    {
        //
    }
}
