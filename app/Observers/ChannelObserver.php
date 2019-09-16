<?php

namespace App\Observers;

use App\Models\Channel;

class ChannelObserver
{
    /**
     * Handle the channel "created" event.
     *
     * @param  \App\Models\Channel  $channel
     * @return void
     */
    public function created(Channel $channel)
    {
        $channel->generateTag();
    }

    /**
     * Handle the channel "updated" event.
     *
     * @param  \App\Models\Channel  $channel
     * @return void
     */
    public function updated(Channel $channel)
    {
        $channel->generateTag();
    }

    /**
     * Handle the channel "deleted" event.
     *
     * @param  \App\Models\Channel  $channel
     * @return void
     */
    public function deleted(Channel $channel)
    {
        //
    }

    /**
     * Handle the channel "restored" event.
     *
     * @param  \App\Models\Channel  $channel
     * @return void
     */
    public function restored(Channel $channel)
    {
        //
    }

    /**
     * Handle the channel "force deleted" event.
     *
     * @param  \App\Models\Channel  $channel
     * @return void
     */
    public function forceDeleted(Channel $channel)
    {
        //
    }
}
