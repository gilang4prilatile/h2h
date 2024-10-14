<?php

namespace App\Observers;

use App\Models\Transportation;

class TransportationObserver
{
    /**
     * Handle the Transportation "created" event.
     *
     * @param  \App\Models\Transportation  $transportation
     * @return void
     */
    public function creating(Transportation $transportation)
    {
        $transportation->created_by = auth()->user()->id;
    }

    /**
     * Handle the Transportation "updated" event.
     *
     * @param  \App\Models\Transportation  $transportation
     * @return void
     */
    public function updating(Transportation $transportation)
    {
        $transportation->updated_by = auth()->user()->id;
    }

    /**
     * Handle the Transportation "deleted" event.
     *
     * @param  \App\Models\Transportation  $transportation
     * @return void
     */
    public function deleted(Transportation $transportation)
    {
        //
    }

    /**
     * Handle the Transportation "restored" event.
     *
     * @param  \App\Models\Transportation  $transportation
     * @return void
     */
    public function restored(Transportation $transportation)
    {
        //
    }

    /**
     * Handle the Transportation "force deleted" event.
     *
     * @param  \App\Models\Transportation  $transportation
     * @return void
     */
    public function forceDeleted(Transportation $transportation)
    {
        //
    }
}
