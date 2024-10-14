<?php

namespace App\Observers;

use App\Models\OutboundProfile;

class OutboundProfileObserver
{
    /**
     * Handle the OutboundProfile "created" event.
     *
     * @param  \App\Models\OutboundProfile  $outboundProfile
     * @return void
     */
    public function creating(OutboundProfile $outboundProfile)
    {
        $outboundProfile->created_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundProfile "updated" event.
     *
     * @param  \App\Models\OutboundProfile  $outboundProfile
     * @return void
     */
    public function updating(OutboundProfile $outboundProfile)
    {
        $outboundProfile->update_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundProfile "deleted" event.
     *
     * @param  \App\Models\OutboundProfile  $outboundProfile
     * @return void
     */
    public function deleted(OutboundProfile $outboundProfile)
    {
        //
    }

    /**
     * Handle the OutboundProfile "restored" event.
     *
     * @param  \App\Models\OutboundProfile  $outboundProfile
     * @return void
     */
    public function restored(OutboundProfile $outboundProfile)
    {
        //
    }

    /**
     * Handle the OutboundProfile "force deleted" event.
     *
     * @param  \App\Models\OutboundProfile  $outboundProfile
     * @return void
     */
    public function forceDeleted(OutboundProfile $outboundProfile)
    {
        //
    }
}
