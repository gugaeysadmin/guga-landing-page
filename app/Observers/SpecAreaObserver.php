<?php

namespace App\Observers;

use App\Models\SpecialityArea;

class SpecAreaObserver
{
    /**
     * Handle the SpecialityArea "created" event.
     */
    public function created(SpecialityArea $specialityArea): void
    {
        //
    }

    /**
     * Handle the SpecialityArea "updated" event.
     */
    public function updated(SpecialityArea $specialityArea): void
    {
        //
    }

    /**
     * Handle the SpecialityArea "deleted" event.
     */
    public function deleted(SpecialityArea $specialityArea): void
    {
        $specareas = SpecialityArea::where('index', '>', $specialityArea->index)->get();
        
        foreach ($specareas as $o) {
            $o->decrement('index');
        }
    }

    /**
     * Handle the SpecialityArea "restored" event.
     */
    public function restored(SpecialityArea $specialityArea): void
    {
        //
    }

    /**
     * Handle the SpecialityArea "force deleted" event.
     */
    public function forceDeleted(SpecialityArea $specialityArea): void
    {
        //
    }
}
