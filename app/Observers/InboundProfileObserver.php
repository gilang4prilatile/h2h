<?php

namespace App\Observers;

use App\Models\InboundProfile;

class InboundProfileObserver
{
    /**
     * Handle the InboundProfile "created" event.
     *
     * @param  \App\Models\InboundProfile  $inboundProfile
     * @return void
     */
    public function creating(InboundProfile $inboundProfile)
    {
        $inboundProfile->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundProfile "updated" event.
     *
     * @param  \App\Models\InboundProfile  $inboundProfile
     * @return void
     */
    public function updating(InboundProfile $inboundProfile)
    {
        $inboundProfile->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundProfile "deleted" event.
     *
     * @param  \App\Models\InboundProfile  $inboundProfile
     * @return void
     */
    public function deleted(InboundProfile $inboundProfile)
    {
        //
    }

    /**
     * Handle the InboundProfile "restored" event.
     *
     * @param  \App\Models\InboundProfile  $inboundProfile
     * @return void
     */
    public function restored(InboundProfile $inboundProfile)
    {
        //
    }

    /**
     * Handle the InboundProfile "force deleted" event.
     *
     * @param  \App\Models\InboundProfile  $inboundProfile
     * @return void
     */
    public function forceDeleted(InboundProfile $inboundProfile)
    {
        //
    }
}
