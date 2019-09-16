<?php

namespace App\Observers;

use App\Models\Session;

class SessionObserver
{
    /**
     * Handle the session "created" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function created(Session $session)
    {
        $session->generateTag();
    }

    /**
     * Handle the session "updated" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function updated(Session $session)
    {
        $session->generateTag();
    }

    /**
     * Handle the session "deleted" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function deleted(Session $session)
    {
        //
    }

    /**
     * Handle the session "restored" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function restored(Session $session)
    {
        //
    }

    /**
     * Handle the session "force deleted" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function forceDeleted(Session $session)
    {
        //
    }
}
