<?php

namespace App\Observers;

use App\Models\OutboundJenisTpb;

class OutboundJenisTpbObserver
{
    /**
     * Handle the OutboundJenisTpb "created" event.
     *
     * @param  \App\Models\OutboundJenisTpb  $outboundJenisTpb
     * @return void
     */
    public function creating(OutboundJenisTpb $outboundJenisTpb)
    {
        $outboundJenisTpb->created_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundJenisTpb "updated" event.
     *
     * @param  \App\Models\OutboundJenisTpb  $outboundJenisTpb
     * @return void
     */
    public function updating(OutboundJenisTpb $outboundJenisTpb)
    {
        $outboundJenisTpb->updated_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundJenisTpb "deleted" event.
     *
     * @param  \App\Models\OutboundJenisTpb  $outboundJenisTpb
     * @return void
     */
    public function deleted(OutboundJenisTpb $outboundJenisTpb)
    {
        //
    }

    /**
     * Handle the OutboundJenisTpb "restored" event.
     *
     * @param  \App\Models\OutboundJenisTpb  $outboundJenisTpb
     * @return void
     */
    public function restored(OutboundJenisTpb $outboundJenisTpb)
    {
        //
    }

    /**
     * Handle the OutboundJenisTpb "force deleted" event.
     *
     * @param  \App\Models\OutboundJenisTpb  $outboundJenisTpb
     * @return void
     */
    public function forceDeleted(OutboundJenisTpb $outboundJenisTpb)
    {
        //
    }
}
