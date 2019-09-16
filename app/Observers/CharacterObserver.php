<?php

namespace App\Observers;

use App\Models\Character;

class CharacterObserver
{
    /**
     * Handle the character "created" event.
     *
     * @param  \App\Models\Character  $character
     * @return void
     */
    public function created(Character $character)
    {
        $character->generateTag();
    }

    /**
     * Handle the character "updated" event.
     *
     * @param  \App\Models\Character  $character
     * @return void
     */
    public function updated(Character $character)
    {
        $character->generateTag();
    }

    /**
     * Handle the character "deleted" event.
     *
     * @param  \App\Models\Character  $character
     * @return void
     */
    public function deleted(Character $character)
    {
        //
    }

    /**
     * Handle the character "restored" event.
     *
     * @param  \App\Models\Character  $character
     * @return void
     */
    public function restored(Character $character)
    {
        //
    }

    /**
     * Handle the character "force deleted" event.
     *
     * @param  \App\Models\Character  $character
     * @return void
     */
    public function forceDeleted(Character $character)
    {
        //
    }
}
