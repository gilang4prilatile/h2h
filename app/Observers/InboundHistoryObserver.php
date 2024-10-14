<?php

namespace App\Observers;

use App\Models\InboundHistory;

class InboundHistoryObserver
{
    /**
     * Handle the InboundHistory "created" event.
     *
     * @param  \App\Models\InboundHistory  $inboundHistory
     * @return void
     */
    public function creating(InboundHistory $inboundHistory)
    {
        $inboundHistory->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundHistory "updated" event.
     *
     * @param  \App\Models\InboundHistory  $inboundHistory
     * @return void
     */
    public function updating(InboundHistory $inboundHistory)
    {
        $inboundHistory->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundHistory "deleted" event.
     *
     * @param  \App\Models\InboundHistory  $inboundHistory
     * @return void
     */
    public function deleted(InboundHistory $inboundHistory)
    {
        //
    }

    /**
     * Handle the InboundHistory "restored" event.
     *
     * @param  \App\Models\InboundHistory  $inboundHistory
     * @return void
     */
    public function restored(InboundHistory $inboundHistory)
    {
        //
    }

    /**
     * Handle the InboundHistory "force deleted" event.
     *
     * @param  \App\Models\InboundHistory  $inboundHistory
     * @return void
     */
    public function forceDeleted(InboundHistory $inboundHistory)
    {
        //
    }
}
