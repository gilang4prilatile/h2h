<?php

namespace App\Observers;

use App\Models\InboundTransportationPort;

class InboundTransportationPortObserver
{
    /**
     * Handle the InboundTransportationPort "created" event.
     *
     * @param  \App\Models\InboundTransportationPort  $inboundTransportationPort
     * @return void
     */
    public function creating(InboundTransportationPort $inboundTransportationPort)
    {
        $inboundTransportationPort->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundTransportationPort "updated" event.
     *
     * @param  \App\Models\InboundTransportationPort  $inboundTransportationPort
     * @return void
     */
    public function updating(InboundTransportationPort $inboundTransportationPort)
    {
        $inboundTransportationPort->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundTransportationPort "deleted" event.
     *
     * @param  \App\Models\InboundTransportationPort  $inboundTransportationPort
     * @return void
     */
    public function deleted(InboundTransportationPort $inboundTransportationPort)
    {
        //
    }

    /**
     * Handle the InboundTransportationPort "restored" event.
     *
     * @param  \App\Models\InboundTransportationPort  $inboundTransportationPort
     * @return void
     */
    public function restored(InboundTransportationPort $inboundTransportationPort)
    {
        //
    }

    /**
     * Handle the InboundTransportationPort "force deleted" event.
     *
     * @param  \App\Models\InboundTransportationPort  $inboundTransportationPort
     * @return void
     */
    public function forceDeleted(InboundTransportationPort $inboundTransportationPort)
    {
        //
    }
}
