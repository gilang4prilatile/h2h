<?php

namespace App\Observers;

use App\Models\OutboundTransportation;

class OutboundTransportationObserver
{
    /**
     * Handle the OutboundTransportation "created" event.
     *
     * @param  \App\Models\OutboundTransportation  $outboundTransportation
     * @return void
     */
    public function creating(OutboundTransportation $outboundTransportation)
    {
        $outboundTransportation->created_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundTransportation "updated" event.
     *
     * @param  \App\Models\OutboundTransportation  $outboundTransportation
     * @return void
     */
    public function updating(OutboundTransportation $outboundTransportation)
    {
        $outboundTransportation->updated_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundTransportation "deleted" event.
     *
     * @param  \App\Models\OutboundTransportation  $outboundTransportation
     * @return void
     */
    public function deleted(OutboundTransportation $outboundTransportation)
    {
        //
    }

    /**
     * Handle the OutboundTransportation "restored" event.
     *
     * @param  \App\Models\OutboundTransportation  $outboundTransportation
     * @return void
     */
    public function restored(OutboundTransportation $outboundTransportation)
    {
        //
    }

    /**
     * Handle the OutboundTransportation "force deleted" event.
     *
     * @param  \App\Models\OutboundTransportation  $outboundTransportation
     * @return void
     */
    public function forceDeleted(OutboundTransportation $outboundTransportation)
    {
        //
    }
}
