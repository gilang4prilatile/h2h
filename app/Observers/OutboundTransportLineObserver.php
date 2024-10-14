<?php

namespace App\Observers;

use App\Models\OutboundTransportLine;

class OutboundTransportLineObserver
{
    /**
     * Handle the OutboundTransportLine "created" event.
     *
     * @param  \App\Models\OutboundTransportLine  $outboundTransportLine
     * @return void
     */
    public function creating(OutboundTransportLine $outboundTransportLine)
    {
        $outboundTransportLine->created_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundTransportLine "updated" event.
     *
     * @param  \App\Models\OutboundTransportLine  $outboundTransportLine
     * @return void
     */
    public function updating(OutboundTransportLine $outboundTransportLine)
    {
        $outboundTransportLine->updated_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundTransportLine "deleted" event.
     *
     * @param  \App\Models\OutboundTransportLine  $outboundTransportLine
     * @return void
     */
    public function deleted(OutboundTransportLine $outboundTransportLine)
    {
        //
    }

    /**
     * Handle the OutboundTransportLine "restored" event.
     *
     * @param  \App\Models\OutboundTransportLine  $outboundTransportLine
     * @return void
     */
    public function restored(OutboundTransportLine $outboundTransportLine)
    {
        //
    }

    /**
     * Handle the OutboundTransportLine "force deleted" event.
     *
     * @param  \App\Models\OutboundTransportLine  $outboundTransportLine
     * @return void
     */
    public function forceDeleted(OutboundTransportLine $outboundTransportLine)
    {
        //
    }
}
