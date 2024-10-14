<?php

namespace App\Observers;

use App\Models\InboundTransportation;

class InboundTransportationObserver
{
    /**
     * Handle the InboundTransportation "created" event.
     *
     * @param  \App\Models\InboundTransportation  $inboundTransportation
     * @return void
     */
    public function creating(InboundTransportation $inboundTransportation)
    {
        $inboundTransportation->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundTransportation "updated" event.
     *
     * @param  \App\Models\InboundTransportation  $inboundTransportation
     * @return void
     */
    public function updating(InboundTransportation $inboundTransportation)
    {
        $inboundTransportation->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundTransportation "deleted" event.
     *
     * @param  \App\Models\InboundTransportation  $inboundTransportation
     * @return void
     */
    public function deleted(InboundTransportation $inboundTransportation)
    {
        //
    }

    /**
     * Handle the InboundTransportation "restored" event.
     *
     * @param  \App\Models\InboundTransportation  $inboundTransportation
     * @return void
     */
    public function restored(InboundTransportation $inboundTransportation)
    {
        //
    }

    /**
     * Handle the InboundTransportation "force deleted" event.
     *
     * @param  \App\Models\InboundTransportation  $inboundTransportation
     * @return void
     */
    public function forceDeleted(InboundTransportation $inboundTransportation)
    {
        //
    }
}
