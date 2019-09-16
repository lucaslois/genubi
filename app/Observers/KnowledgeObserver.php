<?php

namespace App\Observers;

use App\Models\Knowledge;

class KnowledgeObserver
{
    /**
     * Handle the knowledge "created" event.
     *
     * @param  \App\Models\Knowledge  $knowledge
     * @return void
     */
    public function created(Knowledge $knowledge)
    {
        $knowledge->generateTag();
    }

    /**
     * Handle the knowledge "updated" event.
     *
     * @param  \App\Models\Knowledge  $knowledge
     * @return void
     */
    public function updated(Knowledge $knowledge)
    {
        $knowledge->generateTag();
    }

    /**
     * Handle the knowledge "deleted" event.
     *
     * @param  \App\Models\Knowledge  $knowledge
     * @return void
     */
    public function deleted(Knowledge $knowledge)
    {
        //
    }

    /**
     * Handle the knowledge "restored" event.
     *
     * @param  \App\Models\Knowledge  $knowledge
     * @return void
     */
    public function restored(Knowledge $knowledge)
    {
        //
    }

    /**
     * Handle the knowledge "force deleted" event.
     *
     * @param  \App\Models\Knowledge  $knowledge
     * @return void
     */
    public function forceDeleted(Knowledge $knowledge)
    {
        //
    }
}
