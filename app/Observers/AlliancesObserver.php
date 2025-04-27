<?php

namespace App\Observers;

use App\Models\Alliance;

class AlliancesObserver
{
    /**
     * Handle the Alliance "created" event.
     */
    public function created(Alliance $alliance): void
    {
        //
    }

    /**
     * Handle the Alliance "updated" event.
     */
    public function updated(Alliance $alliance): void
    {
        //
    }

    /**
     * Handle the Alliance "deleted" event.
     */
    public function deleted(Alliance $alliance): void
    {
        $alliances = Alliance::where('index', '>', $alliance->index)->get();
        
        foreach ($alliances as $o) {
            $o->decrement('index');
        }
    }

    /**
     * Handle the Alliance "restored" event.
     */
    public function restored(Alliance $alliance): void
    {
        //
    }

    /**
     * Handle the Alliance "force deleted" event.
     */
    public function forceDeleted(Alliance $alliance): void
    {
        //
    }
}
