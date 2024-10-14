<?php

namespace App\Observers;

use App\Models\InboundDocument;

class InboundDocumentObserver
{
    /**
     * Handle the InboundDocument "created" event.
     *
     * @param  \App\Models\InboundDocument  $inboundDocument
     * @return void
     */
    public function creating(InboundDocument $inboundDocument)
    {
        $inboundDocument->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundDocument "updated" event.
     *
     * @param  \App\Models\InboundDocument  $inboundDocument
     * @return void
     */
    public function updating(InboundDocument $inboundDocument)
    {
        $inboundDocument->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundDocument "deleted" event.
     *
     * @param  \App\Models\InboundDocument  $inboundDocument
     * @return void
     */
    public function deleted(InboundDocument $inboundDocument)
    {
        //
    }

    /**
     * Handle the InboundDocument "restored" event.
     *
     * @param  \App\Models\InboundDocument  $inboundDocument
     * @return void
     */
    public function restored(InboundDocument $inboundDocument)
    {
        //
    }

    /**
     * Handle the InboundDocument "force deleted" event.
     *
     * @param  \App\Models\InboundDocument  $inboundDocument
     * @return void
     */
    public function forceDeleted(InboundDocument $inboundDocument)
    {
        //
    }
}
