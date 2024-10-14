<?php

namespace App\Observers;

use App\Models\OutboundDocument;

class OutboundDocumentObserver
{
    /**
     * Handle the OutboundDocument "created" event.
     *
     * @param  \App\Models\OutboundDocument  $outboundDocument
     * @return void
     */
    public function creating(OutboundDocument $outboundDocument)
    {
        $outboundDocument->created_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundDocument "updated" event.
     *
     * @param  \App\Models\OutboundDocument  $outboundDocument
     * @return void
     */
    public function updating(OutboundDocument $outboundDocument)
    {
        $outboundDocument->updated_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundDocument "deleted" event.
     *
     * @param  \App\Models\OutboundDocument  $outboundDocument
     * @return void
     */
    public function deleted(OutboundDocument $outboundDocument)
    {
        //
    }

    /**
     * Handle the OutboundDocument "restored" event.
     *
     * @param  \App\Models\OutboundDocument  $outboundDocument
     * @return void
     */
    public function restored(OutboundDocument $outboundDocument)
    {
        //
    }

    /**
     * Handle the OutboundDocument "force deleted" event.
     *
     * @param  \App\Models\OutboundDocument  $outboundDocument
     * @return void
     */
    public function forceDeleted(OutboundDocument $outboundDocument)
    {
        //
    }
}
