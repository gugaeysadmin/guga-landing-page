<?php

namespace App\Observers;

use App\Models\Offert;

class OffertObserver
{
    /**
     * Handle the Offert "created" event.
     */
    public function created(Offert $offert): void
    {
        //
    }

    /**
     * Handle the Offert "updated" event.
     */
    public function updated(Offert $offert): void
    {
        //
    }

    /**
     * Handle the Offert "deleted" event.
     */
    public function deleted(Offert $offert): void
    {
        // Reordenar los índices restantes
        $offerts = Offert::where('index', '>', $offert->index)->get();
        
        foreach ($offerts as $o) {
            $o->decrement('index');
        }
    }

    /**
     * Handle the Offert "restored" event.
     */
    public function restored(Offert $offert): void
    {
        //
    }

    /**
     * Handle the Offert "force deleted" event.
     */
    public function forceDeleted(Offert $offert): void
    {
        //
    }
}
