<?php

namespace App\Observers;

use App\Models\Npc;

class NpcObserver
{
    /**
     * Handle the npc "created" event.
     *
     * @param  \App\Models\Npc  $npc
     * @return void
     */
    public function created(Npc $npc)
    {
        $npc->generateTag();
    }

    /**
     * Handle the npc "updated" event.
     *
     * @param  \App\Models\Npc  $npc
     * @return void
     */
    public function updated(Npc $npc)
    {
        $npc->generateTag();
    }

    /**
     * Handle the npc "deleted" event.
     *
     * @param  \App\Models\Npc  $npc
     * @return void
     */
    public function deleted(Npc $npc)
    {
        //
    }

    /**
     * Handle the npc "restored" event.
     *
     * @param  \App\Models\Npc  $npc
     * @return void
     */
    public function restored(Npc $npc)
    {
        //
    }

    /**
     * Handle the npc "force deleted" event.
     *
     * @param  \App\Models\Npc  $npc
     * @return void
     */
    public function forceDeleted(Npc $npc)
    {
        //
    }
}
