<?php

namespace App\Observers;

use App\Models\InboundJenisTpb;

class InboundJenisTpbObserver
{
    /**
     * Handle the InboundJenisTpb "created" event.
     *
     * @param  \App\Models\InboundJenisTpb  $inboundJenisTpb
     * @return void
     */
    public function creating(InboundJenisTpb $inboundJenisTpb)
    {
        $inboundJenisTpb->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundJenisTpb "updated" event.
     *
     * @param  \App\Models\InboundJenisTpb  $inboundJenisTpb
     * @return void
     */
    public function updating(InboundJenisTpb $inboundJenisTpb)
    {
        $inboundJenisTpb->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundJenisTpb "deleted" event.
     *
     * @param  \App\Models\InboundJenisTpb  $inboundJenisTpb
     * @return void
     */
    public function deleted(InboundJenisTpb $inboundJenisTpb)
    {
        //
    }

    /**
     * Handle the InboundJenisTpb "restored" event.
     *
     * @param  \App\Models\InboundJenisTpb  $inboundJenisTpb
     * @return void
     */
    public function restored(InboundJenisTpb $inboundJenisTpb)
    {
        //
    }

    /**
     * Handle the InboundJenisTpb "force deleted" event.
     *
     * @param  \App\Models\InboundJenisTpb  $inboundJenisTpb
     * @return void
     */
    public function forceDeleted(InboundJenisTpb $inboundJenisTpb)
    {
        //
    }
}
